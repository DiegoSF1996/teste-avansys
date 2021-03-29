<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situacao extends Model
{
    protected $fillable = [
        'sit_descricao'
    ];
    public $timestamps = false;
    protected $table = 'situacao';
    protected $primaryKey = 'sit_codigo';
}
