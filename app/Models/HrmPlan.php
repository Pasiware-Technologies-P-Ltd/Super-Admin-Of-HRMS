<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmPlan extends Model
{
    use HasFactory;

    protected $table = 'hrm_plan';
    protected $fillable = ['plan_name', 'description', 'price', 'employee_per_price', 'employee_capacity', 'status'];
    public $timestamps = false;
}
