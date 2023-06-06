@extends('adminlte::page')

@section('title','Book List')

@section('content_header')
    <h1>Book List</h1>
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
                                <a href="{{ route('book.create')}}" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                    Create</a>

                            </div>
                            <table class="table table-striped">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Isbn 13</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Num Pages</th>
                                    <th scope="col">Author</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Price</th>
                                    {{-- <th scope="col">Sold</th> --}}
                                    <th scope="col" width="350px" class="text-center">Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                
                                    @foreach ($book as $b)
                                    <tr>
                                        <th scope="row">{{ ++$i }}</th>
                                        <td>{{ $b->title }}</td>
                                        <td>{{ $b->isbn13 }}</td>
                                        <td><img src="{{ asset('images/'.$b->image)}}" alt=""
                                            width="150px"
                                            ></td>
                                        <td>{{ $b->num_pages }}</td>
                                        <td>{{ $b->author }}</td>
                                        <td>{{ $b->stock }}</td>
                                        <td>{{ $b->price }}</td>
                                        {{-- <td>{{ $b->order_count }}</td> --}}
                                        <td>
                                            <div class="d-flex justify-content-around">
                                                <a href="{{ route('book.edit',$b->book_id)}}" class="btn btn-primary">
                                                    <i class="fas fa-edit"></i>
                                                    Edit</a>
                                                <form action="{{ route('book.destroy',$b->book_id)}}" method="POST">
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