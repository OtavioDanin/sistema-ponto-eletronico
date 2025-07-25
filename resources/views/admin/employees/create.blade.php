<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Cadastrar Novo Funcionário') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form method="POST" action="{{ route('admin.employees.store') }}">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="nome" :value="__('Nome Completo')" />
                                <x-text-input id="nome" class="block mt-1 w-full" type="text" name="nome"
                                    :value="old('nome')" required autofocus autocomplete="name" />
                                <x-input-error :messages="$errors->get('nome')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="cpf" :value="__('CPF (somente números)')" />
                                <x-text-input id="cpf" class="block mt-1 w-full" type="text" name="cpf"
                                    :value="old('cpf')" required />
                                <x-input-error :messages="$errors->get('cpf')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="cargo" :value="__('Cargo')" />
                                <x-text-input id="cargo" class="block mt-1 w-full" type="text" name="cargo"
                                    :value="old('cargo')" required />
                                <x-input-error :messages="$errors->get('cargo')" class="mt-2" />
                            </div>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-4">
                            <div class="md:col-span-1">
                                <x-input-label for="cep" :value="__('CEP (Opcional)')" />
                                <x-text-input id="cep" class="block mt-1 w-full" type="text" name="cep" :value="old('cep')" />
                                <x-input-error :messages="$errors->get('cep')" class="mt-2" />
                            </div>
                            <div class="md:col-span-2">
                                <x-input-label for="endereco" :value="__('Endereço Completo')" />
                                <x-text-input id="endereco" class="block mt-1 w-full" type="text" name="endereco" :value="old('endereco')" />
                                <x-input-error :messages="$errors->get('endereco')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="data_nascimento" :value="__('Data de Nascimento')" />
                                <x-text-input id="data_nascimento" class="block mt-1 w-full" type="date"
                                    name="data_nascimento" :value="old('data_nascimento')" required />
                                <x-input-error :messages="$errors->get('data_nascimento')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="data_admissao" :value="__('Data de Admissão')" />
                                <x-text-input id="data_admissao" class="block mt-1 w-full" type="date"
                                    name="data_admissao" :value="old('data_admissao')" required />
                                <x-input-error :messages="$errors->get('data_admissao')" class="mt-2" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <x-input-label for="type_id" :value="__('Tipo de Conta')" />
                            <select name="type_id" id="type_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach ($types as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('type_id') == $type->id ? 'selected' : '' }}>
                                        {{ $type->nome }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('type_id')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                            <div>
                                <x-input-label for="senha" :value="__('Senha')" />
                                <x-text-input id="senha" class="block mt-1 w-full" type="password" name="senha"
                                    required autocomplete="new-senha" />
                                <x-input-error :messages="$errors->get('senha')" class="mt-2" />
                            </div>
                            <div>
                                <x-input-label for="senha_confirmation" :value="__('Confirmar Senha')" />
                                <x-text-input id="senha_confirmation" class="block mt-1 w-full" type="password"
                                    name="senha_confirmation" required autocomplete="new-senha" />
                                <x-input-error :messages="$errors->get('senha_confirmation')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.employees.index') }}"
                                class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Cancelar') }}
                            </a>

                            <x-primary-button>
                                {{ __('Cadastrar') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
    <script>

        $(document).ready(function() {

            function limpa_formulário_cep() {
                $("#cep").val("");
                $("#endereco").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {
                            console.log(dados);
                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#endereco").val(dados.logradouro + " - " + dados.bairro + " - " + dados.localidade + " - " + dados.uf);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        alert("Formato de CEP inválido.");
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });

    </script>
