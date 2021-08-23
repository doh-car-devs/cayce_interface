<?php

use Illuminate\Database\Seeder;
use App\Program;

class ProgramsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('programs')->delete();
      $file = File::get("database/libraries/programs.csv");
      $array = explode("\r\n",$file);
      unset($array[0]);
        foreach ($array as $obj) {
          if ($obj !== "") {
            $data = explode(",",$obj);
            Program::create(array(
              'id' => $data[0],
              'division_id' => $data[1],
              'section_id' => $data[2],
              'program_abbr' => $data[3],
              'program_name' => $data[4],
            ));
          }else{
            break;
        }
      }
    }
}
