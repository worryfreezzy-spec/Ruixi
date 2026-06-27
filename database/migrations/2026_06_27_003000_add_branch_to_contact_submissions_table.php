<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasColumn('contact_submissions', 'branch')) {
            Schema::table('contact_submissions', function (Blueprint $table): void {
                $table->string('branch')->nullable()->after('treatment');
            });
        }

        DB::table('contact_submissions')
            ->whereNull('branch')
            ->whereNotNull('data')
            ->orderBy('id')
            ->each(function (object $submission): void {
                $data = json_decode((string) $submission->data, true);

                if (! is_array($data) || blank($data['branch'] ?? null)) {
                    return;
                }

                DB::table('contact_submissions')
                    ->where('id', $submission->id)
                    ->update(['branch' => $data['branch']]);
            });
    }

    public function down(): void
    {
        if (Schema::hasColumn('contact_submissions', 'branch')) {
            Schema::table('contact_submissions', function (Blueprint $table): void {
                $table->dropColumn('branch');
            });
        }
    }
};
