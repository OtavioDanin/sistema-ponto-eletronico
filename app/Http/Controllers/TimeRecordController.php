<?php

namespace App\Http\Controllers;

use App\DTO\TimeRecordDTO;
use App\Helpers\UniqueIdentifierInterface;
use App\Models\Employee;
use App\Models\TimeRecord;
use App\Services\TimeRecordServiceInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class TimeRecordController extends Controller
{
    public function __construct(
        protected TimeRecordServiceInterface $timeRecordService,
        protected TimeRecordDTO $timeRecordDTO,
        protected UniqueIdentifierInterface $unique,
    ) {}

    // Método para o Admin visualizar e filtrar os pontos
    public function index(Request $request)
    {
        $query = TimeRecord::with('employee')->latest('recorded_at');

        // Filtro por funcionário
        if ($request->filled('employee_id')) {
            $query->where('employee_id', $request->employee_id);
        }

        // Filtro por período (entre duas datas)
        if ($request->filled('start_date')) {
            $startDate = Carbon::parse($request->start_date)->startOfDay();
            $query->where('recorded_at', '>=', $startDate);
        }

        if ($request->filled('end_date')) {
            $endDate = Carbon::parse($request->end_date)->endOfDay();
            $query->where('recorded_at', '<=', $endDate);
        }

        $timeRecords = $query->paginate(25)->withQueryString(); // withQueryString mantém os filtros na paginação

        // Busca todos os funcionários para popular o dropdown de filtro
        $employees = Employee::orderBy('nome')->get();

        return view('admin.time_records.index', compact('timeRecords', 'employees'));
    }

    public function store(Request $request)
    {
        try {
            $data = $this->timeRecordDTO::from(
                [
                    'unique_record' => $this->unique->generate(),
                    'employee_id' => $request->idEmployee,
                    'recorded_at' => now('America/Sao_Paulo'),
                ]
            )->all();
            $this->timeRecordService->create($data);
            return redirect()->route('dashboard')->with('success', 'Ponto registrado com sucesso!');
        } catch (Throwable $thEx) {
            return redirect()->route('dashboard')->with('error', 'Falha no registro do Ponto registrado!');
        }
    }
}
