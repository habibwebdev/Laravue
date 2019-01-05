<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use App\OrderProduct;
use App\Mail\OrderPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\CheckoutRequest;
use Gloudemans\Shoppingcart\Facades\Cart;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Cartalyst\Stripe\Exception\CardErrorException;
// use illuminate\contract\Mailer;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cart::instance('default')->count() == 0) {
            return redirect()->route('shop.index');
        }

        if (auth()->user() && request()->is('guestCheckout')) {
            return redirect()->route('checkout.index');
        }

        return view('checkout')->with([
            'discount' => getNumbers()->get('discount'),
            'newSubtotal' => getNumbers()->get('newSubtotal'),
            'newTax' => getNumbers()->get('newTax'),
            'newTotal' => getNumbers()->get('newTotal'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckoutRequest $request)
    {

        // Check race condition where are less items are available to purchase
        if ($this->productsNotAvailable()) {
            return back()->withErrors('Sorry! One of the items in your cart is no longer available.');
        }

        $contents = Cart::content()->map(function ($item) {
            return $item->model->slug . ', ' . $item->qty;
        })->values()->toJson();

        try{
            $name = $request->name;
            $email = $request->email;
            // dd($name);
            $charge = Stripe::charges()->create([
                // 'amount' => $this->getNumbers()->get('newTotal') / 100,
                // 'amount' => Cart::total() / 100, //copied after index above
                'amount' => getNumbers ()->get('newTotal') / 100,
                'currency' => 'USD',
                'source' => $request->stripeToken,
                'description' => 'Order',
                'receipt_email' => $request->email,
                'metadata' => [
                    'contents' => $contents,
                    'quantity' => Cart::instance('default')->count(),
                    'discount' => collect(session()->get('coupon'))->toJson(),
                    // 'discount' => collect(session()->get('coupon'))->toJson(),
                ],
            ]);

            $order = $this->addToOrderTable($request, null);

            //Mail
            Mail::send(new OrderPlaced($order));
            // Mail::send(new OrderPlaced($order));
            // Mail::to($request->email, $name)
            //     ->send(new OrderPlaced);


            // Decrease the quantity of all the products in the cart
            $this->decreaseQuantities();

            //Successfull
            Cart::instance('default')->destroy();
            session()->forget('coupon');
            // return back()->with('success_message', 'Thank you! Your payment has been successfully accepted!');
            return redirect()->route('thankyou.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');

        } catch(CardErrorException $e) {
            $this->addToOrderTable($request, $e->getMessage());
            return back()->withErrors('Error! ' . $e->getMessage());
            // return back()->with(['error', "'Error! ' . $e->getMessage()"]);
        }
    }

    protected function addToOrderTable($request, $error) {

        // Insert into orders table
        $order = Order::create([
            'user_id' => auth()->user() ? auth()->user()->id : null,
            'billing_email' => $request->email,
            'billing_name' => $request->name,
            'billing_address' => $request->address,
            'billing_city' => $request->city,
            'billing_province' => $request->province,
            'billing_postalcode' => $request->postalcode,
            'billing_phone' => $request->phone,
            'billing_name_on_card' => $request->name_on_card,
            'billing_discount' => getNumbers()->get('discount'),
            'billing_discount_code' => getNumbers()->get('code'),
            'billing_subtotal' => getNumbers()->get('newSubtotal'),
            'billing_tax' => getNumbers()->get('newTax'),
            'billing_total' => getNumbers()->get('newTotal'),
            'error' => $error,
        ]);
            //Insert into order_product table
        foreach (Cart::content() as $item) {
            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $item->model->id,
                'quantity' => $item->qty
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);

            $product->update(['quantity' => $product->quantity - $item->qty]);
        }
    }

    protected function productsNotAvailable()
    {
        foreach (Cart::content() as $item) {
            $product = Product::find($item->model->id);

            if ($product->quantity < $item->qty) {
                return true;
            }
            return false;
        }
    }

}
