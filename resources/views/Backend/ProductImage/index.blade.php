@extends('Backend.layouts.backend')

@section('title')
Index Product Image
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a href="{{Route('productimage.create')}}" class="btn btn-success">
                        <span title="Add Product Image">
                            <i class="fa-solid fa-plus"></i> Product Image
                           </span>
                      </a>
                      <button id="deleteSelected" class="btn btn-dark"><i class="fa-solid fa-trash"></i> Delete Selected</button>

                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                    <i class="fa-solid fa-image"></i>
                  Product Image List
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped display" id="productimageTable" >
                      <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input" id="selectAll"></th>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                     @if($productimage)
                     <tbody>
                       @foreach($productimage as $pi)
                        <tr>
                            <td><input type="checkbox" class="productimage-check form-check-input" value="{{$pi->id}}"></td>
                            <td>{{$pi->id}}</td>
                            <td>{{$pi->product_img}}</td>
                            <td>{{$pi->created_at}}</td>
                            <td>{{$pi->updated_at}}</td>
                            <td>
                                <a href="{{Route('productimage.show', $pi->id)}}" class="btn btn-light" title="Show"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{Route('productimage.edit', $pi->id)}}" class="btn btn-light" title="Edit"><i class="fas fa-edit"></i></a>

                                <form action="{{Route('productimage.destroy', $pi->id)}}" method="POST" style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-light" onclick="return confirm('Are you sure you want to delete this?')"><i class="fa-solid fa-trash" title="Delete" ></i></button>
                                </form>



                            </td>
                        </tr>
                       @endforeach
                      </tbody>
                     @else
                     <tbody>
                        No Product Image
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
        $('#productimageTable').DataTable();
    });


    $(document).ready(function() {
    var table = $('#productimageTable').DataTable();

    // Select All Checkbox
    $('#selectAll').on('click', function() {
        $('.productimage-check').prop('checked', this.checked);
    });

    // If any individual checkbox is unchecked, uncheck "Select All" checkbox
    $(document).on('change', '.productimage-check', function() {
        if (!$(this).prop("checked")) {
            $('#selectAll').prop("checked", false);
        }
    });



    // Mass Delete Functionality
    $('#deleteSelected').on('click', function() {
        var selectedIds = [];

        $('.productimage-check:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            alert("Please select at least one Product Image to delete.");
            return;
        }

        if (!confirm("Are you sure you want to delete the selected Product Images?")) {
            return;
        }

        $.ajax({
            url: "{{ route('productimage.massDelete') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                ids: selectedIds
            },
            success: function(response) {
                   // Display SweetAlert for success message
    Swal.fire({
    title: 'Success!',
    text: response.message,
    icon: 'success',
    confirmButtonText: 'OK'
});
// Delay execution by 2 seconds (2000 milliseconds)
setTimeout(function() {
    location.reload();
}, 2000);



            },
            error: function(xhr) {
                alert("An error occurred while deleting Product Images.");
            }
        });
    });




    });



  </script>
@endpush

@if(Session::has('success'))
@push('js')

<script>
    // Display SweetAlert for success message
    Swal.fire({
    title: 'Success!',
    text: '{{ Session::get('success') }}',
    icon: 'success',
    confirmButtonText: 'OK'
});
</script>

@endpush
@endif

