<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //pour la creation de la table
    {
        Schema::create('etudiants', function (Blueprint $table) {
            $table->id();
            $table->string("nom");
            $table->string("prenom");
            $table->string("photo");
            $table->string("cv");
            $table->foreignId("classe_id")->constrained("classes");
            $table->string("cni");
            $table->string("codemassar");
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints(); // activer ou désactiver les contraintes de clé étrangère dans vos migrations 

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //pour la suppretion de la table
    {
        Schema::table("etudiants",function(Blueprint $table){
            $table->dropConstrainedForeignId("classe_id");
        });
        Schema::dropIfExists('etudiants');
    }
};   // POUR EXECUTER LES TABLE SUR MYSQL "php artisan migrate"
