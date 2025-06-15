<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_beritas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beritas', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique();
            $table->text('konten');
            $table->string('gambar'); // Menyimpan path ke file gambar
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');

            // Relasi ke tabel users sebagai penulis (wartawan)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // Relasi ke tabel kategoris
            $table->foreignId('kategori_id')->constrained('kategoris')->onDelete('cascade');

            // ID Editor yang melakukan approval (bisa null)
            $table->foreignId('editor_id')->nullable()->constrained('users')->onDelete('set null');

            $table->timestamp('published_at')->nullable(); // Waktu berita dipublish
            $table->timestamps(); // created_at dan updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beritas');
    }
};