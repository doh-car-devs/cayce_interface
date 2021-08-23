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
use App\Http\Controllers\API\InventoryController;

class WFPController extends Controller
{
    use CurlNow, APIAccess;

    private $ControllerKey = 'wfp';
    private $twgIndex;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // // $this->PPMP = new PPMP();
        $this->twgIndex = new InventoryController();
    }

    public function index($entries = null)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/create/wfp',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
            'flash' => $year,
        );
        $input['allitems'] = array(
            'link' => '/api/reference/wfp',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        // dd($this->getdebug($input));
        $data = $this->getcurl($input);
        // dd($data['allApprovedWFP']);
        // dd($data['programFunds']);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        $data['entries'] = $entries;
        $data['allitems'] = $this->inventoryGet($input['allitems']);
        return  view('_wfp.index')->with('data', $data);
    }

    public function  supplelmental_wfp_index($entries = null)
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
        $input['allitems'] = array(
            'link' => '/api/reference/wfp',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        $data['entries'] = $entries;
        $data['allitems'] = $this->inventoryGet($input['allitems']);
        return  view('_wfp.supplimental_index')->with('data', $data);
    }

    public function store(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/store/wfp",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function storeDeliverable(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/store/deliverable",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }
    public function deliverableList(Request $request)
    {
        $var = $_GET;
        $input = array(
            'link' => '/api/ajax/deliverable/'. auth()->user()->division_id. "/".auth()->user()->section_id."/".$var['term'],
            // 'link' => '/api/ajax/deliverable/'. auth()->user()->division_id. "/".auth()->user()->section_id."/".'test',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        return $data;
    }

    function delete(Request $request)
    {
        $input = array(
            'link' => '/api/rm/wfp/'. $request->input('delete_id'),
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function update(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/edit/wfp/",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        // dd($this->postcurl($input));
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function division(Request $request)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/manage/divisionwfp/'.$year.'/division/'.$request->input('selectedsection').'/'.$request->input('program_select'),
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        return  view('_wfp.division')->with('data', $data);
    }

    public function dhComment(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/manage/dhcomment",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function wfpApprove(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/manage/wfpapprove",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function wfpApproveYear(Request $request)
    {
        $slice = Str::after($request->input('final_section_id'), 'selectedsection=');
        $input = array(
            'form_data' => $request->post(),
            'section' => $slice,
            'link' => "/api/manage/wfpapproveYear",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function sort(Request $request)
    {
        $year = $request->input('year');
        setcookie('year', base64_encode(serialize($year)), time() + (10 * 365 * 24 * 60 * 60), "/");

        return redirect()->back()->with('success', 'You have selected the year '. $year);
    }

    public function consolidatedWFP(Request $request)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        (array) $allwfp = DB::connection('mysql_2')->table('wfp_activities')
            ->select('wfp_activities.id as origwfp_id','wfp_activities.created_at as wfpC','wfp_activities.updated_at as wfpU','divisions.*', 'wfp_activities.id as wfp_id', 'wfp_activities.*','wfp_deliverable.*','annual_budget_programs.*','annual_budgets.*','fund_sources.*','fund_source_parents.*','fund_source_types.*','interfacev7.programs.*','interfacev7.users.name_family','interfacev7.users.name',)
            ->join('wfp_deliverable', 'wfp_activities.devliverable_id', '=', 'wfp_deliverable.id')
            ->join('annual_budget_programs', 'wfp_activities.annual_budget_program_id', '=', 'annual_budget_programs.id')
            ->join('annual_budgets', 'annual_budget_programs.annual_budget_id', 'annual_budgets.id')
            ->join('fund_sources', 'annual_budgets.fund_source_id', 'fund_sources.id')
            ->join('fund_source_parents', 'fund_sources.parent_id', 'fund_source_parents.id')
            ->join('fund_source_types', 'fund_sources.type_id', 'fund_source_types.id')
            ->Join('interfacev7.programs', 'wfp_activities.program_id', '=', 'interfacev7.programs.id')
            ->Join('interfacev7.divisions', 'programs.division_id', '=', 'interfacev7.divisions.id')
            ->join('interfacev7.users', 'wfp_activities.resp_person', '=', 'interfacev7.users.id')
            ->where('wfp_activities.status', '<>', 'deleted')
            ->where('wfp_activities.year', '=', $year)
        ->get();

        $wfpCategory = array(
            'A. Strategic Functions', 'B. Core Functions', 'C. Support Functions',
        );

        $data['year'] = $year;
        $data['allwfp'] = $allwfp;
        $data['allApprovedWFP'] = $allwfp;
        $data['wfpCategory'] = $wfpCategory;
        // dd ($data);
        return view('_wfp.consolidatedWFP')->with('data', $data);
    }


    public function getDeletedPPMPWFP()
    {
        $data = DB::connection('mysql_2')->table('wfp_activities')
            ->select('wfp_activities.status as wfp_status', 'ppmp.status AS ppmp_status', 'ppmp.id as PPMP_ID', 'wfp_activities.id as WFP_ID', 'wfp_activities.*' )
            // ->join('ppmp', 'wfp_activities.id', '=', 'ppmp.wfp_id')
            ->join('ppmp', 'wfp_activities.devliverable_id', '=', 'ppmp.wfp_id')
            ->where('wfp_activities.status', 'deleted')
            ->where('ppmp.status', '<>', 'deleted')
        ->get();
        // dd($data);
        return $data;
    }
}
