<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peserta extends Model
{
    protected $guarded = ['id'];
    protected $table = 'peserta';

    // satu peserta bisa punya banyak kelas
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'pendaftaran', 'peserta_id', 'kelas_id')
                    ->withPivot('id'); // id pendaftaran
    }
}
