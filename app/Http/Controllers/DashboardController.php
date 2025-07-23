<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $employee = $user->employees();
        $employeeArray = $employee->select('id', 'type_id')->get()->toArray();
        if ($employeeArray[0]['type_id'] === 1) {
            return redirect()->route('admin.employees.index');
        }

        $timeRecords = $employee->select("employees.id", "recorded_at")
            ->join("time_records", 'employees.id', '=', 'time_records.employee_id')
            ->where("time_records.employee_id", $employeeArray[0]['id'])
            ->orderBy('time_records.id', 'DESC')
            ->get();
        $idEmployee = ['idEmployee' => $employeeArray[0]['id']];
        return view('dashboard', compact('timeRecords', 'idEmployee'));
    }
}
