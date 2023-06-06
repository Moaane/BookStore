@extends('adminlte::page')


@section('css')
<style>
      .imgUpload {
                max-width: 300px;
                max-height: 300px;
                min-width: 300px;
                min-height: 300px;
            }

        .select2-container{
        width: 1120.74px;
        border: 1px solid #ccc!important;
        padding: 5px;
        
    }
</style>
@stop
@section('title', 'New Book')
@section('content_header')
    <h1> Edit Book</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('order.update',$order->order_id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Order Id</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="order_id" id="order_id" readonly value="{{ $order->order_id}}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Order Date</label>
                                <div class="col-sm-10">
                                    @php
                                    $config = ['format' => 'YYYY-MM-DD'];
                                    $date = date('Y-m-d');
                                    @endphp
                                    <x-adminlte-input-date name="order_date" value="{{ $order->order_date }}" :config="$config"/>
                                    
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Customer</label>
                                <div class="col-sm-10">
                                    <x-adminlte-select2 name="customer_id" id="customer">
                                        <option value="" disabled selected>Please Choose Customer ...</option>
                                        @foreach ($customer as $c)
                                            
                                            <option value="{{ $c->customer_id}}"
                                                @if($order->customer_id == $c->customer_id) {{ 'selected'}} @endif
                                                >{{ $c->fullname }}</option>
                                        @endforeach
                                    </x-adminlte-select2>
                                    
                                </div>
                            </div>
                          
                           
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Book</label>
                                <div class="col-sm-10">
                                    <x-adminlte-select2 name="book_id" id="book">
                                        <option value="" disabled selected>Please Choose Book ...</option>
                                        @foreach ($book as $b)
                                            
                                            <option value="{{ $b->book_id}}"
                                                @if($order->book_id == $b->book_id)
                                                {{ 'selected'}}
                                                @endif
                                                >{{ $b->title }}</option>
                                        @endforeach
                                    
                                    </x-adminlte-select2>
                                    
                                </div>
                            </div>
                          
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Email </label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control"  id="email"
                                    value="{{ $order->email}}"
                                    readonly
                                    >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Price Rp.</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" id="price" readonly
                                    value="{{ $order->price}}"
                                    >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="quantity" id="quantity"
                                    value="{{ $order->quantity}}"
                                    >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Total </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="total" id="total" readonly
                                    value="{{ $order->total}}"
                                    >
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Amount </label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="amount" id="amount"
                                    value="{{ $order->amount }}"
                                    >
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Payment Status </label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="payment_status" id="payment_status"
                                    value="{{ $order->payment_status }}"
                                    >  
                                </div>
                            </div>
                            
            
                           
                        
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save"></i>
                                     Save</button>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@stop

@section('js')
<script>

 $('#customer').change(function (){
    var customer  = $(this).val();
        $.ajax({
            url:`{{ route('customer.getCustomerById') }}`,
            method:'get',
            data:{id:$('#customer').val()},
        
            success:function(response){
               var email =  response.customer.email;

               $('#email').val(email);
            }
        })
    });
   $('#book').change(function (){
    var book  = $(this).val();
        $.ajax({
            url:`{{ route('book.getPriceById') }}`,
            method:'get',
            data:{id:$('#book').val()},
        
            success:function(response){
                var price =  response.book.price
                $('#price').val(price); 
                var quantity = $('#quantity').val()
                var  price = $('#price').val()
                var total = 0
                total = quantity * price;    
                $('#total').val(total)

            }
        })
    });

    $('#quantity').keyup(function (){
        var quantity = $(this).val()
        var  price = $('#price').val()
        var total = 0
        total = quantity * price;    
        $('#total').val(total)

     })

     $('#amount').keyup(function (){
        var amount =  parseInt($(this).val())
        var total = parseInt($('#total').val())
        if(amount === total ){
            $('#payment_status').val('Paid')
        }
        else if(amount <=total){
            $('#payment_status').val('Unpaid')
        }
      })
</script>
@stop