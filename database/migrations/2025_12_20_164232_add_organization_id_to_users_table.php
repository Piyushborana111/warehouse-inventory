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
        Schema::table('users', function (Blueprint $table) {
            // Add organization_id column
            $table->foreignId('organization_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('organizations')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Drop foreign key and column on rollback
            $table->dropForeign(['organization_id']);
            $table->dropColumn('organization_id');
        });
    }
};
