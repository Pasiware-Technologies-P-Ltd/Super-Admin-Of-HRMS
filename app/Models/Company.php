<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';
    protected $fillable = ['company_id', 'name', 'email', 'mobile', 'address', 'company_type', 'state', 'country', 'gst_no', 'status'];
    public $timestamps = true;

    public function subscription()
    {
        return $this->hasOne(HrmSubscription::class, 'company_id', 'company_id');
    }

    public function employeesCount()
    {
        return \DB::table('employees')->where('company_id', $this->company_id)->count();
    }
}
