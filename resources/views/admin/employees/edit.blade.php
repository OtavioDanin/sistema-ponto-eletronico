<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Funcionário: ') }} <span class="text-indigo-600">{{ $employee->nome }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.employees.update', $employee->id) }}">
                        @csrf
                        @method('PATCH') {{-- ou PUT --}}

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nome" :value="__('Nome Completo')" />
                                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome"
                                    :value="old('nome', $employee->nome)" required autofocus />
                                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="cpf" :value="__('CPF (somente números)')" />
                                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf"
                                    :value="old('cpf', $employee->cpf)" required />
                                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email', $employee->email)" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="cargo" :value="__('Cargo')" />
                                <x-text-input id="cargo" class="block mt-1 w-full" type="text" name="cargo"
                                    :value="old('cargo', $employee->cargo)" required />
                                <x-input-error :messages="$errors->get('cargo')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="cargo" :value="__('CEP')" />
                                <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep"
                                    :value="old('cep', $employee->cep)" required />
                                <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="cargo" :value="__('Endereco')" />
                                <x-text-input id="endereco" class="block mt-1 w-full" type="text" name="endereco"
                                    :value="old('endereco', $employee->endereco)" required />
                                <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />
                                <x-text-input id="data_nascimento" class="block mt-1 w-full" type="date"  
                                    name="data_nascimento" :value="old('data_nascimento', \Carbon\Carbon::parse($employee->data_nascimento)->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="data_admissao" :value="__('Data de Admissão')" />
                                <x-text-input id="data_admissao" class="block mt-1 w-full" type="date" 
                                name="data_admissao" :value="old('data_admissao',\Carbon\Carbon::parse($employee->data_admissao)->format('Y-m-d'))" required />
                                <x-input-error :messages="$errors->get('data_admissao')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="type_id" :value="__('Tipo de Conta')" />
                                <select name="type_id" id="type_id"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="{{ $employee->types['id'] }}" @selected(old('type_id', $employee->type_id) == $employee->types['id'])>
                                        {{ $employee->types['nome'] }}
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('type_id')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="status" :value="__('Status')" />
                                <select name="status" id="status"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <option value="ativo" @selected(old('status', $employee->status) == 'ativo')>Ativo</option>
                                    <option value="inativo" @selected(old('status', $employee->status) == 'inativo')>Inativo</option>
                                </select>
                                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                            </div>
                        </div>

                        <hr class="my-6">
                        <p class="text-sm text-gray-600 mb-4">Deixe os campos de senha em branco para não alterá-la.</p>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.employees.index') }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                {{ __('Cancelar') }}
                            </a>|
                            <x-primary-button>
                                {{ __('Salvar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const dateControl = document.querySelector('input[type="date"]');

</script>