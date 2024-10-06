<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // TODO: columns to create
        // SELECT
        // guid,
        // username,
        // givenname,
        // sn,
        // title,
        // description,
        // department,
        // mail,
        // manager,
        // memberof,
        // password,
        // remember_token
        // FROM prospira_web.users;
        // plus organization_id instead of company


        Schema::create('users', function (Blueprint $table) {
            $table->uuid('guid')->primary();
            $table->string('username')->unique()->nullable();
            $table->string('company')->nullable();
            $table->string('department')->nullable();
            $table->string('description')->nullable();
            $table->string('displayname')->nullable();
            $table->string('givenname')->nullable();
            $table->string('mail')->nullable();
            $table->string('manager')->nullable();
            $table->text('memberof')->nullable();
            $table->string('name')->nullable();
            $table->string('samaccountname')->nullable();
            $table->string('sn')->nullable();
            $table->string('title')->nullable();
            $table->string('userprincipalname')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignUuId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        Artisan::call('db:seed --class=UserSeeder');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
