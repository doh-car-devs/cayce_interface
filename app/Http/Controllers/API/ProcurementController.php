<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Traits\APIAccess;
use App\Http\Controllers\Traits\CurlNow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProcurementController extends Controller
{
    use CurlNow, APIAccess;

    private $ControllerKey = 'wfp';

    function index()
    {
        # code...
    }

    function requestPurchaseRequest(Request $request){
        $redirect_year = $request->post()['redirect_year'];
        $postreq = $request->post();
        foreach($postreq as $key => $value){
            $exp_key = explode('-', $key);
            if($exp_key[0] == 'hidden_id'){
                 $arr_result[] = $value;
            }
        }
        if(!isset($arr_result)){
            $arr_result = [];
        }
        $postreq["secDiv"] = implode('xx',$arr_result);

        $input = array(
            'link' => '/api/export/rpr/'.$redirect_year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'flash' => $postreq["redirect_value"],
            'flash2' =>$postreq["secDiv"],
            'user' => auth()->user(),
        );
        // dd($this->postcurl($input));
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    function storePurchaseOrder($redirect_year, $secDiv, $redirectValue, $bidder_id, $pono){
        // return ($bidder_id);
        // $redirect_year = $redirect_year;
        // $postreq = $request->post();
        // foreach($postreq as $key => $value){
        //     $exp_key = explode('-', $key);
        //     if($exp_key[0] == 'hidden_id'){
        //          $arr_result[] = $value;
        //     }
        // }
        // if(!isset($arr_result)){
        //     $arr_result = [];
        // }
        // $postreq["secDiv"] = implode('xx',$arr_result);

        $input = array(
            'link' => '/api/export/rpo/'.$redirect_year.'/'.$pono,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'flash' => $redirectValue,
            'flash2' =>$secDiv,
            'user' => auth()->user(),
        );

        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    function createPR(Request $request)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/create/pr/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        // dd($data['prItems']);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        return  view('_procurement.purchaseRequest')->with('data', $data);
    }

    function purchaseRequestNumber(Request $request)
    {
        $postreq = $request->post();
        $prnumber = $postreq['fullprnumber'];
        $prid = $postreq['prid'];
        $input = array(
            'link' => '/api/edit/prn/store/'.$prid.'/'.$prnumber,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }


    function officePR(Request $request)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/create/pr/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        // dd($data);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        return  view('_procurement.OfficePurchaseRequest')->with('data', $data);
    }


    // delete ppmp_items with deleted PPMP
    function deletePPMPItemswithdeletedPPMP ()
    {
        $data = DB::connection('mysql_2')
        ->table('ppmp_items')
        ->select('*', 'ppmp_items.id as item_ID_to_DELETE')
        ->join('ppmp', 'ppmp_items.ppmp_id', 'ppmp.id')
        ->where('ppmp.status', 'deleted' )
        ->get();
        dd($data);
    }

    //Method to merge Requests table to PR_number column in PPMP
    function prTest() {
        $finalArray = [];
        $myPPMP = DB::connection('mysql_2')
            ->table('ppmp')
            ->select('ppmp.id as mainPPMP_ID','ppmp.*', 'ppmp_items.*')
            ->join('ppmp_items', 'ppmp.general_description', 'ppmp_items.item_id')
            ->where('ppmp.status', '<>', 'deleted')
            ->get();
        $allPRs = DB::connection('mysql_2')
            ->table('requests')
            ->select('requests.id as request_id', 'requests.contentIDs as PR_contents', 'requests.assigned_id as PRR_Number')
            ->where('requests.type','PR')
            ->get();

        $start = 1;
        foreach ($myPPMP as $key => $value) {
            foreach ($allPRs as $key2 => $value2) {
                if ($value2->request_id !== 1) {
                    $explodedVal = explode("yyy", $value2->PR_contents);
                    // dd($explodedVal);
                    foreach ($explodedVal as $key3 => $value3) {
                        // dd($value2);
                        if ($value3 == $value->mainPPMP_ID) {
                            $updateData = array(
                                'pr_number' =>  $value2->PRR_Number,
                            );
                            $finalArray[$value2->request_id][$value3] = $value;

                            try {
                                DB::connection('mysql_2')
                                    ->table('ppmp')
                                    ->where('id', $value3)
                                    ->update($updateData);
                            } catch (\Illuminate\Database\QueryException  $e) {
                                return response()->json([
                                    'error'=> $e->getMessage(),
                                    'status'=> 400
                                ], 400);
                            }
                        }
                    }
                }
            }
        }
        return 'success';
        dd($finalArray);
    }

    function newPurchaseRequests() {
        // get all PPMP with PR
        $myPPMP = DB::connection('mysql_2')
            ->table('ppmp')
            ->select('ppmp.id as mainTablePPMP_ID','ppmp.*', 'ppmp_items.*', 'ppmp.unit AS word_unit', 'procurement_modes.mode as word_MOP'
            , DB::raw('milestones1 + milestones2 + milestones3 + milestones4 + milestones5 + milestones6 + milestones7 + milestones8 + milestones9 + milestones10 + milestones11 + milestones12 as summ') )
            // ,'ppmp.milestones1 + ppmp.milestones2 + ppmp.milestones3 + ppmp.milestones4 + ppmp.milestones5 + ppmp.milestones6 + ppmp.milestones7 + ppmp.milestones8 + ppmp.milestones9 + ppmp.milestones10 + ppmp.milestones11 + ppmp.milestones12 AS qtyTotal')
            ->join('ppmp_items', 'ppmp.general_description', 'ppmp_items.item_id')
            ->join('procurement_modes', 'ppmp.MOP', 'procurement_modes.id')
            // ->join('wfp_activities', 'ppmp.wfp_id', '=', 'wfp_activities.devliverable_id')
            // ->Join('interfacev7.programs', 'wfp_activities.program_id', '=', 'interfacev7.programs.id')
                // ->join('wfp_deliverable', 'wfp_activities.devliverable_id', '=', 'wfp_deliverable.id')
                // ->join('annual_budget_programs', 'wfp_activities.annual_budget_program_id', '=', 'annual_budget_programs.id')
                // ->join('annual_budgets', 'annual_budget_programs.annual_budget_id', 'annual_budgets.id')
                // ->join('fund_sources', 'annual_budgets.fund_source_id', 'fund_sources.id')
                // ->join('fund_source_parents', 'fund_sources.parent_id', 'fund_source_parents.id')
                // ->join('fund_source_types', 'fund_sources.type_id', 'fund_source_types.id')
            ->where('ppmp.status', '<>', 'deleted')
            // ->where('wfp_activities.status', '<>', 'deleted')
            ->where('ppmp.pr_number', '<>', null)
            ->where('ppmp_items.deleted_at', null)
            // ->limit(20)
            ->get();

        // grouped by pr_number
        $myPPMPGrouped = DB::connection('mysql_2')
            ->table('ppmp')
            ->select('ppmp.pr_number')
            // ->select('ppmp.id as mainPPMP_ID','ppmp.*', 'ppmp_items.*')
            // ->join('ppmp_items', 'ppmp.general_description', 'ppmp_items.item_id')
            ->where('ppmp.status', '<>', 'deleted')
            ->where('ppmp.pr_number', '<>', null)
            // ->distinct()
            ->groupBy('pr_number')
            // ->limit(2)
            ->get();

        // foreach ($myPPMP as $key => $value) {
        //     foreach ($myPPMPGrouped as $key2 => $value2) {
        //         if ($value->pr_number == $value2->pr_number) {
        //             // $finalArray
        //         }
        //     }
        // }
        // dd($myPPMPGrouped);
        // dd($myPPMP);

        // $bidders = DB::connection('mysql_2')->table('bidders')
        // ->select('*')
        // ->where('bidder_status', 'complete')
        // ->get();

        $data = [
            // 'myPPMPGrouped' => $myPPMPGrouped,
            'data' => $myPPMP
        ];
        // dd( $data);
        return $data;
    }

    function createPO(Request $request)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/bac/bidderWithBid/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        return  view('_procurement.purchaseOrder')->with('data', $data);
    }

    function createPOItem(Request $request)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/bac/bidderBids/'.$request->post()['bidder_id'].'/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        $input2 = array(
            'link' => '/api/create/pr/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data['officePR'] = $this->getcurl($input2);
        // dd($data);

        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        return  view('_procurement.purchaseOrderItem')->with('data', $data);
    }

    function test(Request $request)
    {
        $data = app('App\Http\Controllers\API\ServicesController')
            ->getRequestHandler('/api/create/pr/');
        return  view('_procurement.purchaseRequest')->with('data', $data);
    }

    function generatePR(Request $request)
    {
        // $input = array(
        //     'link' => '/api/create/wfp',
        //     'apiKey' => $this->getAppkey($this->ControllerKey),
        //     'user' => auth()->user(),
        //     'flash' => $year,
        // );
        // $data = $this->getcurl($input);
        // if (array_key_exists('nokeyerror', $data))
        //     return redirect()->back()->with('error', $data['nokeyerror']);
        // $data['year'] = $year;
    }
}
