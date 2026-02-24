<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if id column has AUTO_INCREMENT, if not fix it
        DB::statement("ALTER TABLE visitor_logs MODIFY id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to revert this
    }
};
