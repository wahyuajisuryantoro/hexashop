<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\CartItem;
use App\Models\PaymentKey;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function index()
    {
        $title = "Kelola Pesanan";
        $orders = Order::with(['user', 'orderDetails.product'])->get();

        return view('admin.orders.index', compact('orders', 'title'));
    }

    public function updateStatus(Request $request, $detailId)
    {
        $detail = OrderDetail::findOrFail($detailId);
        $newStatus = $request->input('status');
        if (in_array($newStatus, ['pending', 'processing', 'completed', 'rejected'])) {
            $detail->status = $newStatus;
            $detail->save();
            return back()->with('success', 'Item status updated successfully!');
        }
        return back()->with('error', 'Invalid status update.');
    }

    public function checkout(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Please login to continue.');
        }

        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        DB::beginTransaction();
        try {
            $order = new Order();
            $order->user_id = $user->id;
            $order->total_price = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });
            $order->save();

            foreach ($cartItems as $item) {
                $orderDetail = new OrderDetail([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'status' => 'pending'
                ]);
                $orderDetail->save();
            }

            CartItem::where('user_id', $user->id)->delete();

            $paymentKeys = PaymentKey::firstOrFail();
            Config::$serverKey = $paymentKeys->server_key;
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => $order->id,
                    'gross_amount' => $order->total_price,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ],
            ];

            $snapToken = Snap::getSnapToken($params);
            DB::commit();

            return view('pages.order.payment', ['snapToken' => $snapToken, 'clientKey' => $paymentKeys->client_key]);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('cart.index')->with('error', 'Failed to place the order: ' . $e->getMessage());
        }
    }


    public function showOrder($orderId)
    {
        $order = Order::with(['orderDetails.product'])->findOrFail($orderId);
        return view('pages.order.index', compact('order'));
    }
}
