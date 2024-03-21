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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->integer('category');
            $table->string('series')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->date('doc_date');
            $table->string('sender')->nullable();
            $table->dateTime('datetimesent')->nullable();
            $table->string('recipient')->nullable();
            $table->dateTime('datetimereceived')->nullable();
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
        Schema::dropIfExists('documents');
    }
};
