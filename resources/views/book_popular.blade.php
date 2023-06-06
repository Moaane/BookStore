@extends('adminlte::page')

@section('title','Book List')

@section('content_header')
    <h1>Popular Book</h1>
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

                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Num Pages</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Sold</th>
                                  </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($book as $b)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td>{{ $b->title }}</td>
                                        <td><img src="{{ asset('images/'.$b->image)}}" alt=""
                                            width="150px"
                                            ></td>
                                        <td>{{ $b->num_pages }}</td>
                                        <td>{{ $b->author }}</td>
                                        <td>{{ $b->price }}</td>
                                        <td>{{ $b->order_count }}</td>
                                        {{-- <td>{{ $b->order_count }}</td> --}}
                                        <td>
                                        </td>
                                      </tr>
                                    @endforeach
                               
                                 
                                </tbody>
                              </table>

                              {{ $book->links()}}
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