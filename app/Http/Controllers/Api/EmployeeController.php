<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Employee;
use Image;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return response()->json($employee);
    }
    public function employname()
    {
        $employee = Employee::select('id','emp_name')->get();
        return response()->json($employee);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'emp_name'          => 'required',
            'emp_phone'         => 'required|unique:employees|max:255',
            'emp_email'         => 'required|unique:employees|max:255',
            'emp_salary'        => 'required',
            'emp_dateofbirth'   => 'required',
            'emp_joiningDate'   => 'required',
            'emp_address'       => 'required',
            'emp_id'           =>  'required|unique:employees|max:255',
            'emp_image'         => 'required',
        ]);

        if($request->emp_image){
            $position = strpos($request->emp_image, ';');
            $sub = substr($request->emp_image, 0 , $position);
            $ext = explode('/',$sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->emp_image)->resize(240,200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $employee = new Employee();
            $employee->emp_name = $request->emp_name;
            $employee->emp_phone = $request->emp_phone;
            $employee->emp_email = $request->emp_email;
            $employee->emp_salary = $request->emp_salary;
            $employee->emp_dateofbirth = $request->emp_dateofbirth;
            $employee->emp_joiningDate = $request->emp_joiningDate;
            $employee->emp_address = $request->emp_address;
            $employee->emp_id = $request->emp_id;
            $employee->emp_image = $image_url;
            $employee->save();
        }else{
            $employee = new Employee();
            $employee->emp_name = $request->emp_name;
            $employee->emp_phone = $request->emp_phone;
            $employee->emp_email = $request->emp_email;
            $employee->emp_salary = $request->emp_salary;
            $employee->emp_dateofbirth = $request->emp_dateofbirth;
            $employee->emp_joiningDate = $request->emp_joiningDate;
            $employee->emp_address = $request->emp_address;
            $employee->emp_id = $request->emp_id;
            $employee->emp_image = 'defaultImage/default.png';
            $employee->save();
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id',$id)->first();
        return response()->json($employee);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emp = Employee::where('id',$id)->first();
        $photo = $emp->emp_image;
        if($photo)
        {
            unlink($photo);
            Employee::where('id',$id)->delete();

        }
    }
}
