<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operadora;

class OperadoraController extends Controller
{
    //
    function listarOperadoras(Request $req)
    {
        $oOperadoras = Operadora::All();

        return response()->json($oOperadoras, 200);
        /* $req->validate(['ope_descricao' => ['required'], 'ope_status' => ['required'], 'ope_observacao' => ['required']]);
        Operadora::create($req); */
    }

    function salvar(Request $req)
    {
        $req->validate(['ope_descricao' => ['required'], 'ope_status' => ['required'], 'ope_observacao' => ['required']]);
        if (isset($req->ope_codigo)) {
            $oOperadora = Operadora::find($req->ope_codigo);
            $oOperadora->ope_descricao = $req->ope_descricao;
            $oOperadora->ope_observacao = $req->ope_observacao;
            $oOperadora->ope_status = $req->ope_status;
            $oOperadora->save();
        } else {

            $oOperadora = Operadora::create($req->All());
        }
        return response()->json($oOperadora, 200);
    }

    function excluirOperadoras(Request $req){
        $operadoras = $req->All();
        
        foreach($operadoras as $operadora ){
            if(isset($operadora['ope_check']) && $operadora['ope_check'] == true){

                $op = Operadora::find($operadora['ope_codigo'])->delete();
            }
        }
        return response()->json();

    }
}
