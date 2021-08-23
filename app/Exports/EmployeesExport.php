<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Facades\DB;

class EmployeesExport implements FromArray
{
    /**
    * @return \Illuminate\Support\Collection
    */
        protected $emp;

        public function __construct(array $emp)
        {
            $this->invoices = $emp;
        }

        public function array(): array
        {
            return $this->invoices;
        }
        // return $request;
        // $selected = explode("yyy",$request->post()['redirect_value']);
        // return $export = DB::table('employees')

        //     ->whereIn('employees.id', $selected)
        //     ->get();

}
