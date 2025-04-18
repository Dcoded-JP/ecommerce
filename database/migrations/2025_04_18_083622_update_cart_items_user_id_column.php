<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, drop foreign key constraint if it exists
        $foreignKeys = DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = DATABASE()
            AND TABLE_NAME = 'cart_items'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        ");

        foreach ($foreignKeys as $foreignKey) {
            $constraintName = $foreignKey->CONSTRAINT_NAME;
            if (str_contains($constraintName, 'user_id')) {
                Schema::table('cart_items', function (Blueprint $table) use ($constraintName) {
                    $table->dropForeign($constraintName);
                });
            }
        }

        // Now that potential foreign keys are dropped, modify column
        DB::statement('ALTER TABLE cart_items MODIFY COLUMN user_id VARCHAR(100)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Change back to unsigned bigint
        DB::statement('ALTER TABLE cart_items MODIFY COLUMN user_id BIGINT UNSIGNED');
        
        // Add foreign key back
        Schema::table('cart_items', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
};
