<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Traits\APIAccess;
use App\Http\Controllers\Traits\CurlNow;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Controllers\RequestsController;
// use App\Http\Controllers\ProcurementController;

class ServicesController extends Controller
{
    use APIAccess, CurlNow;
    private $ControllerKey = 'wfp';
    private $RequestsController;
    private $ProcurementController;

    public function __construct()
    {
        $this->requestController = new RequestsController();
        $this->ProcurementController = new ProcurementController();
    }

    function redirectAPI(Request $request)
    {
        $input = array(
            'link' => '/api/peak/wfptoppmp/'.$request->post()['myid'],
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        return $data;
    }
    function redirect(Request $request)
    {
        $redirect_year = $request->post()['redirect_year'];
        $input = $request->post();
        foreach($input as $key => $value){
            $exp_key = explode('-', $key);
            if($exp_key[0] == 'hidden_id'){
                 $arr_result[] = $value;
            }
        }
        if(!isset($arr_result)){
            $arr_result = [];
        }
        $input["secDiv"] = implode('xx',$arr_result);

        // // for ID
        $idDetails = null;
        if (isset($input["redirect_value_forID"])) {
            $idDetails = $input["redirect_value_forID"];
        }
        if ($input["redirect_value"] == null) {
            return redirect()->back()->with('error', 'Please check the boxes of the rows you would want to generate. ');
        }
        // // for ID
        switch ($request->post()['redirect_key']) {
            case 'PQES_report_1FYcvEDOHpl':
                return redirect()
                    ->away(config('services.url_exporter').'/api/export/postqual/'.$redirect_year.'/'.$this->exporterKey($this->ControllerKey));
                break;
            case 'PR_request_YtwqD0H2hC':
                // $data = $this->requestController->store($redirect_year, $input["secDiv"], $input["redirect_value"]);
                return redirect()
                    ->away(config('services.url_exporter').'/api/export/xls/pr/'.$redirect_year.'/'.$this->exporterKey($this->ControllerKey).'/'.$input["secDiv"].'/'.$input["redirect_valuepr"]);
                break;
            case 'WFP_Report_YtwqD0H2hC':
                return redirect()
                    ->away(config('services.url_exporter').'/api/export/xls/wfp/'.$redirect_year.'/'.$this->exporterKey($this->ControllerKey).'/'.$input["secDiv"].'/'.$input["redirect_value"]);
                break;
            case 'WFP_Report_allQweRTyui':
                return redirect()
                    ->away(config('services.url_exporter').'/api/export/xls/wfpConsolidated/'.$redirect_year.'/'.$this->exporterKey($this->ControllerKey).'/'.$input["secDiv"].'/'.$input["redirect_value"]);
                break;
            case 'PPMP_Report_ZhCbAqyce':
                return redirect()
                    ->away(config('services.url_exporter').'/api/export/xls/ppmp/'.$redirect_year.'/'.$this->exporterKey($this->ControllerKey).'/'.$input["secDiv"].'/'.$input["redirect_value"]);
                break;
            case 'APP_Report_GlaUnFFnN':
                // dont delete
                // return redirect()
                //     ->away(config('services.url_exporter').'/api/export/xls/APPOffice/'.$redirect_year.'/'.$this->exporterKey($this->ControllerKey).'/'.$input["secDiv"].'/'.$input["redirect_value"]);
                // break;
                return redirect()
                    ->away(config('services.url_exporter').'/api/export/xls/APPOfficeCategory/'.$redirect_year.'/'.$this->exporterKey($this->ControllerKey).'/'.$input["secDiv"].'/'.$input["redirect_value"]);
                break;
            case 'ID_SingleFront_ReThqwpK':
                $idDetails = str_replace("all/","all!!",$idDetails);
                // return config('services.url_sandbox').'/api/id/single/'.$idDetails;
                return redirect()
                    ->away(config('services.url_sandbox').'/api/id/single/'.$idDetails);
                break;
            case 'PO_request_JptRMD0Hq1':
                $ress = $this->ProcurementController->storePurchaseOrder($redirect_year, $input["secDiv"], $input["redirect_value"],$input["bidder_id"],$input["fullponumber"]);
                // dd($ress);
                return redirect()
                    ->away(config('services.url_exporter').'/api/export/xls/po/'.$redirect_year.'/'.$this->exporterKey($this->ControllerKey).'/'.$input["secDiv"].'/'.$input["redirect_value"].'/'.$input["bidder_id"].'/'.$input["fullponumber"]);
                return back();
                break;
            case 'DTRR_dheLF@d':
                // return 'hello';
                return redirect()
                    ->away(config('services.url_exporter').'/api/export/xls/DTRR/'.$redirect_year.'/'.$this->exporterKey($this->ControllerKey).'/'.$input["redirect_value"]);
                break;
            default:
                return redirect()->back()->with('error', 'Please try again! {E19}');
                break;
        }
    }

    function getRequestHandler($link)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => $link.$year, //'/api/create/pr/'
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        return $data;
    }

    function getLength(Request $request){
        $data = $request->post();
        // return $data['tablelen'];
        return redirect()->route('wfp.index',['entries'=> $data['tablelen']]);
    }
}
