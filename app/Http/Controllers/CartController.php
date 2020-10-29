<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Mail\PurchaseMail;
use App\Order;
use App\Product;
use App\User;
use Illuminate\Http\Request;

use Cartalyst\Stripe\Laravel\Facades\Stripe;

class CartController extends Controller
{
    public function addToCart(Product $product)
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = new Cart();
        }
        $cart->add($product);
        session()->put('cart', $cart);

        notify()->success('Product added to cart!');
        return redirect()->back();
    }

    public function showCart()
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }

        // dd($cart->items);
        return view('frontend.cart', compact('cart'));
    }

    public function updateCart(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1'
        ]);

        $cart = new Cart(session()->get('cart'));
        $cart->updateQuantity($product->id, $request->quantity);

        session()->put('cart', $cart);

        notify()->success('Cart Updated!');
        return redirect()->back();
    }

    public function removeCart(Product $product)
    {
        $cart = new Cart(session()->get('cart'));
        $cart->remove($product->id);

        if ($cart->totalQty <= 0) {
            session()->forget('cart');
        } else {
            session()->put('cart', $cart);
        }

        notify()->success('Item Removed!');
        return redirect()->back();
    }

    public function checkout($amount)
    {
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }

        return view('frontend.checkout', compact('amount', 'cart'));
    }

    public function charge(Request $request)
    {
        $charge = Stripe::charges()->create([
            'currency' => "AUD",
            'source' => $request->stripeToken,
            'amount' => $request->amount,
            'description' => 'Test Purchases'
        ]);

        $charge_id = $charge['id'];
        if (session()->has('cart')) {
            $cart = new Cart(session()->get('cart'));
        } else {
            $cart = null;
        }
        \Mail::to(auth()->user()->email)->send(new PurchaseMail($cart));

        if ($charge_id) {
            auth()->user()->orders()->create([
                'cart' => serialize(session()->get('cart'))
            ]);

            session()->forget('cart');
            notify()->success('Payment successful...');
            return redirect()->route('front');
        } else {
            return redirect()->back();
        }
    }

    public function orders()
    {
        $orders = auth()->user()->orders;
        $carts = $orders->transform(function ($cart, $key) {
            return unserialize($cart->cart);
        });

        return view('frontend.orders', compact('carts'));
    }

    // display orders by users in admin
    // public function userOrders()
    // {
    //     $orders = Order::latest()->get();
    //     $activeMenu = 'order';
    //     $activeSubMenu = 'all-orders';
    //     return view('admin.orders.index', compact('orders', 'activeMenu', 'activeSubMenu'));
    // }

    public function viewUserOrder($id)
    {
        $user = User::find($id);
        $orders = $user->orders;
        $carts = $orders->transform(function ($cart, $key) {
            return unserialize($cart->cart);
        });

        $activeMenu = 'user';
        $activeSubMenu = 'all-users';

        return view('admin.orders.show', compact('carts', 'activeMenu', 'activeSubMenu'));
    }
}
