@extends('layouts.default')

@section('content')
    <section id="form" class="searchArea container">
        @if(session('success'))
            <div class="alert-success">
                <p>{{ session('success') }}</p>
            </div>
        @endif
        <div class="form">
            <h3>Dentistas Cadastrados</h3>
            <div class="searchContainer">
                <form action="/" method="POST">
                    @csrf
                    <label for="nome">NOME DO DENTISTA: <span class="required">*</span></label>
                    <input type="text" id="nome" name="nome" required>

                    <div class="city">
                        <div>
                            <label for="cro">CRO: <span class="required">*</span></label>
                            <input type="number" id="cro" name="cro" class="uf" required>
                        </div>
                        <div>
                            <label for="uf">UF CRO: <span class="required">*</span></label>
                            <input type="text" id="uf" name="uf" required>
                        </div>
                    </div>

                    <label for="email">EMAIL: <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required>

                    <label>ESPECIALIDADES:</label>
                    <span id="ctrl">(Segure CTRL para seleciona mais de uma)</span>

                    <select multiple name="specform[]" required>
                        @foreach($specialities as $specialitie)
                            <option value="{{$specialitie->id}}">{{$specialitie->nome}}</option>
                        @endforeach
                    </select>

                    <div class="infoRequired">
                        <span class="required">*</span>
                        <p>Campos Obrigatórios</p>
                    </div>

                    <input type="submit" value="CADASTRAR">
                </form>

                <div class="result">
                    @foreach($dentists as $dentist)
                        <div class="resultItem">
                            <div class="data">
                                <h4>{{$dentist->name}}</h4>
                                <p>{{$dentist->email}}</p>
                                <p>{{$dentist->cro}} <span>/ {{$dentist->cro_uf}}</span></p>
                                <p>{{$dentist->especialidades}}</p>
                            </div>

                            <div class="infos">
                                <div class="infoItem">
                                    <a href="{{ route('edit', [$dentist->id]) }}">
                                        Editar
                                    </a>
                                </div>
                                <form id="deleteButton" action="{{ route('destroy', [$dentist->id, $dentist->name]) }}" method="POST">
                                    @csrf
                                    <button>
                                        Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

@endsection
