<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    protected $table = 'obat';

    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];

    // Relasi ke tabel perantara
    public function detailPeriksas(): HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }

    // SHORTCUT: Relasi Many-to-Many langsung ke tabel Periksa
    // Berguna untuk mencari "Obat ini dipakai di pemeriksaan mana saja?"
    public function periksas(): BelongsToMany
    {
        return $this->belongsToMany(Periksa::class, 'detail_periksa', 'id_obat', 'id_periksa')
                    ->withTimestamps();
    }
}