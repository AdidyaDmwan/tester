<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['customer_id', 'invoice_number', 'invoice_date', 'total_amount'];

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}

