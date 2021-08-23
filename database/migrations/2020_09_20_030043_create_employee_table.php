<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('IDNumber')->unique();
            $table->string('type')->default('JC')->comment('DOHCAR, JC, HRH, BEGH, etc..');
            $table->string('fullname');
            $table->string('byname');
            $table->string('designation');
            $table->string('avatar')->unique()->nullable();
            $table->string('division_id')->nullable();
            $table->string('section_id')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
