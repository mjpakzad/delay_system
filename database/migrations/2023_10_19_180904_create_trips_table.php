<?php

use App\Enums\TripStatus;
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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('courier_id')->references('id')->on('couriers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedSmallInteger('status')->default(TripStatus::ASSIGNED);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
