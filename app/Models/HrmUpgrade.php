<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HrmUpgrade extends Model
{
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'company_id');
    }

    public function oldPlan()
    {
        return $this->belongsTo(HrmPlan::class, 'old_plan_id');
    }

    public function newPlan()
    {
        return $this->belongsTo(HrmPlan::class, 'new_plan_id');
    }
}
