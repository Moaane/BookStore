<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    
    public function index()
    {
        
        $order =  Order::join('customer','order.customer_id','=','customer.customer_id')
                ->join('book','order.book_id','=','book.book_id')
                ->select([ 'order.order_id','order.order_date','customer.email','book.title','order.quantity','order.amount','order.payment_status'])->paginate(5);


        return view('order_list',compact('order'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $customer =  Customer::all();
        $book = Book::all();
        return view('order_add',compact('customer','book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {
            
            Order::create($request->all());

            return redirect()->route('order.index')->with('success','Successfully to create new customer');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('order.index')->with('error',$th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $customer =  Customer::all();
        $book = Book::all();

        $order =  
        Order::join('customer','order.customer_id','=','customer.customer_id')
        ->join('book','order.book_id','=','book.book_id')
        ->where('order_id',$id)
        ->select([ 'order.order_id as order_id','order.order_date as order_date','customer.email as email','customer.customer_id as customer_id','book.book_id','customer.fullname as fulllname','book.title as title','order.quantity as quantity','book.price as price','order.total as total','order.amount as amount','order.payment_status as payment_status'])
        ->firstOrFail();

        

        if($order){

            return view('order_edit',compact('order','customer','book'));
        }else{
            return redirect()->route('order.index')->with('error','Order not found');
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        Order::where('order_id',$id)->update([
            'order_date'=> $request->order_date,
            'customer_id'=> $request->customer_id,
            'book_id'=> $request->book_id,
            'quantity'=> $request->quantity,
            'total'=> $request->total,
            'amount'=> $request->amount,
            'payment_status'=> $request->payment_status

        ]);


        return redirect()->route('order.index')->with('success','Successfully update data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        Order::where('order_id',$id)->delete();

        return redirect()->route('order.index')->with('success','Successfully delete data');
    }

    public function getOrderId(){

        $randomString = uniqid("order_");

        return response()->json([
            'key'=>$randomString
        ]);
     }

     public function books(){
        return $this->belongsTo(Book::class,'book_id');
    }
    public function payment(){
        return $this->belongsTo(Payment::class,'payment_id');
    }

}