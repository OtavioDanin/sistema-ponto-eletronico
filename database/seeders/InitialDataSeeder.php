<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Employee;
use App\Models\TypeEmployee;
use Illuminate\Support\Str;

class InitialDataSeeder extends Seeder
{
    public function run(): void
    {
        $adminType = TypeEmployee::create(['nome' => 'Administrador', 'descricao' => 'Acesso total ao sistema']);
        $subordinateType = TypeEmployee::create(['nome' => 'Funcionário', 'descricao' => 'Acesso para registro de ponto']);

        $adminUser = User::create([
            'name' => 'Admin Master',
            'email' => 'admin@ponto.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        $subordinateUser = User::firstOrCreate(
            ['email' => 'funcionario@ponto.com'],
            [
                'name' => 'Funcionário Teste',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $adminEmployee = Employee::create([
            'unique_employee' => Str::uuid(),
            'user_id' => $adminUser->id,
            'type_id' => $adminType->id,
            'created_by' => 1,
            'nome' => 'Administrador Principal',
            'cpf' => '11122233344',
            'email' => 'admin@ponto.com',
            'senha' => Hash::make('password'),
            'cargo' => 'Gerente de TI',
            'data_nascimento' => '1990-01-01',
            'data_admissao' => '2025-01-01',
            'status' => 'ativo',
        ]);

        $adminEmployee->created_by = $adminEmployee->id;
        $adminEmployee->save();

        Employee::create([
            'user_id' => $subordinateUser->id,
            'unique_employee' => Str::uuid(),
            'created_by' => $adminEmployee->id, 
            'type_id' => $subordinateType->id,
            'nome' => $subordinateUser->name,
            'cpf' => '26047285082',
            'email' => $subordinateUser->email,
            'senha' => Hash::make('password'),
            'cargo' => 'Analista Jr.',
            'data_nascimento' => '1998-07-19',
            'data_admissao' => now(),
            'status' => 'Ativo',
        ]);
    }
}
