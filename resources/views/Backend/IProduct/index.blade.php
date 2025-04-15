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
                            <i class="fa-solid fa-plus"></i> Add iProduct
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

                  iProduct List
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped display" id="iproductTable" >
                      <thead>
                        {{--  $category=Category::select('id','category_name')->get();
        $color=Color::select('id','color_name')->get();
        $size=Size::select('id','size_name')->get();
        $iproduct=IProduct::select('id','product_name','sku','price','category_id','color_id','size_id')->get();
       return view('Backend.IProduct.index',compact('iproduct','category','color',,'size_id','created_at',"updated_at")->get();--}}
                        <tr>
                            <th><input type="checkbox" class="form-check-input" id="selectAll"></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Size</th>
                            <th>Color</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Actions</th>
                        </tr>
                      </thead>
                     @if($iproduct)
                     <tbody>
                       @foreach($iproduct as $ipr)
                        <tr>
                            <td><input type="checkbox" class="iproduct-check form-check-input" value="{{$ipr->id}}"></td>
                            <td>{{$ipr->id}}</td>
                            <td>{{$ipr->product_name}}</td>
                            <td>{{$ipr->sku}}</td>

                            <td>₹ {{$ipr->price}}</td>

                            <td>{{ $ipr->category->category_name ?? 'N/A' }}</td>
                            <td>{{ $ipr->size->size_name ?? 'N/A' }}</td>
                            <td>{{ $ipr->color->color_name ?? 'N/A' }}</td>



                            <td>{{$ipr->created_at}}</td>
                            <td>{{$ipr->updated_at}}</td>
                            <td>
                                <a href="{{Route('iproduct.show', $ipr->id)}}" class="btn btn-light" title="Show"><i class="fa-solid fa-eye"></i></a>
                                <a href="{{Route('iproduct.edit', $ipr->id)}}" class="btn btn-light" title="Edit"><i class="fas fa-edit"></i></a>

                                <form action="{{Route('iproduct.destroy', $ipr->id)}}" method="POST" style="display: inline-block">
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

