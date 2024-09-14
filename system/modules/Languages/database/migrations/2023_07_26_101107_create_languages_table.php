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
        Schema::create('lang_languages', function (Blueprint $table) {
            $table->id();
            $table->integer('arrangement');
            $table->string('code', 7);
            $table->string('flag', 7);
            $table->string('direction', 3);

            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('gen_status');

            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->onUpdate(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();

            $table->string('created_by', 64);
            $table->string('last_updated_by', 64)->nullable();

            $table->softDeletes();

            // index
            $table->index(['id', 'code', 'flag', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lang_languages');
    }
};
