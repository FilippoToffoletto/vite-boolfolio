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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            /**
             * name
             * slug
             * client_name
             * summary
             * cover_image
             */
            $table->string('name',100);
            $table->string('slug')->unique();
            $table->string('client_name',100);
            $table->text('summary')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('cover_image_original')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
