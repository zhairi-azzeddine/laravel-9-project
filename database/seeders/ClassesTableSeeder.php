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
            ["libelle"=>"TCS/TCL"],
            ["libelle"=>"3éme année collégiale"],
            ["libelle"=>"2éme année collégiale"],
            ["libelle"=>"1ére année collégiale"],
            ["libelle"=>"6éme année primaire"],
            ["libelle"=>"5éme année primaire "],
            ["libelle"=>"4éme année primaire "],
            ["libelle"=>"3éme année primaire "],
            ["libelle"=>"2éme année primaire "],
            ["libelle"=>"1ére année primaire "],
        ]);
    }
}
//POUR EXECUTER LES SEEDER 

// => "php artisan db:seed --class=ClassesTableSeede"   to specify a specific seeder class to run individually
// => "php artisan db:seed"    command runs the Database\Seeders\DatabaseSeeder