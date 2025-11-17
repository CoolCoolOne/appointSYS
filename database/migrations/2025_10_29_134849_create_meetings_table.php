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
        Schema::create('meetings', function (Blueprint $table) {
            $table->id();
            // При удалении ресурса (юнита) удаляем все его слоты. Тут one to many
            $table->foreignId('unit_id')->constrained()->onUpdate('cascade')->onDelete('cascade');
            // Если тайм слот удалён (например слот вчерашнй даты), то пусть информация о встече сохранится. Тут будет one to one. возможно Nullable
            $table->foreignId('slot_id')->constrained()->onUpdate('cascade')->onDelete('set null');
            // запрещаю удалять клиента, если он забронировал хоть что то. Тут будет many to one
            $table->foreignId('client_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->datetime('booked_datetime');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // DB::statement('PRAGMA foreign_keys = OFF;');
        Schema::dropIfExists('meetings');
        // DB::statement('PRAGMA foreign_keys = ON;');

    }
};
