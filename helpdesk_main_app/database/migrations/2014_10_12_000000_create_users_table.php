<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('status_user_id')->default(1);
            $table->rememberToken();
            $table->timestamps();


            $table->foreign('status_user_id')
                ->references('id')
                ->on('status_users')
                //->onDelete('cascade')
            ;
        });

        /**
         * Using Postgres, add constraint
         */
        if (config('database.default') === 'pgsql') {
            DB::statement('ALTER TABLE users ADD CONSTRAINT users_password_check CHECK (char_length(password) > 7)');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_status_user_id_foreign');
            $table->dropColumn('status_user_id');
        });
        Schema::dropIfExists('users');
    }
};
