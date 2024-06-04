<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('normalisasi_alternatives', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sub_alternative_id');
            $table->double('value');
            $table->timestamps();

            $table->foreign('sub_alternative_id')->references('id')->on('sub_alternatives');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('normalisasi_alternatives');
    }
};
