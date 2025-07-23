<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TimeRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TimeRecordController extends Controller
{
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
        $employee_id = $request->all('idEmployee');
        TimeRecord::create([
            'unique_record' => Str::uuid(),
            'employee_id' => $employee_id['idEmployee'],
            'recorded_at' => now(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Ponto registrado com sucesso!');
    }
}