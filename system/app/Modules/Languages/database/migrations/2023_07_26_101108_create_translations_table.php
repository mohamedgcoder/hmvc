<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lang_translations', function (Blueprint $table) {
            $table->id();
            $table->integer('key');
            $table->string('value');
            $table->string('lang', 6);
            $table->string('field', 191)->nullable();
            $table->string('module', 64);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->onUpdate(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();

            $table->string('created_by', 64)->nullable();
            $table->string('last_updated_by', 64)->nullable();

            $table->index(['key', 'value', 'lang', 'module']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lang_translations');
    }
};
