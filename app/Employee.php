<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'emp_name','emp_phone','emp_email','emp_salary','emp_dateofbirth','emp_address','emp_nid','emp_image',
    ];
}
