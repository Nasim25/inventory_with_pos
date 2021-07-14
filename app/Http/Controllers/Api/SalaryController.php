<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{

    public function salary_paid(Request $request,$id)
    {
        $request->validate([
            'emp_salary'  => 'required',
            'salary_date' => 'required',
            'salary_month' => 'required',
        ]);

        $salaryCheck = Salary::where('employee_id',$id)->where('salary_month',$request->salary_month)->first();

        if($salaryCheck){
            return response()->json('already paid');
        }else{
            $salary = new Salary();
            $salary->employee_id = $id;
            $salary->amount = $request->emp_salary;
            $salary->salary_date = $request->salary_date;
            $salary->salary_month = $request->salary_month;
            $salary->salary_year = date('Y');
            $salary->save();

            return response()->json('Success');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }
}
