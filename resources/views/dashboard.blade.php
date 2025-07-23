<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="mb-4 font-medium text-sm text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 font-medium text-sm text-red-600">
                            {{ session('error') }}
                        </div>
                    @endif

                    <h3 class="text-lg font-medium text-gray-900">Registrar Ponto</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Clique no botão abaixo para registrar sua entrada ou saída.
                    </p>
                    
                    <form method="POST" action="{{ route('time-records.store') }}" class="mt-4">
                        @csrf
                        <x-primary-button>
                            {{ __('Registrar Meu Ponto Agora') }}
                        </x-primary-button>
                        <input type="hidden" name="idEmployee" value="{{$idEmployee['idEmployee']}}" autocomplete="off">
                    </form>

                    <hr class="my-6">

                    <h3 class="text-lg font-medium text-gray-900">Meus Últimos Registros</h3>
                    <div class="mt-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data e Hora do Registro</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($timeRecords as $record)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            - {{ date('d/m/Y H:i:s', strtotime($record->recorded_at)) }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Nenhum ponto registrado ainda.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>