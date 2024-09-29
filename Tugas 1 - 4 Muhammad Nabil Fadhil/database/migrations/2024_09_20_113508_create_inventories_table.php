<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->string('ingredient'); // Add ingredient column
            $table->integer('quantity_available');
            $table->timestamp('last_updated')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        // Check if the table exists before attempting to drop the foreign key constraint
        if (Schema::hasTable('inventories')) {
            Schema::table('inventories', function (Blueprint $table) {
                $table->dropForeign(['product_id']);
            });

            // Drop the table
            Schema::dropIfExists('inventories');
        }
    }
};