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

class ExportController extends Controller
{
    use CurlNow, APIAccess;

    private $ControllerKey = 'wfp';

    public function postQualEvalReport(Request $request)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y'); 

                                // $input = array(
                                //     'link' => "/api/twg/export/postqualevalreport/".$year,
                                //     'apiKey' => $this->getAppkey($this->ControllerKey),
                                //     'user' => auth()->user(),
                                // );

                                // $data = $this->getcurl($input);
                                // dd($data);
        $input = array(
            'link' => "/api/export/postqual/".$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );

        $data = $this->exporter($input);
        // dd($data);
        
                // if ($data->status == 400)
                //     return redirect()->back()->with('error', $data->error);
                // return redirect()->back()->with('success', $data->success);

                    // $export = array(
                    //     'form_data' => $request->post(),
                    //     'link' => "/api/export/postqual",
                    //     'apiKey' => $this->exporter($this->ControllerKey),
                    // );

                    // $data = json_decode($this->postcurl($input));
                    // if ($data->status == 400)
                    //     return redirect()->back()->with('error', $data->error);
                    // return redirect()->back()->with('success', $data->success);
    }
}
