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
    Schema::create('leads', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->id();
        $table->foreignId('veiculo_id')->constrained('veiculos')->onDelete('cascade');
        $table->string('nome');
        $table->string('email');
        $table->string('telefone');
        $table->string('cidade');
        $table->string('estado');
        $table->text('mensagem');
        $table->timestamp('data')->useCurrent();
        $table->timestamps();
    });
}
};
