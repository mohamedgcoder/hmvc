<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('code', 64)->unique(); // ao-admin-5 generated code-4from name
            $table->string('name', 128);
            $table->string('phone', 20)->unique(); // (+20) xxx xxxx xxx
            $table->string('email', 128)->unique();
            $table->integer('gender')->nullable();
            $table->string('profile_pic')->nullable();
            $table->text('additional_notes')->nullable();

            $table->unsignedBigInteger('title')->nullable();
            $table->foreign('title')->references('id')->on('gen_titles');

            $table->unsignedBigInteger('status');
            $table->foreign('status')->references('id')->on('gen_status');
            $table->text('status_message')->nullable();
            $table->boolean('can_update_profile')->default(false);

            $table->string('password', 256)->nullable();
            $table->string('api_token', 1024);
            $table->rememberToken();

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->onUpdate(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();

            $table->string('created_by', 64);
            $table->string('last_updated_by', 64)->nullable();

            $table->softDeletes();

            $table->index(['code', 'name', 'phone', 'email', 'title', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
}
