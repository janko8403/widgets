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
        Schema::create('contests', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('idea')->nullable();
            $table->boolean('reg_accepted')->default(0);
            $table->boolean('marketing_accepted')->default(0);
            $table->string('birth_date');
            $table->string('validationString')->nullable();
            $table->boolean('validated')->default(0);
            $table->integer('status')->default(0);
            $table->integer('firstPrize')->default(0);
            $table->integer('secondPrize')->default(0);
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
        Schema::dropIfExists('contests');
    }
};
