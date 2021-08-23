<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiling', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('mname');
            $table->string('lname');

            $table->string('house');
            $table->string('brgy');
            $table->string('mun');

            $table->string('contact');
            $table->string('sex');
            $table->string('birthday');
            $table->string('Age');

            $table->string('employed')->default('no');
            $table->string('profession')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('employer_add')->nullable();
            $table->string('employer_contact')->nullable();

            $table->string('pregnant')->default('no');
            $table->string('alergy')->nullable();
            $table->string('alregies')->nullable();
            $table->string('comor')->nullable();

            $table->string('covidd');
            $table->string('covidd_date')->nullable();
            $table->string('covidd_class')->nullable();

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
        Schema::dropIfExists('profiling');
    }
}
