<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operadora extends Model
{
    protected $fillable = [
        'ope_descricao'
    ];
    protected $table = 'operadora';
    protected $primaryKey = 'ope_codigo';

    function descricoes()
    {
        return $this->hasMany('App\Descricao', 'ope_codigo', 'ope_codigo');
    }
}
