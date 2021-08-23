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
use SebastianBergmann\CodeCoverage\Report\Xml\Unit;

class InventoryController extends Controller
{
    use CurlNow, APIAccess;

    private $ControllerKey = 'wfp';

    public function index()
    {
        //
    }

    public  function userItems(){
        $input = array(
            'link' => '/api/twg/requests',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data['items'] = $this->inventoryGet($input);
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
        $input['allitems'] = array(
            'link' => '/api/reference/wfp',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data['allitems'] = $this->inventoryGet($input['allitems']);
        // dd($data['allitems']);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        return  view('_inventory.userItems')->with('data', $data)
            ->with('data2', $data2)
            ->with('data3', $data3)
            ->with('data4', $data4);
    }
    public function twgIndex()
    {
        $input = array(
            'link' => '/api/twg/requests',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data['items'] = $this->inventoryGet($input);
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
        $input['allitems'] = array(
            'link' => '/api/reference/wfp',
            'apiKey' => $this->getAppkey($this->ControllerKey),
            'user' => auth()->user(),
        );
        $data['allitems'] = $this->inventoryGet($input['allitems']);
        if (array_key_exists('nokeyerror', $data))
            return redirect()->back()->with('error', $data['nokeyerror']);
        return  view('_inventory.twgIndex')->with('data', $data)
            ->with('data2', $data2)
            ->with('data3', $data3)
            ->with('data4', $data4);
    }

    public function requestItem(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/twg/create",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->inventoryPost($input));
        if ($data->status == 401 || $data->status == 501)
            return redirect()->back()->with('error', $data->response);
        return redirect()->back()->with('success', $data->response);
    }

    public function updateReference(Request $request) {
        $postData = $request->post();
        // $data = DB::connection('mysql_2')->table('ppmp_items')
        //     ->where('item_id', $item_id)
        //     ->get();
        // dd($branch.$item_id.$unit.$item_name.$price);
        // dd($request->post());
        // return 'hello boks als';
        // return $post = $request->post();
        // return $item_id;
                // $fItem_name = str_replace('^', ' ', $item_name);
                // $ffItem_name = str_replace('~', '/', $fItem_name);

        $input = array(
            'branch' => $postData['branch'],
            'item_id' => $postData['item_id'],
            'unit' => $postData['unit'],
            'item_name' => $postData['firstCategory'] . ' , ' . $postData['secondCategory'],
            'price' => $postData['itemCost'],
        );
        // return $input;
        // return ($input);
        // return $input;

        try {
            $hello = DB::connection('mysql_2')->table('ppmp_items')
                ->where('item_id', $input['item_id'])
                // ->get();
                ->update($input);
            // return $hello;

            if ($hello == 0) {
                return response()->json([
                    'success' => 'Item does not exist in WFP API but updated in Inventory',
                    'status' => 200
                ], 200);
            }
            // DB::table('wfp_activities')
            //     ->where('devliverable_id', $id)
            //     ->update($input);
        } catch (\Illuminate\Database\QueryException  $e) {
            return response()->json([
                'error'=> $e->getMessage(),
                'status'=> 400
            ], 400);
        }
        return response()->json([
            'success' => 'You have updated a TWG entryyyyy',
            'status' => 200
        ], 200);
        // dd( $data);
    }

    function itemRequestList()
    {
        $data = array(
            'users' => User::all()->toJson(),
        );

        return User::all()->toJson();
    }

    function items()
    {
        $data = array(
            'users' => User::all()->toJson(),
        );
        $test = '[
            {
              "name": "Tiger Nixon",
            },
            {
              "name": "Garrett Winters",
            },
            {
              "name": "Ashton Cox",
            }
          ]';
        return $test;
        return User::all()->toJson();
    }

    public function twgStore(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/store/wfp",
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->inventoryPost($input));
        if ($data->status == 400)
            return redirect()->back()->with('error', $data->error);
        return redirect()->back()->with('success', $data->success);
    }

    public function twgUpdate(Request $request)
    {
        $input = array(
            'form_data' => $request->post(),
            'link' => "/api/twg/update/".$request->post()['id'],
            'apiKey' => $this->getAppkey($this->ControllerKey),
        );
        $data = json_decode($this->inventoryPost($input));
        if ($data->status == 401 || $data->status == 501)
            return redirect()->back()->with('error', $data->response);
        return redirect()->back()->with('success', $data->response);
    }

}
