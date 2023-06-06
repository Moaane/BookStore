@extends('adminlte::page')

@section('css')
<style>
      .imgUpload {
                max-width: 300px;
                max-height: 300px;
                min-width: 300px;
                min-height: 300px;
            }
</style>
@stop
@section('title', 'New Book')
@section('content_header')
    <h1>Create a New Book</h1>
@stop

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="title" id="title" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">ISBN 13</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="isbn13" id="isbn13" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Stock</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="stock" id="stock" required>
                                </div>
                            </div>
                          
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Image</label>
                                <div class="col-sm-10">
                                    <img src="{{asset('image/default.png')}}" id="imagePreview" class="imgUpload" alt="">
                                    <input type="file" class="form-control" name="image" id="image" required>
                                  
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Num Pages</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="num_pages" id="num_pages" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Price Rp.</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="price" id="price" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-2 col-form-label">Author</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="author" id="author" required>
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
// jquery dibawah fungsinya untuk membuat events ketika file di ubah maka gambar yang muncul juga terupdate
    $('#image').change(function (){
        // buat variabel file untuk mengambil file
        const file = this.files[0]

        console.log(file)
  
        if(file){
            // buat objek FileReader
            let reader = new FileReader()
              // gunakan fungsi onload yang akan merefresh target gambarnya saja
            reader.onload = function (event){ 
                $('#imagePreview').attr('src',event.target.result)
            }
            // baca data sesuai file yang di minta
            reader.readAsDataURL(file);
        }
     })
</script>
@stop