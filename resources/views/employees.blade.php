<x-layout>
    <x-slot name="content">
        <section class="content">
            <div class="container-fluid">
                <form action="{{ route('employees') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">Add New Employee</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="firstname">First Name:</label>
                                                <input type="text" name="firstname" id="firstname"
                                                    class="form-control" placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="middlename">Middle Name:</label>
                                                <input type="text" name="middlename" id="middlename"
                                                    class="form-control" placeholder="Middle Name" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="lastname">Last Name:</label>
                                                <input type="text" name="lastname" id="lastname"
                                                    class="form-control" placeholder="Last Name" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="dob">Date of Birth:</label>
                                                <input type="date" name="dob" id="dob" class="form-control"
                                                    placeholder="Date of Birth" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="email">Email:</label>
                                                <input type="email" name="email" id="email" class="form-control"
                                                    placeholder="Email Address" required>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <label for="mobile">Mobile Number:</label>
                                                <input type="number" name="mobile" id="mobile" min="1000000000" max="9999999999" class="form-control"
                                                    placeholder="Mobile Number" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="address">Address:</label>
                                                <textarea name="address" id="address" class="form-control" placeholder="Address" rows="3" required></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <input type="submit" value="Add Employee" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @isset($employees)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card card-outline card-primary">
                                <div class="card-header">
                                    <h3 class="card-title font-weight-bold">All Employees</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body" style="display: block;">
                                    @if ($employees->count() > 0)
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Date of Birth</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Address</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($employees as $employee)
                                                    <tr>
                                                        <td>{{ $employee->firstname }} {{ $employee->middlename }} {{ $employee->lastname }}</td>
                                                        <td>{{ date('d-m-Y', strtotime($employee->dob)) }}</td>
                                                        <td>{{ $employee->email }}</td>
                                                        <td>{{ $employee->mobile }}</td>
                                                        <td>{{ $employee->address }}</td>
                                                        <td></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                    <h2 class="mt-3 mb-4 text-center font-weight-bold">No Employees to Display</h2>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </section>
    </x-slot>
</x-layout>
