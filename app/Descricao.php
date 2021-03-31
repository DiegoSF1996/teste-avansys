<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Descricao extends Model
{
    protected $fillable = [
        'ope_codigo', 'desc_descricao', 'desc_status'
    ];
    protected $table = 'descricao';
    protected $primaryKey = 'desc_codigo';
    function operadora(){
        return $this->belongsTo('App\Operadora','ope_codigo','ope_codigo');
    }
}
