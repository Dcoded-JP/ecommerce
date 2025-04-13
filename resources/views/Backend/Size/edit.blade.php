@extends('Backend.layouts.backend')

@section('title')
Edit Size
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a href="{{Route('size.index')}}" class="btn btn-primary"><i class="fa-solid fa-list"></i> Size List</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-ruler"></i> Edit Size</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{Route('size.update', $size->id)}}" class="form" method="POST" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                            @csrf
                            @method('PUT')




                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="c_name" class="mb-1 bold text-capitalize">Size name</label>
                                            <input type="text" name="size_name" id="c_name" value="{{old('size_name',$size->size_name)}}" placeholder="Enter Size Name" class="form-control" required>
                                            @error('size_name')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                       <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Update Size</button>
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

