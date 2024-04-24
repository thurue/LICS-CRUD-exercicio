<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('licitacoes', function (Blueprint $table) {
            $table->id('id_lic');
            $table->integer('nu_fase')->default(-1);
            $table->char('nu_edital', 80);
            $table->char('modalidade', 255);
            $table->timestamp('data_abertura');
            $table->char('nome_licitador', 255)->nullable();
            $table->char('cnpj_licitador', 25)->nullable();
            $table->smallInteger('prioridade');
            $table->text('objeto');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licitacoes');
    }
};
