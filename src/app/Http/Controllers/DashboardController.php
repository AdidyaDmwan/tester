<?php

namespace App\Http\Controllers;

use App\Models\Payment;

class DashboardController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['invoice.customer'])->latest()->get();
        return view('dashboard.index', compact('payments'));
    }
}

