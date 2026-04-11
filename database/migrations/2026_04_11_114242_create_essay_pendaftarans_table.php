<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('essay_pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->text('essay_kontribusi')->nullable(); // Menampung Essay panjang
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('essay_pendaftarans');
    }
};