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
        // Update enum values for 'status' column in 'ekyc_registration' table
        DB::statement("ALTER TABLE ekyc_registration MODIFY COLUMN status ENUM('draft', 'submitted', 'accepted', 'rejected') DeFAULT 'draft");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert enum values for 'status' column in 'ekyc_registration' table
        DB::statement("ALTER TABLE ekyc_registration MODIFY COLUMN status ENUM('draft', 'submitted') DEFAULT 'draft");
    }
};
