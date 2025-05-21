<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'invoice_id', 'amount', 'payment_date'];

    public function customer()
{
    return $this->belongsTo(Customer::class);
}

public function invoice()
{
    return $this->belongsTo(Invoice::class);
}

}

