<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Traits\APIAccess;
use App\Http\Controllers\Traits\CurlNow;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Cookie;
use Mockery\Undefined;

class RequestsController extends Controller
{
    use CurlNow, APIAccess;
    private $ControllerKey = 'wfp';

    public function store($year, $secDiv, $value) {
        return $year;
    }

    public function updateLastSeen($id){
        DB::table('users')->where('id', auth()->user()->id)->update(['lastActivity' => Carbon::now()]);
    }

    public function showForm(Request $request) {
        if (isset($_COOKIE['TIME-IN'])) $timein = $_COOKIE['TIME-IN'];
        else $timein = null;

        if (isset($_COOKIE['TIME-INNumber'])) $timeinNumber = $_COOKIE['TIME-INNumber'];
        else $timeinNumber = null;

        if (isset($_COOKIE['sessionTemp'])) $sessionTemp = $_COOKIE['sessionTemp'];
        else $sessionTemp = null;

        if (isset($_COOKIE['a'])) $a = $_COOKIE['a'];
        else $a = null;
        if (isset($_COOKIE['b'])) $b = $_COOKIE['b'];
        else $b = null;
        if (isset($_COOKIE['c'])) $c = $_COOKIE['c'];
        else $c = null;
        if (isset($_COOKIE['d'])) $d = $_COOKIE['d'];
        else $d = null;

        if (isset($_COOKIE['fname'])) $fname = $_COOKIE['fname'];
        else $fname = null;
        if (isset($_COOKIE['lname'])) $lname = $_COOKIE['lname'];
        else $lname = null;
        if (isset($_COOKIE['address'])) $address = $_COOKIE['address'];
        else $address = null;
        if (isset($_COOKIE['contact'])) $contact = $_COOKIE['contact'];
        else $contact = null;

        $data['sessionTemp'] = $sessionTemp;
        $data['timenumber'] = $timeinNumber;
        $data['time'] = $timein;

        $data['a'] = $a;
        $data['b'] = $b;
        $data['c'] = $c;
        $data['d'] = $d;

        $data['fname'] = $fname; $data['lname'] = $lname; $data['address'] = $address; $data['contact'] = $contact;

        if($timein){
            return view('_interface.govid-done')
                    ->with('data', $data)
                    ->with('success','You have already filled out your Health Declaration form 😷 ');
        }
        return view('_interface.govid')->with('data', $data);
    }

    public function success(Request $request){
        if (isset($_COOKIE['TIME-IN'])) $timein = $_COOKIE['TIME-IN'];
        else $timein = null;

        if (isset($_COOKIE['TIME-INNumber'])) $timeinNumber = $_COOKIE['TIME-INNumber'];
        else $timeinNumber = null;

        if (isset($_COOKIE['sessionTemp'])) $sessionTemp = $_COOKIE['sessionTemp'];
        else $sessionTemp = null;

        if (isset($_COOKIE['a'])) $a = $_COOKIE['a'];
        else $a = null;
        if (isset($_COOKIE['b'])) $b = $_COOKIE['b'];
        else $b = null;
        if (isset($_COOKIE['c'])) $c = $_COOKIE['c'];
        else $c = null;
        if (isset($_COOKIE['d'])) $d = $_COOKIE['d'];
        else $d = null;

        if (isset($_COOKIE['fname'])) $fname = $_COOKIE['fname'];
        else $fname = null;
        if (isset($_COOKIE['lname'])) $lname = $_COOKIE['lname'];
        else $lname = null;
        if (isset($_COOKIE['address'])) $address = $_COOKIE['address'];
        else $address = null;
        if (isset($_COOKIE['contact'])) $contact = $_COOKIE['contact'];
        else $contact = null;

        $data['fname'] = $fname; $data['lname'] = $lname; $data['address'] = $address; $data['contact'] = $contact;

        $data['sessionTemp'] = $sessionTemp;
        $data['time'] = $timein;
        $data['timenumber'] = $timeinNumber;

        $data['a'] = $a;
        $data['b'] = $b;
        $data['c'] = $c;
        $data['d'] = $d;

        // dd( request()->cookie());
        // dd( $_COOKIE['TIME-IN']);
        if($timein){
            return view('_interface.govid-done')->with('data', $data);
        }
        return redirect()->route('HDF')->with('error', 'Please Fillout the form below for today');
    }

