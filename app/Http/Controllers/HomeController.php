<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\APIAccess;
use App\Http\Controllers\Traits\CurlNow;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User, App\Division, App\Section, App\Program, App\UserLink;
use App\http\Controllers\API;
use App\Http\Controllers\API\InventoryController;
use App\Http\Controllers\SystemAdminController;

class HomeController extends Controller
{
    use CurlNow, APIAccess;

    private $ControllerKey = 'wfp';
    private $twgIndex;
    private $sysadmin;

    use Traits\UserLinks;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->PPMP = new PPMP();
        $this->twgIndex = new InventoryController();
        $this->sysadmin = new SystemAdminController();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // return 'test';
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');
        $input = array(
            'link' => '/api/get/programBudget/'.$year.'/'.auth()->user()->section_id,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $programBudget = $this->getcurl($input);
        // $programBudget = "sdf";

        if (array_key_exists('nokeyerror', $programBudget))
            return redirect()->back()->with('error', $programBudget['nokeyerror']);
        $input['allitems'] = array(
            'link' => '/api/reference/wfp',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );

        $myTimeList = $this->sysadmin->individualbiometrics('monthly', date("m"), date("Y"));

        $input['dashboard-wfp'] = array(
            'link' => '/api/create/wfp',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
            'flash' => $year,
        );
        $dashboard_wfp = $this->getcurl($input['dashboard-wfp']);
        // $dashboard_wfp = "sdf";

        if ($myTimeList['time'] == "time_out") {
            $myTimeList['time'] = [];
        }
        $data = array(
            'programBudget' => $programBudget,
            'allitems' => $this->inventoryGet($input['allitems']),
            'dashboard_wfp' => $dashboard_wfp,
        );
        $data['year'] = $year;
        $data['time'] = $myTimeList;
        return view('_interface/index')->with('data', $data);
    }
}
