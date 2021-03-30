<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operadora extends Model
{
    protected $fillable = [
        'ope_descricao', 'ope_status', 'ope_observacao'
    ];
    protected $table = 'operadora';
    protected $primaryKey = 'ope_codigo';

}
