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

class BudgetController extends Controller
{
    use CurlNow, APIAccess;

    private $ControllerKey = 'wfp';

    function index()
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/budget/home',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        return  view('_wfp.index')->with('data', $data);
    }

    function annual()
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/budget/annbudget',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
            'flash' => $year,
        );
        $data = $this->getcurl($input);
        // dd($data['annualPrograms']);

        $data['allocatedTotals'][count($data['allocatedTotals'])] = ['annualAllocatedNep'=> 'none', 'fund_source_id' => 0];
        foreach ($data['annual'] as $key => $value) {
            if (!array_key_exists('remainingNEP', $data['annual'][$key])) {
                $data['annual'][$key]['remainingNEP'] = $value['NEP'];
            }
        }

        if (array_key_exists('nokeyerror', $data))
        return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        return  view('_budget.index')->with('data', $data);
    }

    function annualStore(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/budget/storeannbudget",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    function allocateDivisionStore(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/budget/storedivbudget",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    function editallocateDivisionStore(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/budget/editDivisionBudget",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        // return $this->postcurl($input);
        $data = json_decode($this->postcurl($input));
        // return $data;
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    function sourceStore(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/budget/sourceStore",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        // dd($this->postcurl($input));
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }
}
