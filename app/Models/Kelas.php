<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = ['id'];
    protected $table = 'kelas';

    // satu kelas bisa punya banyak peserta
    public function peserta()
    {
        return $this->belongsToMany(Peserta::class, 'pendaftaran', 'kelas_id', 'peserta_id');
    }
}
