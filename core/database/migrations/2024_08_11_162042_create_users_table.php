<?php

use App\Models\Organization;
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
        // password,
        // remember_token
        // FROM users;
        // plus organization_id instead of company


        Schema::create('users', function (Blueprint $table) {
            $table->uuid('guid')->primary();
            $table->foreignIdFor(Organization::class);
            $table->string('username')->unique()->nullable();
            $table->string('first_name')->nullable(); // givenname
            $table->string('last_name')->nullable(); // sn
            $table->string('display_name')->nullable(); // displayname
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('department')->nullable();
            $table->string('email')->nullable(); // mail
            $table->string('domain')->nullable();
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
