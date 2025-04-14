@extends('Backend.layouts.backend')

@section('title')
Index I-Product
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a href="{{Route('iproduct.create')}}" class="btn btn-success">
                        <span title="Add I-Product">
                            <i class="fa-solid fa-plus"></i> I-Product
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
                    
                  I-Product List
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped display" id="iproductTable" >
                      <thead>
                        <tr>
                            <th><input type="checkbox" class="form-check-input" id="selectAll"></th>
                            <th>I-Product ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                     @if($iproduct)
                     <tbody>
                       @foreach($iproduct as $cl)
                        <tr>
                            <td><input type="checkbox" class="iproduct-check form-check-input" value="{{$cl->id}}"></td>
                            <td>{{$cl->id}}</td>
                            <td>{{$cl->iproduct_name}}</td>
                            <td>{{$cl->created_at}}</td>
                            <td>{{$cl->updated_at}}</td>
                            <td>
                                <a href="{{Route('iproduct.show', $cl->id)}}" class="btn btn-light" title="Show"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{Route('iproduct.edit', $cl->id)}}" class="btn btn-light" title="Edit"><i class="fas fa-edit"></i></a>

                                <form action="{{Route('iproduct.destroy', $cl->id)}}" method="POST" style="display: inline-block">
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
                        No iproduct
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
        $('#iproductTable').DataTable();
    });


    $(document).ready(function() {
    var table = $('#iproductTable').DataTable();

    // Select All Checkbox
    $('#selectAll').on('click', function() {
        $('.iproduct-check').prop('checked', this.checked);
    });

    // If any individual checkbox is unchecked, uncheck "Select All" checkbox
    $(document).on('change', '.iproduct-check', function() {
        if (!$(this).prop("checked")) {
            $('#selectAll').prop("checked", false);
        }
    });



    // Mass Delete Functionality
    $('#deleteSelected').on('click', function() {
        var selectedIds = [];

        $('.iproduct-check:checked').each(function() {
            selectedIds.push($(this).val());
        });

        if (selectedIds.length === 0) {
            alert("Please select at least one iproduct to delete.");
            return;
        }

        if (!confirm("Are you sure you want to delete the selected iproducts?")) {
            return;
        }

        $.ajax({
            url: "{{ route('iproduct.massDelete') }}",
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
                alert("An error occurred while deleting iproducts.");
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

