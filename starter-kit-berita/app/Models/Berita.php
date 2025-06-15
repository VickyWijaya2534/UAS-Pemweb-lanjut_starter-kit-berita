<?php

// app/Models/Berita.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'konten',
        'gambar',
        'status',
        'user_id',
        'kategori_id',
        'editor_id',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke model Kategori (satu berita hanya punya satu kategori).
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi ke model User sebagai penulis (wartawan).
     */
    public function penulis(): BelongsTo
    {
        // Nama method 'penulis' agar lebih deskriptif
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke model User sebagai editor.
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'editor_id');
    }
}