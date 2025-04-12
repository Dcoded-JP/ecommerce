@extends('Backend.layouts.backend')

@section('title')
Show Category
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
            {{-- category --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3>Category Detail</h3></div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                              <tr>
                                <th>Category ID</th>
                                <td>{{$category->id}}</td>
                              </tr>
                              <tr>
                                <th>Name</th>
                                <td>{{$category->category_name}}</td>
                              </tr>
                              <tr>
                                <th>Created At</th>
                                <td>{{$category->created_at}}</td>
                              </tr>
                              <tr>
                                <th>Updated At</th>
                                <td>{{$category->updated_at}}</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


@endsection

