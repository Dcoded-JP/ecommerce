@extends('Backend.layouts.backend')

@section('title')
Show Color
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
            {{-- color --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header"><h3><i class="fa-solid fa-paintbrush"></i> Color Detail</h3></div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                              <tr>
                                <th>Color ID</th>
                                <td>{{$color->id}}</td>
                              </tr>
                              <tr>
                                <th>Name</th>
                                <td>{{$color->color_name}}</td>
                              </tr>
                              <tr>
                                <th>Created At</th>
                                <td>{{$color->created_at}}</td>
                              </tr>
                              <tr>
                                <th>Updated At</th>
                                <td>{{$color->updated_at}}</td>
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

