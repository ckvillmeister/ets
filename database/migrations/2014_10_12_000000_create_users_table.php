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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('lastname');
            $table->string('username')->unique();
            $table->string('password');
            $table->tinyInteger('role')->default(2);
            $table->rememberToken();
            $table->tinyInteger('created_by')->default(1);
            $table->date('created_at')->default(now());
            $table->tinyInteger('updated_by')->nullable();
            $table->date('updated_at')->nullable();
            $table->tinyInteger('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
