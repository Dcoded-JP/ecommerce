@extends('Backend.layouts.backend')

@section('title')
Create Product Image
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a href="{{Route('productimage.index')}}" class="btn btn-primary"><i class="fa-solid fa-list"></i> Product Image List</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-image"></i> Upload New Product Image</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{Route('productimage.store')}}" class="form" method="POST" enctype="multipart/form-data" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="p_image" class="mb-1 bold text-capitalize">Product Image</label>
                                            <input type="file" name="productimage_name" id="p_image" class="form-control" required>
                                            @error('productimage_name')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                       <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Upload Image</button>
                                       <button type="reset"  class="btn btn-dark">Clear</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
  </div>


@endsection

