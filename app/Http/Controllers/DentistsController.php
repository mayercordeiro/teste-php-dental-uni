<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DentistsController extends Controller
{
    public function index()
    {
        $dentists = \DB::select("
            SELECT dentistas.*,
            GROUP_CONCAT(especialidades.nome SEPARATOR ', ') as especialidades
            FROM dentistas
            JOIN dentista_especialidade ON dentistas.id = dentista_especialidade.dentista_id
            JOIN especialidades ON dentista_especialidade.especialidade_id = especialidades.id
            GROUP BY dentistas.id
            ORDER BY dentistas.name ASC;
        ");

        $specialities = \DB::select('SELECT * FROM especialidades;');

        return view('index')->with('dentists', $dentists)->with('specialities', $specialities);
    }

    public function store(Request $request)
    {
        $nome = $request->input('nome');
        $email = $request->input('email');
        $cro = $request->input('cro');
        $uf = $request->input('uf');
        $specialitiesForm = $request->input('specform');

        \DB::insert(
            'INSERT INTO dentistas (name, email, cro, cro_uf)
            VALUES (?, ?, ?, ?);', [$nome, $email, $cro, $uf]
        );

        $lastId = (int) \DB::getPdo()->lastInsertId();

        foreach($specialitiesForm as $speciality) {
            \DB::insert(
                'INSERT INTO dentista_especialidade (dentista_id, especialidade_id) VALUES (?, ?);', [$lastId, $speciality]
            );
        }

        return redirect()->back()->with('success', "Dentista '$nome' cadastrado com sucesso!");
    }

    public function destroy(Request $request)
    {
        \DB::insert('DELETE FROM dentista_especialidade WHERE dentista_id=?;', [$request->dentist_id]);
        \DB::insert('DELETE FROM dentistas WHERE id=?;', [$request->dentist_id]);

        return redirect()->back()->with('success', "Dentista '$request->dentist_name' excluído com sucesso!");
    }

    public function edit(Request $request)
    {
        $dentist = \DB::select("
            SELECT dentistas.*,
            GROUP_CONCAT(especialidades.nome SEPARATOR ', ') as especialidades
            FROM dentistas
            JOIN dentista_especialidade ON dentistas.id = dentista_especialidade.dentista_id
            JOIN especialidades ON dentista_especialidade.especialidade_id = especialidades.id
            WHERE dentistas.id = ?
            GROUP BY dentistas.id
            ORDER BY dentistas.name ASC;
        ", [$request->dentist_id]);

        $queryAllSpecialities = \DB::select('SELECT * FROM especialidades;');

        $allSpecialities = array_map(function($speciality) {
            return $speciality->nome;
        }, $queryAllSpecialities);

        $specialities = explode(', ', $dentist[0]->especialidades);

//        dd($allSpecialities, $specialities);

        return view('edit')->with('dentist', $dentist)->with('allSpecialities', $allSpecialities)->with('specialities', $specialities)->with('queryAllSpecialities', $queryAllSpecialities);
    }

    public function update(Request $request)
    {
        $nome = $request->input('nome');
        $email = $request->input('email');
        $cro = $request->input('cro');
        $uf = $request->input('uf');
        $userId = $request->input('userId');
        $specialitiesForm = $request->input('specform');

        \DB::insert('
            UPDATE dentistas
            SET name = ?, email = ?, cro = ?, cro_uf = ?
            WHERE id=?;
        ', [$nome, $email, $cro, $uf, $userId]);

        \DB::insert('DELETE FROM dentista_especialidade WHERE dentista_id=?;', [$userId]);

        foreach($specialitiesForm as $speciality) {
            \DB::insert(
                'INSERT INTO dentista_especialidade (dentista_id, especialidade_id) VALUES (?, ?);', [$userId, $speciality]
            );
        }

        return redirect('/')->with('success', "Dentista '$nome' editado(a) com sucesso!");
    }
}
