<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('Users')->delete();
                    // User::create(array(
                    //     'id' => '0',
                    //     'name' => '$data[1]',
                    //     'name_middle' => '$data[2]',
                    //     'name_family' => '$data[3]',
                    //     'email' => '$data[4]',
                    //     'password' => 'bcrypt($data[5])',
                    //     'access_level' => '$data[6]',
                    //     'access_tokens' => '$data[7]',
                    //     'access_group' => '$data[8]',
                    //     'section_id' => '1',
                    //     'division_id' => '1',
                    //     'prefix' => '$data[11]',
                    //     'designation' => '$data[12]',
                    //     'name_extension' => '$data[13]',
                    // ));

        $file = File::get("database/libraries/users.csv");
        $array = explode("\r\n",$file);
        unset($array[0]);
        foreach ($array as $obj) {
          if ($obj !== "") {
            $data = explode(",",$obj);
            User::create(array(
              'id' => $data[0],
              'name' => $data[1],
              'name_middle' => $data[2],
              'name_family' => $data[3],
              'email' => $data[4],
              'password' => bcrypt($data[5]),
            //   'created_at' => now(),
            //   'updated_at' => now(),
              'access_level' => $data[6],
              'access_tokens' => $data[7],
              'access_group' => $data[8],
              'section_id' => $data[9],
              'division_id' => $data[10],
              'prefix' => $data[11],
              'designation' => $data[12],
              'name_extension' => $data[13],
            ));
          }else{
            break;
          }
        }
    }
}
