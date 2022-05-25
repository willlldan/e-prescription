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
        Schema::create('racikan_obatalkes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('racikan_id');
            $table->unsignedBigInteger('obatalkes_id');
            $table->decimal('qty', 15, 2)->default(0.00);
            $table->foreign('racikan_id')->references('id')->on('racikan');
            $table->foreign('obatalkes_id')->references('obatalkes_id')->on('obatalkes_m');
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
        //
    }
};
