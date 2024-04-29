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
    public function show($id_lic)
    {

        // $LicUni = Licitacoes::findOrFail($id_lic, ['id_lic']);
        $licUni = Licitacoes::where('id_lic', $id_lic)->firstOrFail();


        return view('Lics', ['licUni' => $licUni]);

        // return redirect('Lics','/lics/' . $licUni->id_lic);
    }

    public function destroy($id_lic)
    {

        $licUni = Licitacoes::where('id_lic', $id_lic)->delete();

        return redirect('/')->with('msg', 'licitacao deletada com sucesso');
    }
}
