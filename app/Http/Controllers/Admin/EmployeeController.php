<?php

namespace App\Http\Controllers\Admin;

use App\DTO\EmployeeDTO;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Services\EmployeeServiceInterface;
use App\Services\TypeEmployeeServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            $this->employeeData;
            $data = $this->employeeData::from($request->all())->all();
            $this->employeeService->save($data);
            return redirect()->route('admin.employees.index')->with('success', 'Funcionário cadastrado com sucesso.');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with(['types'])->where("id", $id)->get();
        $createBy = $employee->toArray()[0]['created_by'];
        $user = User::select('name')->where('id', $createBy)->get();
        $employee = (object)$employee->toArray()[0];
        $nameCreator = $user->toArray()[0];
        return view('admin.employees.show', compact('employee', 'nameCreator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $employee = Employee::with(['types'])->where("id", $id)->get();
        $employee = (object)$employee->toArray()[0];
        // dd($employee);
        // $types = TypeEmployee::all();
        return view('admin.employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        // Validação para a atualização
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
            // A senha é opcional, mas se for preenchida, deve ser confirmada
            // 'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);
        // dd($request->all());
        try {
            DB::transaction(function () use ($request, $employee) {

                // 2. Atualiza os dados do usuário associado
                $user = $employee->users;
                // dd($user);
                $user->name = $request->nome;
                $user->email = $request->email;

                $user->save();
                // 1. Atualiza os dados do funcionário
                // dd($employee);
                $employee->update([
                    'nome' => $request->nome,
                    'cpf' => $request->cpf,
                    'email' => $request->email,
                    'cargo' => $request->cargo,
                    'type_id' => $request->type_id,
                    'status' => $request->status,
                    'data_nascimento' => $request->data_nascimento,
                    'data_admissao' => $request->data_admissao,
                    'cep' => $request->cep,
                    'endereco' => $request->endereco,
                ]);
            });
        } catch (\Exception $e) {
            // Em caso de erro, volta para a página de edição com uma mensagem de erro
            return back()->with('error', 'Ocorreu um erro ao atualizar o funcionário: ' . $e->getMessage());
        }

        return redirect()->route('admin.employees.index')->with('success', 'Funcionário atualizado com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        // Para evitar que um admin se auto-delete ou delete o admin principal
        // if ($employee->id === 1 || $employee->id === Auth::user()->employee->id) {
        //     return redirect()->route('admin.employees.index')->with('error', 'Você não pode remover este usuário.');
        // }

        try {
            DB::transaction(function () use ($employee) {
                // O usuário associado será deletado em cascata por causa da foreign key no banco de dados
                // onDelete('cascade') na migration da tabela `employees`.
                // Se não tivesse a cascata, faríamos: $employee->user()->delete();
                // $employee->delete();
                $employee->users->delete(); // Isso deve acionar onDelete('cascade') nos registros de ponto.
                $employee->delete();
            });
        } catch (\Exception $e) {
            return redirect()->route('admin.employees.index')->with('error', 'Ocorreu um erro ao remover o funcionário.');
        }

        return redirect()->route('admin.employees.index')->with('success', 'Funcionário removido com sucesso.');
    }
}
