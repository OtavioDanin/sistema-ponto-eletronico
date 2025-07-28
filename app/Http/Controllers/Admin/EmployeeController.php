<?php

namespace App\Http\Controllers\Admin;

use App\DTO\EmployeeDTO;
use App\Http\Controllers\Controller;
use App\Services\EmployeeServiceInterface;
use App\Services\TypeEmployeeServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Throwable;

class EmployeeController extends Controller
{

    public function __construct(
        protected EmployeeServiceInterface $employeeService,
        protected TypeEmployeeServiceInterface $typeEmployeeService,
        protected EmployeeDTO $employeeData,
    ) {}

    public function index()
    {
        try {
            $employees = $this->employeeService->getAll();
            return view('admin.employees.index', compact('employees'));
        } catch (Throwable $thEx) {
        }
    }

    public function create()
    {
        try {
            $types = $this->typeEmployeeService->getAll();
            return view('admin.employees.create', compact('types'));
        } catch (Throwable $thEx) {
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => ['required', 'string', 'max:100'],
                'cpf' => ['required', 'string', 'digits:11', 'unique:employees'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'senha' => ['required', 'confirmed'],
                'type_id' => ['required', 'exists:type_employees,id'],
                'cargo' => ['required', 'string', 'max:255'],
                'cep' => ['nullable', 'string', 'digits:8'],
                'endereco' => ['nullable', 'string', 'max:255'],
                'data_nascimento' => ['required', 'date'],
                'data_admissao' => ['required', 'date'],
            ]);
            $data = $this->employeeData::from($request->all())->all();
            $this->employeeService->save($data);
            return redirect()->route('admin.employees.index')->with('success', 'Funcionário cadastrado com sucesso.');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    public function show(int $id)
    {
        try {
            $employee = $this->employeeService->getById($id);
            $employeeCreator = $this->employeeService->getById($employee['created_by']);
            $employee = (object)$employee;
            $typeEmployee = $this->typeEmployeeService->getById($employee->type_id);
            return view('admin.employees.show', compact('employee', 'employeeCreator', 'typeEmployee'));
        } catch (Throwable $thEx) {
            dd($thEx->getMessage());
        }
    }

    public function edit(string $id)
    {
        try {
            $employee = $this->employeeService->getById($id);
            $typeEmployee = $this->typeEmployeeService->getById($employee['type_id']);
            return view('admin.employees.edit', compact('employee', 'typeEmployee'));
        } catch (Throwable $thEX) {
        }
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:100'],
            'cpf' => ['required', 'string', 'digits:11'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'type_id' => ['required', 'exists:type_employees,id'],
            'cargo' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string'],
            'data_nascimento' => ['required'],
            'data_admissao' => ['required', 'date', Rule::date()->format('Y-m-d')],
            'cep' => ['nullable', 'string', 'digits:8'],
            'endereco' => ['nullable', 'string', 'max:255'],
        ]);
        try {
            $data = $this->employeeData::from($request->all());
            $dataToUpdate = $data->except('unique_employee', 'user_id', 'created_by', 'senha')->toArray();
            $this->employeeService->update($id, $dataToUpdate);
            return redirect()->route('admin.employees.index')->with('success', 'Funcionário atualizado com sucesso.');
        } catch (Throwable $thEx) {
            return back()->with('error', 'Ocorreu um erro ao atualizar o funcionário: ' . $thEx->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $this->employeeService->delete($id);
            return redirect()->route('admin.employees.index')->with('success', 'Funcionário removido com sucesso.');
        } catch (Throwable $thEx) {
            return redirect()->route('admin.employees.index')->with('error', 'Ocorreu um erro ao remover o funcionário.');
        }
    }
}
