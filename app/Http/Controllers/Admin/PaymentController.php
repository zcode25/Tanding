<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Payment;
use App\Models\Information;
use App\Models\Contingent;
use App\Models\Register;
use App\Models\Paymentmethod;

class PaymentController extends Controller
{
    public function index(Event $event) {

        $payments = Payment::where('event_id', $event->event_id)->get();

        return view('admin.event.payment.index', [
            'event' => $event,
            'payments' => $payments,
        ]);
    }


    public function detail(Payment $payment) {

        $payment = Payment::where('payment_id', $payment->payment_id)->first();
        $contingent_id = $payment->contingent_id;
        $event_id = $payment->event_id;

        $contingent = Contingent::where('contingent_id', $contingent_id)->first();
        $event = Event::where('event_id', $event_id)->first();

        $registers = Register::with(['category', 'age', 'matchClass', 'athletes'])
        ->where('event_id', $event_id)
        ->where('contingent_id', $contingent_id)
        ->get();

        $totalPrice = Register::where('event_id', $event_id)
        ->where('contingent_id', $contingent_id)
        ->sum('price');

        $payment = Payment::where('event_id', $event_id)
        ->where('contingent_id', $contingent_id)
        ->first();

        $uniqueCode = ($contingent_id + 111) % 1000;
        $totalPayment = $totalPrice + $uniqueCode;

        $paymentmethods = Paymentmethod::all();

        return view('admin.event.payment.detail', [
            'event' => $event,
            'contingent' => $contingent,
            'registers' => $registers,
            'totalPrice' => $totalPrice,
            'uniqueCode' => $uniqueCode,
            'totalPayment' => $totalPayment,
            'payment' => $payment,
            'paymentmethods' => $paymentmethods,
        ]);
    }

    public function store(Request $request, Payment $payment) {
        
        $validatedData = $request->validate([
            'event_id' => 'required',
            'contingent_id' => 'required',
            'status' => 'required',
        ]);

        Payment::where('payment_id', $payment->payment_id)->update([
            'status' => $validatedData['status']
        ]);

        if($validatedData['status'] == 'Approve') {
            Register::where('event_id', $validatedData['event_id'])
            ->where('contingent_id', $validatedData['contingent_id'])
            ->update([
                'status' => 'Match'
            ]);
        } else {
            Register::where('event_id', $validatedData['event_id'])
            ->where('contingent_id', $validatedData['contingent_id'])
            ->update([
                'status' => 'Cancel'
            ]);
        }

        return back()->with('success', 'Data Berhasil Disimpan');
    }
}
