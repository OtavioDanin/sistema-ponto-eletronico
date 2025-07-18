<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->uuid('unique_employee')->unique();
            $table->string('nome', 100);
            $table->string('cpf', 11)->unique();
            $table->string('email')->unique();
            $table->string('senha');
            $table->string('cargo');
            $table->string('cep', 8)->nullable();
            $table->string('endereco')->nullable();
            $table->date('data_nascimento');
            $table->date('data_admissao');
            $table->date('data_desligamento')->nullable();
            $table->string('status')->default('ativo');
            $table->timestamps();
            
            $table->foreignId('user_id')->constrained('users', 'id');
            $table->foreignId('created_by')->constrained('users', 'id');
            $table->foreignId('type_id')->constrained('types_employees', 'id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
