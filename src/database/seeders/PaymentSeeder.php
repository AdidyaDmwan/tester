<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\Payment;
use App\Models\Customer;
use App\Models\Invoice;

public function run(): void
{
    $customers = User::all();
    $invoices = Invoice::all();

    foreach ($invoices as $invoice) {
        Payment::create([
            'customer_id' => $customers->random()->id,
            'invoice_id' => $invoice->id,
            'amount' => $invoice->total_amount,
            'payment_date' => now()->subDays(rand(0, 30)),
        ]);
    }
}

