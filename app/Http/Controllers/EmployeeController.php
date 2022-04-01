<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    public function getEmployees(Request $request)
    {
        $orderBy = $request->query("orderBy");
        if ($orderBy) {
            $orderBy = explode('_', $orderBy);
            if ($orderBy[1] === "ASC") {
                $employees = Employee::getEmployees()->orderBy($orderBy[0])->get();
            } else {
                $employees = Employee::getEmployees()->orderByDesc($orderBy[0])->get();
            }
        } else {
                $employees = Employee::getEmployees()->get();
        }

        return view('employees/employeeList', ['employees' => $employees]);
    }

    public function getEmployee($id)
    {
        $employee = Employee::find($id);
        if (!$employee) {
            abort(404, 'Zaměstnanec nenalezen');
        }

        $room = $employee->room!==null ? $employee->room() : false;

        $keys = $employee->getKeys();

        return view('employees/employeeDetail', ['employee' => $employee, 'room' => $room, 'keys' => $keys]);
    }

    public function showChangePassword() {
        return view('employees/changePassword');
    }

    public function changePassword(Request $request)
    {
        if($request->input('newPassword') !== $request->input('repeatPassword')) {
            return view('employees/changePassword', ['error' => "Hesla se neschodují"]);
        }
        $employee = Employee::find(Auth::user()->employee_id);

        $employee->password = Hash::make($request->input('newPassword'));

        $employee->save();
        return view('messages/success', ['message' => 'Změna proběhla úspěšně', 'url' => '/employees']);
    }

}
