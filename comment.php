Route::get("/test", function(){
    $user = User::find("1");

    // $employee = new Employee();
    // $employee->user = $user->id;
    // $employee->firstname = "Jay";
    // $employee->middlename = "Kamleshbhai";
    // $employee->lastname = "Rathod";
    // $employee->dob = "2001-01-01";
    // $employee->email = "jay@gmail.com";
    // $employee->mobile = "88558855";
    // $employee->address = "Vadoara";
    // $employee->save();
    // print_r($employee->toArray());
    echo "<pre>";
    $employee = Employee::find(2);
    print_r($employee->toArray());
    // print_r($employee->user()->get()->toArray());
    print_r($user->employees()->get()->toArray());
    // return $user->toArray();

    // $table->integer('user');
    // $table->foreign('user')->references('id')->on('users')->onDelete("cascade");
    // $table->string('firstname');
    // $table->string('middlename');
    // $table->string('lastname');
    // $table->date('dob');
    // $table->text('email');
    // $table->string('mobile');
    // $table->string('address');
});