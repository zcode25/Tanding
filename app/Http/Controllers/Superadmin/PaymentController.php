<?php

namespace App\Http\Controllers\Superadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Paymentmethod;

class PaymentController extends Controller
{
    public function index() {
        $title = 'Delete Data!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        $payments = Paymentmethod::all();

        return view('superadmin.payment.index', [
            'payments' => $payments
        ]);
    }

    public function create() {
        return view('superadmin.payment.create');
    }

    public function store(Request $request) {

        $validatedData = $request->validate([
            'bank_name' => 'required|max:255',
            'account_number' => 'required|max:255|unique:paymentmethods',
            'account_holder' => 'required|max:15',
        ]);

        Paymentmethod::create($validatedData);

        return redirect('/superadminPayment')->with('success', 'Data Berhasil Disimpan');

    }

    public function edit(Request $request, Paymentmethod $paymentmethod) {
        return view('superadmin.payment.edit', [
            'payment' => $paymentmethod
        ]);
    }

    public function update(Request $request, Paymentmethod $paymentmethod) {

        $validatedData = $request->validate([
            'bank_name' => 'required|max:255',
            'account_number' => 'required|max:255|unique:paymentmethods,account_number,' . $paymentmethod->paymentmethod_id . ',paymentmethod_id',
            'account_holder' => 'required|max:15',
        ]);

        Paymentmethod::where('paymentmethod_id', $paymentmethod->paymentmethod_id)->update($validatedData);

        return redirect('/superadminPayment')->with('success', 'Data Berhasil Disimpan');

    }

    public function destroy(Paymentmethod $paymentmethod) {
        try{
            Paymentmethod::where('paymentmethod_id', $paymentmethod->paymentmethod_id)->delete();
        } catch (\Illuminate\Database\QueryException){
            return back()->with([
                'error' => 'Data tidak dapat dihapus, karena data masih diperlukan!',
            ]);
        }
       
        return redirect('/superadminPayment')->with('success', 'Data Berhasil Dihapus');
    }
}
