<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Licitacoes;

use function PHPUnit\Framework\returnSelf;

class CrudController extends Controller
{
    public function index()
    {
        $lics = Licitacoes::all();

        return view('welcome', ['lics' => $lics]);
    }
    public function Card()
    {
        return view('Card');
    }
    public function add()
    {
        return view('add');
    }
    public function store(Request $request)
    {

        $lics = new Licitacoes;

        $lics->nu_fase = $request->nu_fase;
        $lics->nu_edital = $request->nu_edital;
        $lics->modalidade = $request->modalidade;
        $lics->nome_licitador = $request->nome_licitador;
        $lics->cnpj_licitador = $request->cnpj_licitador;
        $lics->prioridade = $request->prioridade;
        $lics->objeto = $request->objeto;

        $lics->save();

        return redirect('/');
    }
}
