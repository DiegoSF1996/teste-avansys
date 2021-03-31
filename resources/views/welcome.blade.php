@extends('layouts.app')
@section('corpo')

<div class="container-fluid">
        <router-link class="mr-2" to="/" exact>Cadastro Descrição</router-link>
        <router-link to="/cad_operadora">Cadastro Operadora</router-link>

    <div class="row mt-5 ">
        <div class="col-md-12 ">
            <div class="card ">
                <div class="card-body">

                    <router-view></router-view>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection