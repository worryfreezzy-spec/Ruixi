<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('contact_forms')) {
            Schema::create('contact_forms', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('key')->nullable()->unique();
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        } elseif (! Schema::hasColumn('contact_forms', 'key')) {
            Schema::table('contact_forms', function (Blueprint $table) {
                $table->string('key')->nullable()->unique()->after('name');
            });
        }

        if (! Schema::hasTable('contact_form_fields')) {
            Schema::create('contact_form_fields', function (Blueprint $table) {
                $table->id();
                $table->foreignId('form_id')->constrained('contact_forms')->cascadeOnDelete();
                $table->string('label');
                $table->string('name');
                $table->string('type')->default('text');
                $table->string('placeholder')->nullable();
                $table->boolean('is_required')->default(false);
                $table->boolean('is_active')->default(true);
                $table->unsignedInteger('sort_order')->default(0);
                $table->timestamps();
            });
        }

        if (! Schema::hasTable('contact_submissions')) {
            Schema::create('contact_submissions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('form_id')->nullable()->constrained('contact_forms')->nullOnDelete();
                $table->string('form_key')->nullable()->index();
                $table->string('page')->nullable();
                $table->string('treatment')->nullable();
                $table->string('name');
                $table->string('phone');
                $table->string('email');
                $table->string('referral')->nullable();
                $table->text('comments')->nullable();
                $table->json('data')->nullable();
                $table->string('status')->default('new')->index();
                $table->text('remark')->nullable();
                $table->string('ip_address', 45)->nullable();
                $table->text('user_agent')->nullable();
                $table->timestamps();
            });

            return;
        }

        Schema::table('contact_submissions', function (Blueprint $table) {
            if (! Schema::hasColumn('contact_submissions', 'form_key')) {
                $table->string('form_key')->nullable()->index()->after('form_id');
            }

            if (! Schema::hasColumn('contact_submissions', 'page')) {
                $table->string('page')->nullable()->after('form_key');
            }

            if (! Schema::hasColumn('contact_submissions', 'treatment')) {
                $table->string('treatment')->nullable()->after('page');
            }

            if (! Schema::hasColumn('contact_submissions', 'referral')) {
                $table->string('referral')->nullable()->after('email');
            }

            if (! Schema::hasColumn('contact_submissions', 'comments')) {
                $table->text('comments')->nullable()->after('referral');
            }

            if (! Schema::hasColumn('contact_submissions', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('remark');
            }

            if (! Schema::hasColumn('contact_submissions', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip_address');
            }
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_submissions');
        Schema::dropIfExists('contact_form_fields');
        Schema::dropIfExists('contact_forms');
    }
};
