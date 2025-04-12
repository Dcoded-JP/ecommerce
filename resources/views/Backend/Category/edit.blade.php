@extends('Backend.layouts.backend')

@section('title')
Edit Category
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a href="{{Route('category.index')}}" class="btn btn-primary"><i class="fa-solid fa-list"></i> Category List</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Add Category</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{Route('category.update', $category->id)}}" class="form" method="POST" style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                            @csrf
                            @method('PUT')




                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <div class="form-group">
                                            <label for="c_name" class="mb-1 bold text-capitalize">category name</label>
                                            <input type="text" name="category_name" id="c_name" value="{{$category->category_name}}" placeholder="Enter Category Name" class="form-control" required>
                                            @error('category_name')
                                            <div class="text-danger">{{$message}}</div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                       <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add Category</button>
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

