<?php

use App\Enums\InventoryStatus;
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
            $table->string('code', 255);
            $table->string('name', 255);
            $table->text('description');
            $table->string('image');
            $table->string('category', 255);
            $table->float('price');
            $table->integer('quantity');
            $table->string('internalReference', 255);
            $table->integer('shellId');
            $table->enum('inventoryStatus', array_column(InventoryStatus::cases(), 'value'));
            $table->integer('rating');
            $table->timestamps();

            // Making code and name unique, so we dont have duplicate products
            $table->unique(['code', 'name']);

            // Indexing code and name will help facilitate text searchs
            $table->index('code');
            $table->index('name');
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
