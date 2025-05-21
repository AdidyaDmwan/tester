<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Invoice;
use App\Models\Customer;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = Customer::all();

        foreach ($customers as $customer) {
            for ($i = 1; $i <= rand(1, 3); $i++) {
                Invoice::create([
                    'customer_id' => $customer->id,
                    'invoice_number' => 'INV-' . strtoupper(uniqid()),
                    'invoice_date' => now()->subDays(rand(1, 30)),
                    'total_amount' => rand(100000, 500000),
                ]);
            }
        }
    }
}
