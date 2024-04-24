<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function index()
    {

        $dados = ['nome' => 'João', 'idade' => 30];

        return view('welcome', compact('dados'));
    }
    public function Card()
    {
        return view('Card');
    }
}
