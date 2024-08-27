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
        Schema::create('lookup_social_apps', function (Blueprint $table) {
            $table->id();
            $table->string('name', 64);
            $table->string('logo')->nullable();
            $table->string('icon');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->onUpdate(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();

            $table->string('created_by', 64);
            $table->string('last_updated_by', 64)->nullable();

            $table->softDeletes();

            $table->index('id');
            $table->index('name');
            $table->index('logo');
            $table->index('icon');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lookup_social_apps');
    }
};
