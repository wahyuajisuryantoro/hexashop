<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $title = "Cart";
        $user = Auth::user();
        $cartItems = CartItem::with('product')->where('user_id', $user->id)->get();

        $cart = [];
        foreach ($cartItems as $item) {
            $cart[$item->id] = [
                'name' => $item->product->name,
                'image' => $item->product->image_url,
                'quantity' => $item->quantity,
                'price' => $item->product->price
            ];
        }

        return view('pages.cart.index', compact('cart', 'title'));
    }




    public function addToCart(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->with('error', 'User not authenticated');
        }

        try {
            $product = Product::findOrFail($id);
            $quantity = (int) $request->input('quantity', 1); // Default ke 1 jika tidak ada input

            $cartItem = CartItem::where('user_id', $user->id)->where('product_id', $id)->first();

            if ($cartItem) {
                $cartItem->quantity += $quantity;
            } else {
                $cartItem = new CartItem([
                    'user_id' => $user->id,
                    'product_id' => $id,
                    'quantity' => $quantity
                ]);
            }

            $cartItem->save();
            $this->updateCartCount();
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->back()->with('error', 'Product not found');
        }
    }






    public function increase($id)
    {
        $user = Auth::user();
        $cartItem = CartItem::where('user_id', $user->id)->where('id', $id)->first();

        if ($cartItem) {
            $cartItem->increment('quantity');
            return redirect()->route('cart.index')->with('success', 'Product quantity increased successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in your cart.');
    }


    public function decrease($id)
    {
        $user = Auth::user();
        $cartItem = CartItem::where('user_id', $user->id)->where('id', $id)->first();

        if ($cartItem) {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
                return redirect()->route('cart.index')->with('success', 'Product quantity decreased successfully!');
            } else {
                $cartItem->delete();
                return redirect()->route('cart.index')->with('success', 'Product removed from cart as quantity was 1.');
            }
        }

        return redirect()->back()->with('error', 'Product not found in your cart.');
    }


    public function remove($id)
    {
        $user = Auth::user();
        $cartItem = CartItem::where('user_id', $user->id)->where('id', $id)->first();

        if ($cartItem) {
            $cartItem->delete();
            $this->updateCartCount();
            return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
        }

        return redirect()->back()->with('error', 'Product not found in your cart.');
    }



    public function updateCartCount()
    {
        if (Auth::check()) {
            $cartItemsCount = CartItem::where('user_id', Auth::id())->sum('quantity');
            session()->put('cart_count', $cartItemsCount);
        }
    }
}
