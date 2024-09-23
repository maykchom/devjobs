<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacante extends Model
{
    use HasFactory;

    // Esto sirve para decirle a laravel que "ultimo_dia" es una fecha y no un string
    // Servirá más a delante para poder darle formato a la fecha
    protected $casts= ['ultimo_dia'=> 'datetime'];

    protected $fillable = [
        'titulo',
        'salario_id',
        'categoria_id',
        'empresa',
        'ultimo_dia',
        'descripcion',
        'imagen',
        'user_id'
    ];

    // Creamos la relaciones para que sepa que categoria_id es una clave foránea y viene desde otra tabla
    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    // Creamos la relaciones para que sepa que salario_id es una clave foránea y viene desde otra tabla
    public function salario(){
        return $this->belongsTo(Salario::class);
    }

    //Creamos la relacion con candidatos
    public function candidatos()
    {
        return $this->hasMany(Candidato::class)->orderBy('created_at', 'DESC');
    }

    //Relacion 1 a 1, en donde una vacante pertenece a un usuario(reclutador)
    public function reclutador()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
