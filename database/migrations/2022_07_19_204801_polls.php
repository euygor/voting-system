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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('option1');
            $table->string('option2');
            $table->string('option3');
            $table->enum('status', ['Não iniciada', 'Em andamento', 'Finalizada'])->default('Não iniciada');
            $table->timestamp('date_start');
            $table->timestamp('date_end');
        });

        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->integer('poll_id');
            $table->integer('option1')->default(0);
            $table->integer('option2')->default(0);
            $table->integer('option3')->default(0);
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
        Schema::dropIfExists('polls');
        Schema::dropIfExists('votes');
    }
};
