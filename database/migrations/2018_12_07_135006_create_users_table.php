<?php

use Illuminate\Support\Facades\Schema;
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
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastbame');
            $table->string('email');
            $table->string('password');
            $table->timestamps();
        });

        // Insert some stuff
        DB::table('users')->insert(
            array(
                'firstname' => 'Tania',
                'lastbame' => 'Sernivka',
                'email' => 'name@domain.com',
                'password' => 'password'
            )
        );
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
