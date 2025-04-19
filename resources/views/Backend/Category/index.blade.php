@extends('Backend.layouts.backend')

@section('title')
Category
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
              <div class="card shadow">
                <div class="card-header">

                    <h3><i class="fas fa-shopping-cart me-2"></i> Category List</h3>



                    <form action="{{Route('category.store')}}" class="form" method="POST">
                        @csrf
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <div class="form-group">
                                        <input type="text" name="category_name" placeholder="Enter Category Name" class="form-control bg-light" value="{{old('category_name')}}" required>
                                        @error('category_name')
                                        <div class="text-danger">{{$message}}</div>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-4">
                               <div class="mb-3">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i> Add Category</button>
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
                    <table class="table table-bordered table-striped display" id="categoryTable" >
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
                     @if($category)
                     <tbody>
                       @foreach($category as $ct)
                        <tr>
                            <td><input type="checkbox" class="category-check form-check-input" value="{{$ct->id}}"></td>
                            <td>{{$ct->id}}</td>
                            <td><a href="{{Route('category.show', $ct->id)}}" class="btn btn-outline-info" title="Show">{{$ct->category_name}}</a></td>
                            <td>{{$ct->created_at}}</td>
                            <td>{{$ct->updated_at}}</td>
                            <td>

                                <a href="{{Route('category.edit', $ct->id)}}" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>

                                <form action="{{Route('category.destroy', $ct->id)}}" method="POST" style="display: inline-block">
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
        var table = $('#categoryTable').DataTable();

        // Select All Checkbox
        $('#selectAll').on('click', function() {
            $('.category-check').prop('checked', this.checked);
        });

        // If any individual checkbox is unchecked, uncheck "Select All" checkbox
        $(document).on('change', '.category-check', function() {
            if (!$(this).prop("checked")) {
                $('#selectAll').prop("checked", false);
            }
        });

        // Handle bulk actions
        $('#actions').on('change', function() {
            var selectedAction = $(this).val();

            if (selectedAction === 'delete') {
                var selectedIds = [];

                $('.category-check:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Please select at least one Category to delete.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    $(this).val(''); // Reset select
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete the selected Categories?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('category.massDelete') }}",
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
                                    text: 'An error occurred while deleting Categories.',
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

@push('css')
<style>

/* Form General Styling */
.form-control, .form-select {
    border-radius: 4px;
    padding: 0.375rem 0.75rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus, .form-select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

/* Input Controls & Form Elements */
.form-control,
.form-select,
.select2-container--default .select2-selection--multiple {
    height: auto;
    padding: 0.625rem 1rem;
    font-size: 0.875rem;
    font-weight: 400;
    line-height: 1.5;
    color: #2d3748;
    background-color: #fff;
    border: 2px solid #e2e8f0;
    border-radius: 0.5rem;
    transition: all 0.2s ease-in-out;
}

/* Focus States */
.form-control:focus,
.form-select:focus,
.select2-container--default.select2-container--focus .select2-selection--multiple {
    border-color: #3b82f6;
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.25);
    outline: none;
}

/* Placeholder Styling */
.form-control::placeholder {
    color: #0a0a0a;
    opacity: 0.7;
}
</style>
@endpush
