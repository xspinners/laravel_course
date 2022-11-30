<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::get();
        $statuses = config('myapp.order.status');
        // dd($statuses);
        // return view('orders.index',compact('orders'));
        return view('orders.index',compact('orders','statuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'order_date' => 'required|date',
            // 'body' => 'required',
        ]);

        $data = Order::create($request->except(['_token']));
        if($data)
        {
            return redirect()->route('orders.index');
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        $data = ['order'=>$order, 'address'=>$order->address];
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        // dd($order);
        return view('orders.edit',compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $data = $order->update($request->except(['_token']));
        if($data)
        {
            return redirect()->route('orders.index');
        }
        else{
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function datatable()
    {
        $query = Order::get();

        return DataTables::of($query)
                ->editColumn('order_date', function($row){
                    return $row->order_date->format('d/m/Y h:i A');
                })
                ->addColumn('address', function($row){
                    return $row->address->full_address ?? '';
                })   
                ->addColumn('status', function($row){
                    $statuses = config('myapp.order.status');
                    return $statuses[$row->status];
                })
                ->addColumn('action', function($row){
                    return '<a href="'.route('orders.show',$row->id).'">View</a> | <a href="'.route('orders.edit',$row->id).'">Edit</a>';
                })
            ->make();
    }
    
}
