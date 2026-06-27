<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table): void {
            if (! Schema::hasColumn('services', 'button_text')) {
                $table->string('button_text')->nullable()->after('intro_description');
            }

            if (! Schema::hasColumn('services', 'button_url')) {
                $table->string('button_url')->nullable()->after('button_text');
            }
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table): void {
            $columns = [];

            if (Schema::hasColumn('services', 'button_text')) {
                $columns[] = 'button_text';
            }

            if (Schema::hasColumn('services', 'button_url')) {
                $columns[] = 'button_url';
            }

            if ($columns !== []) {
                $table->dropColumn($columns);
            }
        });
    }
};
