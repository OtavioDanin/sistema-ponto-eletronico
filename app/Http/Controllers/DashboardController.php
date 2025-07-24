<?php

namespace App\Http\Controllers;

use App\Helpers\AuthUser;
use App\Services\EmployeeServiceInterface;
use App\Services\TimeRecordServiceInterface;
use Throwable;

class DashboardController extends Controller
{
    public function __construct(
        protected EmployeeServiceInterface $employeeService,
        protected AuthUser $auth,
        protected TimeRecordServiceInterface $timeRecordService,
    ) {}

    public function index()
    {
        try {
            $data = $this->getDataEmployee();
            return $this->loadEmployee($data);
        } catch (Throwable $thEx) {
            dd($thEx->getMessage());
        }
    }

    public function loadEmployee(array $data)
    {
        if ($data['type_id'] === 1) {
            return $this->loadAdmin();
        }
        return $this->loadEmployeeCommon($data);
    }

    public function loadAdmin()
    {
        return redirect()->route('admin.employees.index');
    }

    public function loadEmployeeCommon(array $data)
    {
        $timeRecords = $this->getDataTimeRecord($data['id']);
        $idEmployee = ['idEmployee' => $data['id']];
        return view('dashboard', compact('timeRecords', 'idEmployee'));
    }

    public function getDataEmployee(): array
    {
        $idUser = $this->auth->getIdUser();
        return $this->employeeService->getDataEmployeeIdByIdUser($idUser);
    }

    public function getDataTimeRecord(string $idEmployee)
    {
        return $this->timeRecordService->getDataByIdEmployee($idEmployee);
    }
}
