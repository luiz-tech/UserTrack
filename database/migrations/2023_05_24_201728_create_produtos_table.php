<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();

            // Chave estrangeira para usuários
            $table->unsignedBigInteger('user_id');

            $table->string('nome');
            $table->string('categoria');
            $table->float('preco');
            $table->integer('qtd_estoque');
            $table->integer('prazo');
            $table->timestamps();

            // Relacionamento da chave estrangeira para usuários
            $table->foreign('user_id')->references('id')->on('usuarios')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produtos');
    }
}
