<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = "artikels";

    protected $fillable = ['judul', 'kategori_id', 'isi'];

    public function category()
    {
        return $this->belongsTo(Category::class, 'kategori_id', 'id');
    }
}
