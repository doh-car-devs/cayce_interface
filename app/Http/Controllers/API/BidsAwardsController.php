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

class BidsAwardsController extends Controller
{
    use CurlNow, APIAccess;

    private $ControllerKey = 'wfp';

    function index()
    {
        //
    }

    function abstractOfBids()
    {
// return 'hi';
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/bac/abstractCanvas/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
            'flash' => $year,
        );
        $data = $this->getcurl($input);
        // dd('sdfsdf');
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        $data['card_header'] = 'Abstract Of Bids';
        return  view('_bac.abstractBids')->with('data', $data);
    }

    function abstractOfCanvas()
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/bac/abstractCanvas/'.$year,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
            'flash' => $year,
        );
        $data = $this->getcurl($input);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        $data['card_header'] = 'Abstract Of Canvas';
        return  view('_bac.abstract')->with('data', $data);
    }

    function abstractItem($item_id = null)
    {
        if (isset($_COOKIE['year'])) $year = unserialize(base64_decode($_COOKIE['year']));
        else  $year = date('Y');

        $input = array(
            'link' => '/api/bac/abstract/item/'.$year.'/'.$item_id,
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );

        $data = $this->getcurl($input);
        // dd($data);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        $data['year'] = $year;
        return  view('_bac.item')->with('data', $data);
    }

    public function bidderList(Request $request)
    {
        $input = $_GET;
        $input = array(
            'link' => '/api/ajax/bidder/'.$input['term'],
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data = $this->getcurl($input);
        return $data;
    }

    public function bidStore(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/store/bid",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );

        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function bidderWinStore(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/bac/bidder/win/".$request->post()['awardnow'],
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->postcurl($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function postQualEvalReport(Request $request)
    {
        // $input = array(
        //     'form_data' => $request->post(),
        //     'link' => "/api/export/postqual",
        //     'apiKey' => $this->getAppkey($this->ControllerKey),
        //     'flash' => $year,
        // );

        // dd($data);
        // if ($data->status == 400)
        //     return redirect()->back()->with('error', $data->error);
        // return redirect()->back()->with('success', $data->success);
    }

    public function bidderlistPeek(Request $request)
    {
        $bidders = DB::connection('mysql_2')->table('bidders')
            ->select('*')
            ->where('bidder_status', 'complete')
            ->get();

        $data = [
            'data' => $bidders
        ];
        return $data;
    }

    public function bidderStore(Request $request)
    {
        // sleep(1);

        $v = $request->validate([
            'b_name' => 'required|max:255',
            'b_tin' => 'required|max:255',
            'b_address' => 'required|max:255',
        ],
        [
            'b_name.required' => 'The Bidder Name is required',
            'b_tin.required' => 'The Bidder TIN is required',
            'b_address.required' => 'The Bidder Address is required',
        ]);

        $data = array(
            'bidder_name' => $request->b_name,
            'bidder_tin' => $request->b_tin,
            'bidder_address' => $request->b_address,
            'created_at' => Carbon::now()
        );
        DB::beginTransaction();
        try {
            DB::connection('mysql_2')->table('bidders')->insert($data);
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
}
