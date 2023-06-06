<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class PopularController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book =  Book::selectRaw('book.*, SUM(order.quantity) as order_count')
        ->join('order', 'book.book_id', '=', 'order.book_id')
        ->groupBy('book.book_id')
        ->orderByRaw('order_count DESC')
        ->paginate(5);

        return view('book_popular',compact('book'))
        ->with('i',(request()->input('page',1)-1)*5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('book_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try {

            $imageName =  $request->image->getClientOriginalName();
           
            $request->image->move(public_path('images'),$imageName);

            Book::create([
                'title'=>$request->title,
                'isbn13'=>$request->isbn13,
                'num_pages'=>$request->num_pages,
                'image'=>$imageName,
                'author'=>$request->author,
                'stock'=>$request->stock,
                'price'=>$request->price,

            ]);

            return redirect()->route('book.index')->with('success','Successfully to create new book');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->route('book.index')->with('error',$th->getMessage());
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
      
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

      
       

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
       
    }

    public function getPriceById(Request $request){

    }

}