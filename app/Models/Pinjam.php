<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pinjam extends Model
{
    use HasFactory,SoftDeletes;

    protected $table='pinjams';
    protected $primarykey='id';
    protected $fillable=['id','buku_id','user_id','tanggal_pinjam','tanggal_pengembalian','status'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function buku():BelongsTo
    {
        return $this->belongsTo(Buku::class);
    }
}
