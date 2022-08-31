<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("classes")->insert([
            ["libelle"=>"2BAC"],
            ["libelle"=>"1BAC"],
            ["libelle"=>"5éme"],
            ["libelle"=>"4éme"],
            ["libelle"=>"3éme"],
            ["libelle"=>"2éme"],
            ["libelle"=>"Premiére"],
        ]);
    }
}
