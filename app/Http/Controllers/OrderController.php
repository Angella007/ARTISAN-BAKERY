<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::recent()->paginate(15);
        
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new order.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'order_type' => 'required|in:pickup,catering,custom-cake,weekly',
            'pickup_date' => 'nullable|date|after_or_equal:today',
            'pickup_time' => 'nullable|string',
            'products' => 'nullable|array',
            'dietary' => 'nullable|string',
            'order_details' => 'required|string|min:10',
            'newsletter' => 'nullable|boolean',
            'sms_alerts' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Create the order
        $order = Order::create([
            'user_id' => auth()->id(), // Save the logged-in user's ID
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'order_type' => $request->order_type,
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'products' => $request->products ?? [],
            'dietary' => $request->dietary,
            'order_details' => $request->order_details,
            'newsletter' => $request->has('newsletter'),
            'sms_alerts' => $request->has('sms_alerts'),
        ]);

        // Redirect back with success message
        return redirect()->route('contact')
            ->with('success', 'Order request submitted successfully! We will contact you within 24 hours.');
    }

    /**
     * Display the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified order.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'order_type' => 'required|in:pickup,catering,custom-cake,weekly',
            'pickup_date' => 'nullable|date',
            'pickup_time' => 'nullable|string',
            'products' => 'nullable|array',
            'dietary' => 'nullable|string',
            'order_details' => 'required|string|min:10',
            'newsletter' => 'nullable|boolean',
            'sms_alerts' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Update the order
        $order->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'order_type' => $request->order_type,
            'pickup_date' => $request->pickup_date,
            'pickup_time' => $request->pickup_time,
            'products' => $request->products ?? [],
            'dietary' => $request->dietary,
            'order_details' => $request->order_details,
            'newsletter' => $request->has('newsletter'),
            'sms_alerts' => $request->has('sms_alerts'),
        ]);

        // Redirect with success message
        return redirect()->route('orders.show', $order->id)
            ->with('success', 'Order updated successfully!');
    }

    /**
     * Remove the specified order from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Order deleted successfully!');
    }

    /**
     * Display orders by type (for filtering).
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function byType($type)
    {
        $orders = Order::ofType($type)->recent()->paginate(15);
        
        return view('orders.index', compact('orders', 'type'));
    }
}
