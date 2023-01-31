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
    public function up()
    {
        Schema::create('project_technology', function (Blueprint $table) {
            //$table->id();

            //RELAZIONE CON I PROGETTI
            //1. creo colonna fk per i progetti
            $table->unsignedBigInteger('project_id');
            //2. creo la fk per questa colonna
            $table->foreign('project_id')
                ->references('id')
                ->on('projects')
                ->cascadeOnDelete(); //all'eleminazione di un tag o progetto viene eliminato il record relativo nella tabella ponte


            //RELAZIONE CON I TAG
            //1. creo colonna fk per i tag
            $table->unsignedBigInteger('technology_id');
            //2. creo la fk per questa colonna
            $table->foreign('technology_id')
                ->references('id')
                ->on('technologies')
                ->cascadeOnDelete();


            //$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_technology');
    }
};
