<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Illuminate\Http\Request;

class ResultsController extends Controller
{
    function healthDeclaration() {
        return view('_results.healthDeclaration');
    }

    function healthDeclarationResults(){
        $govid = DB::table('govid')
            ->select('*', DB::raw('CONCAT(second_name, ", ", first_name) AS second_name'))
            ->orderBy('govid.id')
            ->where('time', '>', DB::raw('DATE_SUB(now(), INTERVAL 28 DAY)'))
            ->get();
        $data = [
            'data' => $govid
        ];
        return $data;
    }

    function healthDeclarationWAlarm(){
        $govid = DB::table('govid')
            ->select('*', DB::raw('CONCAT(second_name, ", ", first_name) AS second_name'))
            ->orderBy('govid.id')
            ->where(function ($query) {
                $query->where('time', '>', DB::raw('DATE_SUB(now(), INTERVAL 28 DAY)'));
            })
            ->Where(function ($query) {
                $query->Where('1' , 'yes')
                ->orWhere('2' , 'yes')
                ->orWhere('3' , 'yes')
                ->orWhere('4' , 'yes')
                ->orWhere('temp' , '>=', '37.5');
            })
            // ->orWhere('1d' , 'yes')
            // ->orWhere('2' , 'yes')
            // ->orWhere('3' , 'yes')
            // ->orWhere('4' , 'yes')
            // ->orWhere('temp' , '>=', '37.5')
            ->get();
        $data = [
            'data' => $govid
        ];
        return $data;
    }
}
