<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (!Schema::hasColumn('books', 'approved')) {
                $table->boolean('approved')->default(true)->after('rating');
            }

            if (!Schema::hasColumn('books', 'views')) {
                $table->unsignedBigInteger('views')->default(0)->after('approved');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'approved')) {
                $table->dropColumn('approved');
            }
            if (Schema::hasColumn('books', 'views')) {
                $table->dropColumn('views');
            }
        });
    }
};
