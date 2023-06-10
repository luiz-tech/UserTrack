<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model 
{   
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = ['nome','email','password','prazo','cpf','nivel'];

    public function produto()
    {
        return $this->hasMany(Product::class);
    }
}
