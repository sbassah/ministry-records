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
        $this->call(SchoolClassTableSeeder::class);
        $this->call(ChurchClassTableSeeder::class);
        $this->call(SalutationsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
