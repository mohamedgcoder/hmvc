<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gen_titles', function (Blueprint $table) {
            $table->id();
            $table->boolean('default')->default(false);
            $table->integer('arrangement')->default(0);
            $table->string('module', 64);

            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('gen_status');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->onUpdate(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();

            $table->string('created_by', 64);
            $table->string('last_updated_by', 64)->nullable();

            $table->softDeletes();

            $table->index(['id', 'default', 'module', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gen_titles');
    }
};
