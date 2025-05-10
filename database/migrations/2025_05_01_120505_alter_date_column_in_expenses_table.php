<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->renameColumn('date', 'spent_at');
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->dateTime('spent_at')->change();
        });

        DB::statement("UPDATE expenses SET spent_at = DATE_FORMAT(spent_at, '%Y-%m-%d 18:30:00')");
    }

    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->date('spent_at')->change();
        });

        Schema::table('expenses', function (Blueprint $table) {
            $table->renameColumn('spent_at', 'date');
        });
    }
};
