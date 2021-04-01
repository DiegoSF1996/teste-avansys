<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Operadora;
use App\Descricao;

class DescricaoController extends Controller
{
    //
    function lsOperadoras()
    {
        return response()->json(Operadora::orderBy('ope_codigo')->get(), 200);
    }

    function lsDescricaoPorOperadora(Request $req)
    {
        if (!isset($req->ope_codigo)) {
            $oDescricao = Descricao::orderBy('desc_codigo');
        } else {

            $oDescricao = Descricao::where('ope_codigo', $req->ope_codigo);
        }
        if (isset($req->desc_status)) {
            $oDescricao = $oDescricao->where('desc_status', $req->desc_status);
        }
        $oDescricao =  $oDescricao->get();
        foreach ($oDescricao as $key => $value) {
            $oDescricao[$key]->ope_descricao = $value->operadora->ope_descricao;
        }
        return response()->json($oDescricao, 200);
    }

    function salvar(Request $req)
    {

        $req->validate(['ope_codigo' => ['required'], 'desc_descricao' => ['required'],'desc_status' => ['required']]);
       
        if (isset($req->desc_codigo)) {
            $oDescricao = Descricao::find($req->desc_codigo);
            $oDescricao->desc_descricao = $req->desc_descricao;
            $oDescricao->desc_status = $req->desc_status;
            $oDescricao->save();
        } else {
            Descricao::create([
                'ope_codigo' => $req->ope_codigo,
                'desc_descricao' => $req->desc_descricao,
                'desc_status' => $req->desc_status
            ]);
        }
    }
    function excluirDescricoes(Request $req)
    {
        $descricoes = $req->All();

        foreach ($descricoes as $descricao) {
            if (isset($descricao['desc_check']) && $descricao['desc_check'] == true) {

                $op = Descricao::find($descricao['desc_codigo'])->delete();
            }
        }
        return response()->json();
    }
}
