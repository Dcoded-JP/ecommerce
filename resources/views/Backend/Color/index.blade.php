@extends('Backend.layouts.backend')

@section('title')
Index Color
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a href="{{Route('color.create')}}" class="btn btn-success">
                        <span title="Add Color">
                            <i class="fa-solid fa-plus"></i> Color
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
                  <i class="fa-solid fa-paintbrush"></i>
                  Color List
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped display" id="colorTable" >
                      <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input" id="selectAll"></th>
                            <th>Color ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                     @if($color)
                     <tbody>
                       @foreach($color as $cl)
                        <tr>
                            <td><input type="checkbox" class="color-check form-check-input" value="{{$cl->id}}"></td>
                            <td>{{$cl->id}}</td>
                            <td>{{$cl->color_name}}</td>
                            <td>{{$cl->created_at}}</td>
                            <td>{{$cl->updated_at}}</td>
                            <td>
                                <a href="{{Route('color.show', $cl->id)}}" class="btn btn-light" title="Show"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{Route('color.edit', $cl->id)}}" class="btn btn-light" title="Edit"><i class="fas fa-edit"></i></a>

                                <form action="{{Route('color.destroy', $cl->id)}}" method="POST" style="display: inline-block">
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
                        No Color
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
        $('#colorTable').DataTable();
    });


    $(document).ready(function() {
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



    // Mass Delete Functionality
    $('#deleteSelected').on('click', function() {
        var selectedIds = [];

        $('.color-check:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            alert("Please select at least one Color to delete.");
            return;
        }

        if (!confirm("Are you sure you want to delete the selected Colors?")) {
            return;
        }

        $.ajax({
            url: "{{ route('color.massDelete') }}",
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
                alert("An error occurred while deleting Colors.");
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

