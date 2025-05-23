@extends('Backend.layouts.backend')

@section('title')
Color
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-header">
                   
                    <h3><i class="fa-solid fa-paintbrush"></i> Color List</h3>
                


                    <form action="{{Route('color.store')}}" class="form" method="POST">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" name="color_name" placeholder="Enter Color Name" class="form-control bg-light" value="{{old('color_name')}}" required>
                                        @error('color_name')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                               <div class="mb-3">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add Color</button>
                               </div>
                            </div>
                            <div class="col-md-4" style="margin-left: auto" style="display:inline-block">
                                <select id="actions" class="form-select" >
                                    <option value="" class="bg-light text-muted">Bulk Actions</option>
                                    <option value="" class="bg-light text-muted">-----------------</option>
                                    <option value="export">Export</option>
                                    <option value="archive">Archive</option>
                                    <option value="delete">Delete</option>
                                    <option value="">Another</option>
                                </select>
                            </div>
                        </div>
                    </form>


                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped display" id="colorTable" >
                      <thead>
                        <tr>
                            <th style="max-width: 50px ;font-family:cursive"><input type="checkbox" class="form-check-input" id="selectAll"></th>
                            <th style="max-width: 50px ;font-family:cursive">ID</th>
                            <th style="font-family:cursive">Name</th>
                            <th style="max-width: 200px ;font-family:cursive">Created At</th>
                            <th style="max-width: 200px ;font-family:cursive">Updated At</th>
                            <th style="max-width: 200px ;font-family:cursive">Actions</th>
                        </tr>
                      </thead>
                     @if($color)
                     <tbody>
                       @foreach($color as $ct)
                        <tr>
                            <td><input type="checkbox" class="color-check form-check-input" value="{{$ct->id}}"></td>
                            <td>{{$ct->id}}</td>
                            <td><a href="{{Route('color.show', $ct->id)}}" class="btn btn-outline-info" title="Show">{{$ct->color_name}}</a></td>
                            <td>{{$ct->created_at}}</td>
                            <td>{{$ct->updated_at}}</td>
                            <td>
                                
                                <a href="{{Route('color.edit', $ct->id)}}" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>

                                <form action="{{Route('color.destroy', $ct->id)}}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')"><i class="fa-solid fa-trash" title="Delete" ></i></button>
                                </form>



                            </td>
                        </tr>
                       @endforeach
                      </tbody>
                     @endif
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
  </div>



@endsection

@push('js')
<script>
    $(document).ready(function () {
        // DataTable initialization
        var table = $('#colorTable').DataTable();

        // Select All Checkbox
        $('#selectAll').on('click', function() {
            $('.color-check').prop('checked', this.checked);
        });

        // If any individual checkbox is unchecked, uncheck "Select All" checkbox
        $(document).on('change', '.color-check', function() {
            if (!$(this).prop("checked")) {
                $('#selectAll').prop("checked", false);
            }
        });

        // Handle bulk actions
        $('#actions').on('change', function() {
            var selectedAction = $(this).val();
            
            if (selectedAction === 'delete') {
                var selectedIds = [];

                $('.color-check:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Please select at least one Color to delete.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    $(this).val(''); // Reset select
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete the selected Colors ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('color.massDelete') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                ids: selectedIds
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: response.message,
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                });
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
                            },
                            error: function(xhr) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'An error occurred while deleting Colors.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    }
                    $('#actions').val(''); // Reset select
                });
            }
            // Add more conditions here for other actions (export, archive, etc.)
        });
    });
</script>
@endpush

@if(Session::has('success'))
@push('js')
<script>
    Swal.fire({
        title: 'Success!',
        text: '{{ Session::get('success') }}',
        icon: 'success',
        confirmButtonText: 'OK'
    });
</script>
@endpush
@endif