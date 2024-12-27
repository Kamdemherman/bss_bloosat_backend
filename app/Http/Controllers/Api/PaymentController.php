<?php
namespace App\Http\Controllers;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
class PaymentController extends Controller
{
    public function index()
    {
        return Payment::latest()->get();
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference' => 'required|string|unique:payments',
            'client_name' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'payment_method' => ['required', Rule::in(['card', 'cash', 'transfer', 'check'])],
            'date' => 'required|date',
            'notes' => 'nullable|string',
            'status' => ['required', Rule::in(['pending', 'completed', 'cancelled'])]
        ]);
        $payment = Payment::create($validated);
        return response()->json($payment, 201);
    }
    public function show(Payment $payment)
    {
        return $payment;
    }
    public function update(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'reference' => ['sometimes', 'required', 'string', Rule::unique('payments')->ignore($payment->id)],
            'client_name' => 'sometimes|required|string',
            'amount' => 'sometimes|required|numeric|min:0',
            'payment_method' => ['sometimes', 'required', Rule::in(['card', 'cash', 'transfer', 'check'])],
            'date' => 'sometimes|required|date',
            'notes' => 'nullable|string',
            'status' => ['sometimes', 'required', Rule::in(['pending', 'completed', 'cancelled'])]
        ]);
        $payment->update($validated);
        return response()->json($payment);
    }
    public function destroy(Payment $payment)
    {
        $payment->delete();
        return response()->json(null, 204);
    }
}