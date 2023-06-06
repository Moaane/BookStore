@extends('adminlte::page')

@section('title','Order List')

@section('content_header')
    <h1>Order List</h1>
@stop

@section('content')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" id="success-alert" role="alert">
                               <strong>{{  session('success') }}</strong>
                                
                              </div>
                            @endif

                            @if(session('error'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{  session('error')}} </strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                            @endif

                            <div class="float-right">
                                <a href="{{ route('order.create')}}" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    Create</a>

                            </div>
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Order Date</th>
                                    <th scope="col">Customer Email</th>
                                    <th scope="col">Quantiy</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Payment Status</th>       
                                    <th scope="col" width="500px" class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($order as $o)
                                    <tr>
                                        <th >{{ ++$i }}</th>
                                        <td>{{ $o->order_id }}</td>
                                        <td>{{ $o->order_date }}</td>
                                        <td>{{ $o->email }}</td>
                                        <td>{{ $o->quantity }}</td>
                                        <td>{{ $o->amount }}</td>
                                        <td>{{ $o->payment_status }}</td>
                                      
                                       
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                
                                                <a href="{{ route('order.edit',$o->order_id)}}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                    Edit</a>
                                                <form action="{{ route('order.destroy',$o->order_id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fas fa-trash"></i>
                                                        Delete</button>
                                                </form>
                                            </div>

                                        </td>
                                      </tr>
                                    @endforeach
                               
                                 
                                </tbody>
                              </table>

                              {{ $order->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop

@section('js')
   <script>
            
        $("#success-alert").fadeTo(2000, 500).fadeOut(500, function(){
        $("#success-alert").fadeOut(500);
        });
   </script>
@stop