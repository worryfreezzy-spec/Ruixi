<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table): void {
            $table->string('right_title')->nullable()->after('benefits_title');
            $table->string('left_title')->nullable()->after('right_title');
            $table->text('left_description')->nullable()->after('left_title');
            $table->string('left_image')->nullable()->after('left_description');
            $table->string('advantages_title')->nullable()->after('left_image');
            $table->text('advantages_content')->nullable()->after('advantages_title');
            $table->string('audience_title')->nullable()->after('advantages_content');
            $table->text('audience_content')->nullable()->after('audience_title');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table): void {
            $table->dropColumn([
                'right_title',
                'left_title',
                'left_description',
                'left_image',
                'advantages_title',
                'advantages_content',
                'audience_title',
                'audience_content',
            ]);
        });
    }
};
