<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['group', 'admin'])->default('admin');
            $table->string('module', 64)->nullable();
            $table->string('url', 191)->nullable(); // route name
            $table->integer('group')->nullable();
            $table->integer('parent')->nullable();
            $table->integer('level')->default(0);
            $table->string('icon', 191)->nullable();
            $table->integer('arrangement')->default(10000);

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->onUpdate(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();

            $table->string('created_by', 64);
            $table->string('last_updated_by', 64)->nullable();

            $table->softDeletes();

            $table->index(['module', 'type', 'parent', 'level', 'arrangement']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
}
