<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            if (!Schema::hasColumn('doctors', 'experience')) {
                $table->integer('experience')->nullable()->after('bio');
            }
            if (!Schema::hasColumn('doctors', 'gender')) {
                $table->string('gender')->nullable()->after('experience');
            }
        });
    }

    public function down(): void
    {
        Schema::table('doctors', function (Blueprint $table) {
            $table->dropColumn(['experience', 'gender']);
        });
    }
};