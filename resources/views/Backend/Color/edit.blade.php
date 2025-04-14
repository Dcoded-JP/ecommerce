@extends('Backend.layouts.backend')

@section('title')
Edit Color
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a href="{{Route('color.index')}}" class="btn btn-primary"><i class="fa-solid fa-list"></i> Color List</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-paintbrush"></i> Edit Color</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{Route('color.update', $color->id)}}" class="form" method="POST" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                            @csrf
                            @method('PUT')




                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="c_name" class="mb-1 bold text-capitalize">color name</label>
                                            <input type="text" name="color_name" id="c_name" value="{{old('color_name',$color->color_name)}}" placeholder="Enter Color Name" class="form-control" required>
                                            @error('color_name')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                       <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Update Color</button>
                                     
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

