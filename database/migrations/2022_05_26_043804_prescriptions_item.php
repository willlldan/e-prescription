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
        Schema::create('prescriptions_item', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('prescription_id');
            $table->unsignedBigInteger('racikan_id')->nullable();
            $table->unsignedBigInteger('obatalkes_id')->nullable();
            $table->unsignedBigInteger('signa_id');
            $table->decimal('qty', 15, 2)->default(0.00);
            $table->foreign('prescription_id')->references('id')->on('prescriptions');
            $table->foreign('racikan_id')->references('id')->on('racikan');
            $table->foreign('obatalkes_id')->references('obatalkes_id')->on('obatalkes_m');
            $table->foreign('signa_id')->references('signa_id')->on('signa_m');
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
        Schema::dropIfExists('prescriptions_item');
    }
};
