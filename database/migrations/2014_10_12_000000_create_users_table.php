<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id'); //customer_id
            $table->integer('emp_id')->nullable();
            $table->integer('branch_id')->nullable(); //verify emp belongs to which branch
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->date('dob');
            $table->longText('address');
            $table->string('contact_no');
            $table->longText('image')->nullable();
            $table->enum('gender',['male','female']);
            $table->integer('state_id');
            $table->integer('city_id');
            $table->date('hire_date')->nullable();
            $table->integer('salary')->nullable();
            $table->string('status')->default('active');
            $table->string('remember_token')->nullable();

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
        Schema::dropIfExists('users');
    }
}
