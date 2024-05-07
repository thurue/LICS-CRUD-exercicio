<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Licitacoes extends Model
{
    use HasFactory;

    // Define a chave primária personalizada
    protected $primaryKey = 'id_lic';

    protected $fillable = [
        'nome_licitador', // Adicione aqui qualquer outra propriedade que deseja permitir a atribuição em massa
        // Adicione outras propriedades aqui, se necessário
    ];
}