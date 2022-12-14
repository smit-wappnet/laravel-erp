<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $employees = User::find($user_id)->employees()->get();
        // return $employees->toArray();
        $data = compact("employees");
        return view('employees', $data);
    }

    public function create(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'middlename' => 'required',
            'lastname' => 'required',
            'dob' => 'required',
            'email' => 'required|email',
            'mobile' => 'required|min:10|numeric',
            'address' => 'required',
        ]);

        $user_id = Auth::user()->id;

        $employee = new Employee();
        $employee->user = $user_id;
        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->lastname = $request->lastname;
        $employee->dob = $request->dob;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->address = $request->address;

        if ($employee->save()) {
            return redirect()->route('employees');
        } else {
            return redirect()->route('employees');
        }
    }
}
