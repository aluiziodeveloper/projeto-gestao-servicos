<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAtividadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('atividades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ordem', 30)->nullable();
            $table->string('nota', 30)->nullable();
            $table->string('estacao', 10);
            $table->string('equipamento', 100)->nullable();
            $table->string('tipo', 20)->default('CORRETIVA');
            $table->string('titulo');
            $table->dateTime('data_inicio')->nullable();
            $table->dateTime('data_fim')->nullable();
            $table->string('si', 100)->nullable();
            $table->string('apr', 100)->nullable();
            $table->text('equipe');
            $table->text('relatorio')->nullable();
            $table->boolean('encerrado')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('atividades');
    }
}
