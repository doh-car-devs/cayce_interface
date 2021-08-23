<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call('UsersTableSeeder');
        $this->command->info('============Users Table Seeded!============');

        $this->call('DivisionsAndSectionsTableSeeder');
        $this->command->info('============Divisions & Sections Table Seeded!============');

        $this->call('ProgramsTableSeeder');
        $this->command->info('============Programs Table Seeded!============');

        $this->call('UserLinksTableSeeder');
        $this->command->info('============UserLinks Table Seeded!============');
    }
}
