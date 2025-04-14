@extends('Backend.layouts.backend')

@section('title')
Size
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-header">
                   
                    <h3><i class="fa-solid fa-ruler"></i> Size List</h3>
                


                    <form action="{{Route('size.store')}}" class="form" method="POST">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" name="size_name" placeholder="Enter Size Name" class="form-control bg-light" value="{{old('size_name')}}" required>
                                        @error('size_name')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                               <div class="mb-3">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add Size</button>
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
                    <table class="table table-bordered table-striped display" id="sizeTable" >
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
                     @if($size)
                     <tbody>
                       @foreach($size as $ct)
                        <tr>
                            <td><input type="checkbox" class="size-check form-check-input" value="{{$ct->id}}"></td>
                            <td>{{$ct->id}}</td>
                            <td><a href="{{Route('size.show', $ct->id)}}" class="btn btn-outline-info" title="Show">{{$ct->size_name}}</a></td>
                            <td>{{$ct->created_at}}</td>
                            <td>{{$ct->updated_at}}</td>
                            <td>
                                
                                <a href="{{Route('size.edit', $ct->id)}}" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>

                                <form action="{{Route('size.destroy', $ct->id)}}" method="POST" style="display: inline-block">
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
        var table = $('#sizeTable').DataTable();

        // Select All Checkbox
        $('#selectAll').on('click', function() {
            $('.size-check').prop('checked', this.checked);
        });

        // If any individual checkbox is unchecked, uncheck "Select All" checkbox
        $(document).on('change', '.size-check', function() {
            if (!$(this).prop("checked")) {
                $('#selectAll').prop("checked", false);
            }
        });

        // Handle bulk actions
        $('#actions').on('change', function() {
            var selectedAction = $(this).val();
            
            if (selectedAction === 'delete') {
                var selectedIds = [];

                $('.size-check:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Please select at least one Size to delete.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    $(this).val(''); // Reset select
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete the selected Sizes ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonsize: '#3085d6',
                    cancelButtonsize: '#d33',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('size.massDelete') }}",
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
                                    text: 'An error occurred while deleting Sizes.',
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