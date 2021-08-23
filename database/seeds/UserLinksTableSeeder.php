<?php

use Illuminate\Database\Seeder;
use App\UserLink;

class UserLinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('user_links')->delete();
        $file = File::get("database/libraries/usersSidebar.csv");
        $array = explode("\r\n",$file);
        unset($array[0]);
        foreach ($array as $obj) {
            if ($obj !== "") {
                $data = explode(",",$obj);
                DB::table('users')->insert([
                    'id' => $data[0],
                    'user_id' => $data[1],
                    'name' => $data[2],
                    'link' => $data[3],
                    'uri' => $data[4],
                    'link_group' => $data[5]
                ]);
                // UserLink::create(array(
                //     'id' => $data[0],
                //     'user_id' => $data[1],
                //     'name' => $data[2],
                //     'link' => $data[3],
                //     'uri' => $data[4],
                //     'link_group' => $data[5]
                // ));
            }else{
                break;
            }
        }
    }
}
