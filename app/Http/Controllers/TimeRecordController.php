<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\DTO\TimeRecordDTO;
use App\DTO\TimeRecordInputDTO;
use App\Helpers\UniqueIdentifierInterface;
use App\Services\EmployeeServiceInterface;
use App\Services\TimeRecordServiceInterface;
use Illuminate\Http\Request;
use Throwable;

class TimeRecordController extends Controller
{
    public function __construct(
        protected TimeRecordServiceInterface $timeRecordService,
        protected EmployeeServiceInterface $employeeService,
        protected TimeRecordInputDTO $timeRecordInputDTO,
        protected TimeRecordDTO $timeRecordDTO,
        protected UniqueIdentifierInterface $unique,
    ) {}

    public function index(Request $request)
    {
        try{
            $data = $this->timeRecordInputDTO::from($request->all())->all();
            $timeRecords = $this->timeRecordService->getTimeRecordEmployee($data);
            $employees = $this->employeeService->getDataEmployeeOrderByName();
            return view('admin.time_records.index', compact('timeRecords', 'employees'));
        } catch (Throwable $thEx) {
        }
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
