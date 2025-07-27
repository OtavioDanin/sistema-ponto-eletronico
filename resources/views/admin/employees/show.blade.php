<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalhes do Funcionário') }}
            </h2>
            <div class="flex items-center space-x-2">
                <a href="{{ route('admin.employees.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md text-xs hover:bg-gray-600">
                    &#x2190; Voltar para a Lista
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">
                    
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">

                         <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Gestor</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $employeeCreator['nome'] ?? 'N/A' }}</dd>
                        </div>

                    </dl>
                    
                </div>
            </div>
        </div>
        <div></div>
        <br>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 space-y-4">

                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Nome Completo</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $employee->nome }}</dd>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-lg">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $employee->status === 'ativo' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($employee->status) }}
                                </span>
                            </dd>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">E-mail</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $employee->email }}</dd>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">CPF</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $employee->cpf }}</dd>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Cargo</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $employee->cargo }}</dd>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">CEP</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $employee->cep ?? 'Não informado' }}</dd>
                        </div>
                        <div class="p-3 bg-gray-50 rounded-lg md:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Endereço Completo</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $employee->endereco ?? 'Não informado' }}</dd>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Tipo de Conta</dt>
                            <dd class="mt-1 text-lg text-gray-900">{{ $typeEmployee->name ?? 'Não Informado' }}</dd>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Data de Admissão</dt>
                            <dd class="mt-1 text-lg text-gray-900">
                                {{ \Carbon\Carbon::parse($employee->data_admissao)->format('d/m/Y') }}</dd>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Data de Nascimento</dt>
                            <dd class="mt-1 text-lg text-gray-900">
                                {{ \Carbon\Carbon::parse($employee->data_nascimento)->format('d/m/Y') }}</dd>
                        </div>

                        <div class="p-3 bg-gray-50 rounded-lg">
                            <dt class="text-sm font-medium text-gray-500">Data de Cadastro no Sistema</dt>
                            <dd class="mt-1 text-lg text-gray-900">
                                {{ \Carbon\Carbon::parse($employee->created_at)->format('d/m/Y \à\s H:i:s') }}</dd>
                        </div>
                    </dl>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
