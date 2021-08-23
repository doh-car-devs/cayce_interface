<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
                $table->string('IDNumber')->unique()->nullable();
                $table->string('prefix');
                $table->string('name');
                $table->string('name_middle')->nullable();
                $table->string('name_family');
                $table->string('byname')->nullable();
                $table->string('designation');
                $table->string('name_extension')->nullable();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->integer('section_id');
                $table->integer('division_id');
                $table->string('access_level', 100)->default(9);
                $table->text('access_tokens')->default('YToxOntzOjU6Im5va2V5IjtzOjU6Im5va2V5Ijt9');
                $table->string('access_group', 50)->default('DOH Employee');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
