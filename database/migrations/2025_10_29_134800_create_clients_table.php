<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
// use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            // телефон и почта не обязаны быть уникальны. Тк клиент может опечататься.
            // Просто при совпадении с имеющимся будем привязывать его к существующему. 
            // Иначе будем создавать!
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('name_addition')->nullable();
            $table->string('email_addition')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        Schema::dropIfExists('clients');
        // DB::statement('PRAGMA foreign_keys = ON;');
    }
};
