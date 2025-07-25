<?php

declare(strict_types=1);

namespace App\DTO;

use Spatie\LaravelData\Data;

class EmployeeDTO extends Data
{
    public ?string $unique_employee;
    public ?int $user_id;
    public ?string $type_id;
    public ?int $created_by;
    public ?string $nome;
    public ?string $cpf;
    public ?string $email;
    public ?string $senha;
    public ?string $cargo;
    public ?string $cep;
    public ?string $endereco;
    public ?string $data_nascimento;
    public ?string $data_admissao;
}
