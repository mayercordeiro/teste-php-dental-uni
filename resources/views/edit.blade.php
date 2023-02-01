@extends('layouts.default')

@section('content')
    <div class="editPage">
        <h3>Editar Cadastro</h3>
        <form action="/edit" method="POST">
            @csrf
            <label for="nome">NOME DO DENTISTA: <span class="required">*</span></label>
            <input
                type="text"
                id="nome"
                name="nome"
                @isset($dentist[0]->name)value="{{$dentist[0]->name}}" @endisset
                required
            >

            <label for="cro">CRO: <span class="required">*</span></label>
            <input
                type="number"
                id="cro"
                name="cro"
                @isset($dentist[0]->cro)value="{{$dentist[0]->cro}}" @endisset
                required
            >

            <label for="uf">UF CRO: <span class="required">*</span></label>
            <input
                type="text"
                id="uf"
                name="uf"
                @isset($dentist[0]->cro_uf)value="{{$dentist[0]->cro_uf}}" @endisset
                required
            >

            <label for="email">EMAIL: <span class="required">*</span></label>
            <input
                type="email"
                id="email"
                name="email"
                @isset($dentist[0]->email)value="{{$dentist[0]->email}}" @endisset
                required
            >

            <label for="specform">ESPECIALIDADES: <span id="ctrl">(Segure CTRL para seleciona mais de uma)</span></label>

            <select id="specform" multiple name="specform[]" required>
                @for($i = 0; $i < sizeof($queryAllSpecialities); $i++)
                    <option value="{{$queryAllSpecialities[$i]->id}}"
                            @if(in_array($queryAllSpecialities[$i]->nome, $specialities))
                                selected
                            @endif
                    >{{$queryAllSpecialities[$i]->nome}}</option>
                @endfor
            </select>

            <div class="infoRequired">
                <span class="required">*</span>
                <p>Campos Obrigatórios</p>
            </div>

            <input
                type="hidden"
                id="userId"
                name="userId"
                @isset($dentist[0]->id)value="{{$dentist[0]->id}}" @endisset
            >

            <input id="btnSave" type="submit" value="SALVAR EDIÇÕES">
        </form>
    </div>
@endsection
