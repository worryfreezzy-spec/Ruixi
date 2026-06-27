<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table): void {
            $table->text('languages')->nullable()->after('specialty');
            $table->text('branches')->nullable()->after('languages');
            $table->string('detail_url')->nullable()->after('branches');
        });

        DB::statement('ALTER TABLE doctors MODIFY specialty TEXT NULL');
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table): void {
            $table->dropColumn(['languages', 'branches', 'detail_url']);
        });

        DB::statement('ALTER TABLE doctors MODIFY specialty VARCHAR(255) NULL');
    }
};