    public function submitForm(Request $request){
        $post = $request->post();
        // $date = Carbon::now()->toDateTimeString();
        $date = now();
        session(['TIME-IN' => $date]);
        // $minutes = 500;
        // $cookie = cookie('TIME-IN', $date, $minutes);
        // $response = new Response('Set Cookie');
        // $response->withCookie(cookie('name', 'MyValue', $minutes));
        $time = setcookie('TIME-IN', $date, time() + (60*60*8), "/");
        $timestring = setcookie('TIME-INNumber', (time() + (60*60*8)), time() + (60*60*8), "/");
        $tempsession = setcookie('sessionTemp', $post['temp'], time() + (60*60*8), "/");
        $a = setcookie('a', $post['1'], time() + (60*60*8), "/");
        $b = setcookie('b', $post['2'], time() + (60*60*8), "/");
        $c = setcookie('c', $post['3'], time() + (60*60*8), "/");
        $d = setcookie('d', $post['4'], time() + (60*60*8), "/");

        $fname = setcookie('fname', $post['first_name'], time() + (60*60*24*14), "/");
        $lname = setcookie('lname', $post['last_name'], time() + (60*60*24*14), "/");
        $address = setcookie('address', $post['address'], time() + (60*60*24*14), "/");
        $contact = setcookie('contact', $post['contact_no'], time() + (60*60*24*14), "/");

        $data = array(
            'temp' => $post['temp'],
            'first_name' => $post['first_name'],
            'second_name' => $post['last_name'],
            'address' => $post['address'],
            'contact_number' => $post['contact_no'],
            '1' => $post['1'],
            '2' => $post['2'],
            '3' => $post['3'],
            '4' => $post['4'],
            'time' => $date,
        );

        DB::beginTransaction();
        try {
            DB::table('govid')->insert($data);
            DB::commit();
        } catch (\Illuminate\Database\QueryException  $e) {
            DB::rollback();
            return response()->json([
                'error'=> $e->getMessage(),
                'status'=> 400
            ], 400);
        }

        if ($post['temp'] >= 37.5 || $post['4'] == 'yes' || $post['3'] == 'yes' || $post['2'] == 'yes' || $post['1'] == 'yes') {
            return redirect()->route('HDF')->with('error',
            'Please approach our safety officer immediately'
            )->with('data', $time)->with('a', $a)->with('b', $b)->with('c', $c)->with('d', $d);
        }
        return redirect()->route('HDF')->with('success',
            'You have submitted your HEALTH DECLARATION FORM. Please show this message in the main entrance. Thank you! 😃'
        )->with('data', $time)->with('a', $a)->with('b', $b)->with('c', $c)->with('d', $d);
    }

    public function qrScan($id = null, $first = null, $last = null, $add = null, $num = null){
        if ($id) {
            $User = array(
                'link' => '/employee/'.$id,
                'apiKey' => $this->getAppkey($this->ControllerKey),
                'user' => auth()->user(),
            );
            $result = $this->HRGet($User);
            $last = strtok($result[0]['name'], ',');

            $first = substr($result[0]['name'], strpos($result[0]['name'], ",") + 1);
            // dd($first);
            $data = array(
                'first_name' => $first,
                'last_name' => $last,
                'add' => $add,
                'num' => $num,
            );
        }else {
            $data = array(
                'first_name' => $first,
                'last_name' => $last,
                'add' => $add,
                'num' => $num,
            );
        }

        return view('_interface.govid')->with('data', $data);
    }

    public function qrSelectService(Request $request){
        return view('_interface.qrService');
    }

    public function profiling(Request $request){
        // return $request;
        $post = $request->post();

        if(!array_key_exists('customCheck1',$post)){
            $post['customCheck1'] = 'no';
        }
        if(!array_key_exists('customCheck2',$post)){
            $post['customCheck2'] = 'no';
        }
        if(!array_key_exists('customCheck3',$post)){
            $post['customCheck3'] = 'no';
        }
        if(!array_key_exists('customCheck4',$post)){
            $post['customCheck4'] = 'no';
        }
        if(!array_key_exists('customCheck5',$post)){
            $post['customCheck5'] = 'no';
        }
        if(!array_key_exists('customCheck6',$post)){
            $post['customCheck6'] = 'no';
        }
        if(!array_key_exists('infection_classification',$post)){
            $post['infection_classification'] = null;
        }

        // dd($post);
        $data = array(
            'userid' => $post['spa'],
            'fname' => $post['ph_number'],
            'fname' => $post['pwd_number'],

            'suffix' => $post['suffix'],
            'fname' => $post['first_name'],
            'mname' => $post['middle_name'],
            'lname' => $post['last_name'],

            'house' => $post['Address_1'],
            'brgy' => $post['Barangay'],
            'mun' => $post['Municipality'],
            'province' => $post['Province'],

            'contact' => $post['contact_number'],
            'civil' => $post['civil'],
            'sex' => $post['sex'],
            'birthday' => $post['birthday'],
            'Age' => $post['age'],

            'employed' => $post['employed'],
            'profession' => $post['profession'],
            'employer_name' => $post['employer'],
            'employer_add' => $post['emp_address'],
            'employer_contact' => $post['emp_number'],

            'pregnant' => $post['pregnant'],
            'alergy' => $post['allergy'],
            'alregies' => $post['allergy'],
            'comor' => $post['customCheck1'],
            'comor2' => $post['customCheck2'],
            'comor3' => $post['customCheck3'],
            'comor4' => $post['customCheck4'],
            'comor5' => $post['customCheck5'],
            'comor6' => $post['customCheck6'],
            'covidd' => $post['goviddd'],
            'covidd_date' => $post['infection_date'],
            'covidd_class' => $post['infection_classification'],
            'created_at' => new \DateTime(),


            // 'covidd_class' => $post['sdf'],
            // 'temp' => $post['temp'],
            // 'first_name' => $post['first_name'],
            // 'second_name' => $post['last_name'],
            // 'address' => $post['address'],
            // 'contact_number' => $post['contact_no'],
            // '1' => $post['1'],
            // '2' => $post['2'],
            // '3' => $post['3'],
            // '4' => $post['4'],
            // 'time' => $date,
        );

        DB::beginTransaction();
        try {
            DB::table('profiling')->insert($data);
            DB::commit();
        } catch (\Illuminate\Database\QueryException  $e) {
            DB::rollback();
            return response()->json([
                'error'=> $e->getMessage(),
                'status'=> 400
            ], 400);
        }
        return redirect()->route('profiling')->with('success','Submitted Entry!');
    }
}
