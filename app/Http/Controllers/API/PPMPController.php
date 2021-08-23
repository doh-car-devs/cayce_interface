<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Traits\APIAccess;
use App\Http\Controllers\Traits\CurlNow;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Session;
use Auth;
use Facade\FlareClient\Http\Response;

class PPMPController extends Controller
{
    use CurlNow, APIAccess;

    private $ControllerKey = 'wfp';

    public function index(Request $request)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/create/wfp',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
            'flash' => $year,
        );
        $data = $this->getcurl($input);
        // dd($data['allwfp']);
        $input2 = array(
            'link' => '/api/library/categories',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data2 = $this->inventoryGet($input2);
        $input3 = array(
            'link' => '/api/library/branches',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data3 = $this->inventoryGet($input3);
        $input4 = array(
            'link' => '/api/library/units',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data4 = $this->inventoryGet($input4);
        // if ($data2 == 'time_out') {
        //     $data2 = [];
        // }
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        // dd($data['deletedWFPwithPPMP']);

        // $data['deletedWFPwithPPMP'] = (array) DB::connection('mysql_2')->table('wfp_activities')
        //     ->select('wfp_activities.status as wfp_status', 'ppmp.status AS ppmp_status', 'ppmp.id as PPMP_ID', 'wfp_activities.id as WFP_ID', 'wfp_activities.*' )
        //     ->join('ppmp', 'wfp_activities.id', '=', 'ppmp.wfp_id')
        //     ->where('wfp_activities.status', 'deleted')
        //     ->where('ppmp.status', '<>', 'deleted')
        // ->get();

        // dd($data['allppmp']);
        return  view('_ppmp.index')->with('data', $data)
            ->with('success', 'Inventory API Time_out')
            ->with('data2', $data2)
            ->with('data3', $data3)
            ->with('data4', $data4);
    }

    public function getPPMP() {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/create/wfp',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
            'flash' => $year,
        );
        $data = $this->getcurl($input);
        // $input = array(
        //     'link' => "/api/peek/ppmpinwfp/".$wfp_id,
        //     'apiKey' => $this->getAppkey($this->ControllerKey),
        //     'user' => auth()->user(),
        // );
        // $data = $this->getcurl($input);
        return $data;
    }

    public function  supplelmental_ppmp_index(Request $request)
    {
        // return redirect()->back()->with('feature-new', 'We are working hard to bring you this feature very soon! Contact ICT local 150 for more info.');
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/create/wfp',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
            'flash' => $year,
        );
        $data = $this->getcurl($input);
        // dd($data['allwfp']);
        $input2 = array(
            'link' => '/api/library/categories',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data2 = $this->inventoryGet($input2);
        $input3 = array(
            'link' => '/api/library/branches',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data3 = $this->inventoryGet($input3);
        $input4 = array(
            'link' => '/api/library/units',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data4 = $this->inventoryGet($input4);
        // if ($data2 == 'time_out') {
        //     $data2 = [];
        // }
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        return  view('_ppmp.index')->with('data', $data)
            ->with('success', 'Inventory API Time_out')
            ->with('data2', $data2)
            ->with('data3', $data3)
            ->with('data4', $data4);
    }

    public function store(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/store/ppmp",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        // dd($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function update(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/edit/ppmp/".$request->input('ppmp_entry_id'),
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        // dd($this->postcurl($input));
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function delete(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => '/api/rm/ppmp/'. $request->input('delete_id_ppmp'),
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function itemList(Request $request)
    {
        $input = $_GET;
        $input = array(
            // 'link' => '/api/items/search/'.$input['term'],
            'link' => '/api/items/search/'.$input['term'],
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->inventoryGet($input);
        return $data;
                        // $input = $_GET;
                        // $test = DB::table('users')
                        //     ->select('name as text', 'id as id')
                        //     ->where('name', 'like', '%'.$input['term'].'%')
                        //     ->get();
                        // $data = array(
                        //     'test' => $test,
                        // );
                        // $items['items'] = $test;
                        // return json_encode($items);
    }

    public function APPList(Request $request, $division = null)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        if ($division != null) {
            $divisionSelect = $division;
        }elseif($request->input('selecteddivision') !== null){
            $divisionSelect = $request->input('selecteddivision');
        }
        else {
            $divisionSelect = 9999;
        }
        $sectionSelect = $request->input('selectedsection');
        $programSelect = $request->input('program_select');

        $input = array(
            'link' => '/api/pt/app/1/'.$year.'/'.$divisionSelect.'/'.$sectionSelect.'/'.$programSelect,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );

        $data = $this->getcurl($input);
        // dd($data);
        $input2 = array(
            'link' => '/api/pt/app/2/'.$year.'/'.$divisionSelect.'/'.$sectionSelect.'/'.$programSelect,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data2 = $this->getcurl($input2);
        // dd($data['app']);

        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        // dd($data['app']);
        return  view('_ppmp.app')->with('data', $data)->with('data2', $data2);
    }

    public function ppmpApprove(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/edit/ppmpApprove/approve/",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        // dd($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function peekPPMP(Request $request,  $wfp_id = null)
    {
        // if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        // else  $year = date('Y');

        // $input = array(
        //     'link' => "/api/peek/ppmpinwfp/",
        //     'apiKey' => $this->getAppkey($this->ControllerKey),
        // );
        // $data = json_decode($this->postcurl($input));


        $input = array(
            'link' => "/api/peek/ppmpinwfp/".$wfp_id,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        // dd($data);
        return $data;



        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }
}
