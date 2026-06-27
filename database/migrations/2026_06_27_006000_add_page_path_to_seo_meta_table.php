<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('seo_meta', function (Blueprint $table): void {
            $table->string('page_path')->nullable()->after('id')->unique();
            $table->boolean('is_active')->default(true)->after('canonical_url');
        });
    }

    public function down(): void
    {
        Schema::table('seo_meta', function (Blueprint $table): void {
            $table->dropUnique(['page_path']);
            $table->dropColumn(['page_path', 'is_active']);
        });
    }
};
