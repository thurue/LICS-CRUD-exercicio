<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Licitacoes;

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
}
