<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Mail\EmployeeJoined;
use App\Mail\EmployeeWelcomeMail;
use App\Models\Employee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    public function index()
    {
        $user_id = Auth::user()->id;
        $employees = User::find($user_id)->employees()->orderBy('emp_id', 'asc')->get();
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
            $email = $employee->email;
            $mail = [
                "template" => "employeejoined",
                "email" => $email,
                "body" =>  [
                    "name" => $employee->firstname,
                    "company" => Auth::user()->name,
                    "url" => url('/')
                ]
            ];
            SendEmail::dispatch($mail);
            return redirect()->route('employees');
        } else {
            return redirect()->route('employees')->withErrors(["error" => "Failed to create Employee"]);
        }
    }

    public function delete(Employee $employee)
    {
        $employee->delete();
        return redirect()->route("employees");
    }

    public function edit(Employee $employee)
    {
        $data = compact("employee");
        return view('employees', $data);
    }

    public function update(Employee $employee, Request $request)
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

        $employee->firstname = $request->firstname;
        $employee->middlename = $request->middlename;
        $employee->lastname = $request->lastname;
        $employee->dob = $request->dob;
        $employee->email = $request->email;
        $employee->mobile = $request->mobile;
        $employee->address = $request->address;
        $employee->save();
        return redirect()->route('employees');
    }
}
