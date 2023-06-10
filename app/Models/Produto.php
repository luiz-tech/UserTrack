<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = ['nome','categoria','qtd_estoque','prazo','preco'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
