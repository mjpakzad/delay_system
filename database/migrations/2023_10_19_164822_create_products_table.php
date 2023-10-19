<?php

use App\Enums\ProductStatus;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id')->references('id')->on('vendors')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('image_id')->nullable()->references('id')->on('images')->onUpdate('cascade')->onDelete('cascade');
            $table->string('slug')->unique();
            $table->string('heading');
            $table->mediumText('content')->nullable();
            $table->unsignedInteger('stock')->default(0);
            $table->unsignedBigInteger('price')->default(0);
            $table->unsignedTinyInteger('status')->default(ProductStatus::DRAFT);
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
