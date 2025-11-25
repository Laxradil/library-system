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
            if (!Schema::hasColumn('books', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            }

            if (!Schema::hasColumn('books', 'cover')) {
                $table->string('cover')->nullable();
            }

            if (!Schema::hasColumn('books', 'published_at')) {
                $table->date('published_at')->nullable();
            }

            if (!Schema::hasColumn('books', 'genre')) {
                $table->string('genre')->nullable();
            }

            if (!Schema::hasColumn('books', 'rating')) {
                $table->unsignedTinyInteger('rating')->default(0);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            if (Schema::hasColumn('books', 'user_id')) {
                $table->dropConstrainedForeignId('user_id');
            }
            if (Schema::hasColumn('books', 'cover')) {
                $table->dropColumn('cover');
            }
            if (Schema::hasColumn('books', 'published_at')) {
                $table->dropColumn('published_at');
            }
            if (Schema::hasColumn('books', 'genre')) {
                $table->dropColumn('genre');
            }
            if (Schema::hasColumn('books', 'rating')) {
                $table->dropColumn('rating');
            }
        });
    }
};
