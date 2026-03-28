<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrmInvoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_no',
        'company_id',
        'billing_type',
        'billing_id',
        'base_amount',
        'gst_amount',
        'total_amount',
        'status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
