<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('brand_id');
            $table->string('name');
            $table->string('model')->nullable();
            $table->longText('description')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('image')->nullable();
            $table->double('price',8,2)->nullable();
            $table->boolean('on_discount')->default(0);
            $table->double('discount_percentage', 8, 2)->nullable();
            $table->string('qr_code')->nullable();
            $table->string('bar_code')->nullable();
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
