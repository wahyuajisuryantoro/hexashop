<?php

namespace App\Http\Controllers;

use App\Models\PaymentKey;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PaymentKeyController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'server_key' => 'required|string',
            'client_key' => 'required|string',
        ], [
            'server_key.required' => 'The server key is required.',
            'client_key.required' => 'The client key is required.',
            'server_key.string' => 'The server key must be a string.',
            'client_key.string' => 'The client key must be a string.',
        ]);

        try {
            $key = PaymentKey::updateOrCreate([], [
                'server_key' => $validated['server_key'],
                'client_key' => $validated['client_key']
            ]);

            Alert::success('Success', 'Payment keys have been successfully updated.');
            return redirect()->back();
        } catch (\Exception $e) {
            Alert::error('Error', 'Failed to save payment keys: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
