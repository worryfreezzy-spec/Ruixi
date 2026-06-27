<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table): void {
            $table->string('footer_logo')->nullable()->after('favicon');
            $table->string('facebook_icon')->nullable()->after('facebook_url');
            $table->string('instagram_icon')->nullable()->after('instagram_url');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table): void {
            $table->dropColumn([
                'footer_logo',
                'facebook_icon',
                'instagram_icon',
            ]);
        });
    }
};
