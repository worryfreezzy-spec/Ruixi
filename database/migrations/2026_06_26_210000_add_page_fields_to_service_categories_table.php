<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_categories', function (Blueprint $table): void {
            $table->string('hero_title')->nullable()->after('type');
            $table->string('hero_image')->nullable()->after('hero_title');
            $table->string('intro_title')->nullable()->after('hero_image');
            $table->text('intro_description')->nullable()->after('intro_title');
            $table->string('symptom_title')->nullable()->after('intro_description');
            $table->text('symptom_description')->nullable()->after('symptom_title');
            $table->string('symptom_image')->nullable()->after('symptom_description');
            $table->text('symptoms')->nullable()->after('symptom_image');
        });
    }

    public function down(): void
    {
        Schema::table('service_categories', function (Blueprint $table): void {
            $table->dropColumn([
                'hero_title',
                'hero_image',
                'intro_title',
                'intro_description',
                'symptom_title',
                'symptom_description',
                'symptom_image',
                'symptoms',
            ]);
        });
    }
};
