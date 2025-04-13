@extends('Backend.layouts.backend')

@section('title')
Show Size
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
            {{-- size --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3><i class="fa-solid fa-ruler"></i> Size Detail</h3></div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                              <tr>
                                <th>Size ID</th>
                                <td>{{$size->id}}</td>
                              </tr>
                              <tr>
                                <th>Name</th>
                                <td>{{$size->size_name}}</td>
                              </tr>
                              <tr>
                                <th>Created At</th>
                                <td>{{$size->created_at}}</td>
                              </tr>
                              <tr>
                                <th>Updated At</th>
                                <td>{{$size->updated_at}}</td>
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

