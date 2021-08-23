<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\APIAccess;
use App\Http\Controllers\Traits\CurlNow;
use App\Http\Controllers\Traits\UserLinks;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Employee;
use App\Division;
use App\Section;
use App\Program;
use App\File;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Storage;

class SystemAdminController extends Controller
{
    use UserLinks;
    use CurlNow, APIAccess;
    private $ControllerKey = 'wfp';

    public function index()
    {
        $data = array(
            'user' => auth()->user(),
            'users' => User::all()->count(),
            'divisions' => Division::all()->count(),
            'sections' => Section::all()->count(),
            'programs' => Program::all()->count(),
            'sidebar' => $this->linkList(),
        );

        return view('system_admin.index')->with('data', $data);
    }

    public function users(){
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $regular = DB::table('employees')
            ->select('IDNumber')
            ->where('type', 'DOHCAR')
            ->where('deleted_at', NULL)
            ->orderBy('IDNumber', 'DESC')->first();
        $jc = DB::table('employees')
            ->select('IDNumber')
            ->where('type', 'JC')
            ->where('deleted_at', NULL)
            ->orderBy('IDNumber', 'DESC')->first();
        $types = array(
            'DOHCAR','JC','BeGH','BGH','BAP','BAM','STO','BIU','AP','AB','BE','KA','IF','MPP','DTTB','PRDP'
        );


        foreach ($types as $key => $value) {
             $typeds[$key] = (array) DB::table('employees')
                ->select('IDNumber')
                ->where('type', $value)
                ->where('deleted_at', NULL)
                ->orderBy('IDNumber', 'DESC')->first();
            if($typeds[$key] == null)
                $typeds[$key]['IDNumber'] = $value.'-DOHCAR-001';
        }
        // dd($types);
        // dd($typeds);
        // $jc = DB::table('employees')
        //     ->select('IDNumber')
        //     ->where('type', 'JC')
        //     ->orderBy('IDNumber', 'DESC')->first();

// dd($jc);
        // $jc = DB::table('employees')
        //     ->select('IDNumber')->where('IDNumber', 'like', 'JC%')
        //     ->orderBy('id', 'DESC')->first();

        if ($regular !== null ) {
            $regular = substr($regular->IDNumber, strpos($regular->IDNumber, "-") + 1);
        }

        if ( $jc !== null) {
            $jc = substr($jc->IDNumber, strpos($jc->IDNumber, "-") + 1);
            $jc = substr($jc, strpos($jc, "-") + 1);
        }
        $employee = DB::table('employees')
            ->select('id','IDNumber','fullname', 'byname', 'designation', 'avatar', 'division_id', 'section_id')
            ->where('deleted_at', NULL)
            ->orderBy('created_at', 'DESC')->get();

        $HRRegular = array(
            'link' => '/regulars/',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $HRJC = array(
            'link' => '/jcs/',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $regg = $this->HRGet($HRRegular);
        $jcc = $this->HRGet($HRJC);
        $HR = array_merge($regg[0], $jcc[0]);

        $data = array(
            'users' => User::all(),
            'HRRegular' => $this->HRGet($HRRegular),
            'HRJC' => $this->HRGet($HRJC),
            'HR' => $HR,
            'employees' => $employee,
            // 'employees' => Employee::all()->sortByDesc('created_at'),
            'lastReg' => $regular,
            'lastJC' => $jc,
            'typeds' => $typeds,
            'types' => $types,
            'year' => $year
        );
        // dd($data);
        return view('system_admin.users')->with('data', $data);
    }

    // retrieve all employees saved in biometrics
    public function getBiometricsAPI() {
        $HRRegular = array(
            'link' => '/regulars/',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $HRJC = array(
            'link' => '/jcs/',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $regg = $this->HRGet($HRRegular);
        $jcc = $this->HRGet($HRJC);
        return array_merge($regg[0], $jcc[0]);
        // $data = array(
        //     'biometrics_users' => ,
        // );
        // return $data;
    }

    // get all EMPLOYEES in biometrics API
    public function updateLocalBiometricEmployee() {
        $data = $this->getBiometricsAPI();
        // dd($data);
        DB::beginTransaction();
        try {
            DB::table('bio_emp')->insert($data);
            DB::commit();
        } catch (\Illuminate\Database\QueryException  $e) {
            DB::rollback();
            dd( $e->getMessage());
            return redirect()->back()->with('error', $e->getMessage());
        }
        return 'success';
    }

    public function deleteEmployee(Request $request) {
        $data = $request->post();
        $idd = Employee::find($data['redirect_value'])->toArray();
        // dd($idd);
        $employee = DB::table('employees')
                    ->where('id', $data['redirect_value'])
                    ->update(
                        ['deleted_at' => Carbon::now(),
                        'IDNumber' => Carbon::now()."||".$idd['IDNumber'],
                        'avatar' => "deleteme||".$idd['IDNumber'].'||'.Carbon::now()
                        ]
                    );
        return redirect()->back()->with('success' , 'you have deleted an employee!');
    }

    public function getAllEmployee(){
        $employee = DB::table('employees')
            ->select('id','IDNumber','fullname', 'byname', 'designation', 'avatar')
            ->orderBy('created_at', 'DESC')->get();
        dd($employee);
        return response()->json([
            'data' => $employee
        ],200);

    }

    public function getAllUsers(){
        $users = DB::table('users')
            ->select(DB::raw('CONCAT(users.prefix," ", users.name, " ", users.name_middle, " ", users.name_family) as name'),
                'users.id as id','designation', 'divisions.division_name', 'sections.section_name')
            ->join('divisions', 'users.division_id', 'divisions.id')
            ->join('sections', 'users.section_id', 'sections.id')
            ->orderBy('name_family', 'DESC')
            ->get();
        return response()->json([
            'data' => $users
        ],200);
    }

    public function biometrics($id, $date, $month, $year)
    {
        $HRInput = array(
            'link' => '/'.$id.'/'.$date.'/'.$month.'/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $HRDetails = array(
            'link' => '/api/v1/employee/'.$id,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );

        $data = array(
            'details' => $this->HRGet($HRDetails),
            'time' => $this->HRGet($HRInput),
            'time2' => $this->localBio($id),
            'year' => 2021,
        );
        // dd($data);
        // return $this->HRGet($HRInput);
        return view('system_admin.dtr')->with('data', $data);
    }

    public function localBio($id = null, $date = null, $month = null, $year = null)
    {
        $bio = DB::table('bio')
            ->where('userid', $id)
            ->get();
        $data = array(
            'bio' => $bio
        );

        return $data;
    }

    public function downloadBio($id, $date, $month, $year)
    {
        $HRRegular = array(
            'link' => '/regulars/',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $HRJC = array(
            'link' => '/jcs/',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $regg = $this->HRGet($HRRegular);
        $jcc = $this->HRGet($HRJC);
        $HR = array_merge($regg[0], $jcc[0]);
        // dd($HR);
        $farray = array();
        foreach ($HR as $key => $value) {
            $HRInput = array(
                'link' => '/'.$value['userid'].'/'.$date.'/'.$month.'/'.$year,
                'apiKey' => $this->getAppkey($this->ControllerKey),
                'user' => auth()->user(),
            );
            $data[$key] = $this->HRGet($HRInput);
            $mydata = $this->HRGet($HRInput);
            // dd($mydata);
            foreach ($mydata as $key2 => $value2) {
                $value2 += ['useridd' => 'hi'];
                // $farray += ['useridd' => $value['userid']];
                // dd($value2);
            }
            // dd($farray);
            $farray[$key] = $mydata;

            // dd($mydata);
            // DB::beginTransaction();
            // try {
            //     DB::table('bio')->insert($v2);
            //     DB::commit();
            // } catch (\Illuminate\Database\QueryException  $e) {
            //     DB::rollback();
            //     return $e->getMessage();
            //     return redirect()->back()->with('error', $e->getMessage());
            // }
            break;
        }
        dd($farray);

        return $data;
    }

    public function personalbiometrics( $date, $month, $year)
    {
        $HRInput = array(
            'link' => '/'.auth()->user()->biometricID.'/'.$date.'/'.$month.'/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = array(
            'time' => $this->HRGet($HRInput),
            'year' => 2021,
        );
        // dd($data);
        // return $this->HRGet($HRInput);
        return view('system_admin.dtr')->with('data', $data);
    }

    public function individualbiometrics( $date, $month, $year)
    {
         $HRInput = array(
            'link' => '/'.auth()->user()->biometricID.'/'.$date.'/'.$month.'/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $month2 = $month-1;
         $HRInput2 = array(
            'link' => '/'.auth()->user()->biometricID.'/'.$date.'/'.$month2.'/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $result = $this->HRGet($HRInput) +  $this->HRGet($HRInput2);
        $data = array(
            'time' => $result,
            // 'year' => 2020,
        );
        return $data;
        // dd($data);
        // return $this->HRGet($HRInput);
        return view('system_admin.dtr')->with('data', $data);
    }

    public function storeEmployee(Request $request)
    {
        $data = $request->post();
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = $data['IDNumber'].'.png';
            $path = $file->storeAs('public/all', $filename);
            $data['avatar'] = 'all!!'.$data['IDNumber'].'.png';
        }else {
            $file = null;
        }

        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['division_id'] = 999;
        $data['division_id'] = 999;
        unset($data['_token']);

        // $emp = new Employee()
        $emp = Employee::create($data);
        // DB::beginTransaction();
        // try {
        //     DB::table('employees')->insert($data);
        //     DB::commit();
        // } catch (\Illuminate\Database\QueryException  $e) {
        //     DB::rollback();
        //     return redirect()->back()->with('error', $e->getMessage());
        // }
        return redirect()->back()->with('success', 'You have added a new employee!');
    }

    public function storeUser(Request $request)
    {
        $data = $request->post();

        // if ($request->file('avatar')) {
        //     $file = $request->file('avatar');
        //     $filename = $data['IDNumber'].'.png';
        //     $path = $file->storeAs('public/all', $filename);
        //     $data['avatar'] = 'all!!'.$data['IDNumber'].'.png';
        // }else {
        //     $file = null;
        // }

        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['division_id'] = 999;
        $data['division_id'] = 999;
        unset($data['_token']);

        DB::beginTransaction();
        try {
            DB::table('employees')->insert($data);
            DB::commit();
        } catch (\Illuminate\Database\QueryException  $e) {
            DB::rollback();
            return redirect()->back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('success', 'You have added a new employee!');
    }

    public function updateEmployee(Request $request, $id){
        $file = $request->file('avatar');
        $path = $file->store('files');
        DB::beginTransaction();
        try {
            DB::table('employees')->insert($data);
            $data2['ppmp_id'] = DB::getPdo()->lastInsertId();
            DB::table('ppmp_items')->updateOrInsert($data2);
            DB::commit();
        } catch (\Illuminate\Database\QueryException  $e) {
            DB::rollback();
            return response()->json([
                'error'=> $e->getMessage(),
                'data'=> $data,
                'status'=> 400
            ], 400);
        }
    }

    public function moveImages(){
        // $files = Storage::files('storage/all');
        // $files = Storage::files('public/images');
        // // $files = storage_path("app/public/{$filename}");
        // return ($files);

        // foreach ($files as $file) {
        //     $full_path_source = Storage::getDriver()->getAdapter()->applyPathPrefix($file);
        //     $full_path_dest = Storage::disk('remote')->getDriver()->getAdapter()
        //             ->applyPathPrefix($saveFolder . '/' . basename($file));
        //     File::move($full_path_source, $full_path_dest);
        // }

    }

    public function employeeCSV (Request $request){
        // dd($request->post());
        $selected = explode("yyy",$request->post()['redirect_value']);

        $result = DB::table('employees')
            ->whereIn('employees.id', $selected)
            ->get();

        $resultCount = DB::table('employees')
            ->whereIn('employees.id', $selected)
            ->count();
        $resultCountD = $resultCount/4;
        $arrayResult = array();

        // 'TLP','TLN','TLNN','NTL','TLPIC','TRP','TRN','TRNN','NTR','TRPIC','BLP','BLN','BLNN','NBL','BLPIC','BRP','BRN','BRNN','NBR','BRPIC'
        foreach ($result as $key => $i) {
            if ($resultCountD == $key) {
                break;
            }
            $arrayResult[$key]['IDNumber'] = $result[$key]->IDNumber;
            $arrayResult[$key]['fullname'] = $result[$key]->fullname;
            $arrayResult[$key]['byname'] = $result[$key]->byname;
            $arrayResult[$key]['designation'] = $result[$key]->designation;
            $arrayResult[$key]['avatar'] = $result[$key]->avatar;

            $arrayResult[$key]['IDNumbers'] = $result[$key+1]->IDNumber;
            $arrayResult[$key]['fullnames'] = $result[$key+1]->fullname;
            $arrayResult[$key]['bynames'] = $result[$key+1]->byname;
            $arrayResult[$key]['designations'] = $result[$key+1]->designation;
            $arrayResult[$key]['avatars'] = $result[$key+1]->avatar;

            $arrayResult[$key]['IDNumberss'] = $result[$key+2]->IDNumber;
            $arrayResult[$key]['fullnamess'] = $result[$key+2]->fullname;
            $arrayResult[$key]['bynamess'] = $result[$key+2]->byname;
            $arrayResult[$key]['designationss'] = $result[$key+2]->designation;
            $arrayResult[$key]['avatarss'] = $result[$key+2]->avatar;

            $arrayResult[$key]['IDNumbersss'] = $result[$key+3]->IDNumber;
            $arrayResult[$key]['fullnamesss'] = $result[$key+3]->fullname;
            $arrayResult[$key]['bynamesss'] = $result[$key+3]->byname;
            $arrayResult[$key]['designationsss'] = $result[$key+3]->designation;
            $arrayResult[$key]['avatarsss'] = $result[$key+3]->avatar;

        }

        $export = new EmployeesExport([
            $arrayResult
        ]);

        // $export->prependRow(1, array(
        //     // 'prepended', 'prepended'
        //     'TLP','TLN','TLNN','NTL','TLPIC','TRP','TRN','TRNN','NTR','TRPIC','BLP','BLN','BLNN','NBL','BLPIC','BRP','BRN','BRNN','NBR','BRPIC'
        // ));

        return Excel::download($export, 'generate.csv');
        // return Excel::download($export, 'generate.csv');
    }

    function bycript ()
    {
        return view('system_admin.cards.bycript');
    }

    function bycriptdecrypt (Request $request)
    {
        $data = array(
            'input' => $request->post(),
        );
        return $data;
        // return view('system_admin.cards.')->with('data', $data);
    }
}
