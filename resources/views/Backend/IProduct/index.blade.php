@extends('Backend.layouts.backend')

@section('title')
Index I-Product
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row mt-4">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">

                    <div class="row mb-3">
                        <div class="col-md-6">

                                <h3>iProduct List</h3>


                        </div>

                        <div class="col-md-3" style="display:inline-block;margin-left:auto">
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
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{Route('iproduct.create')}}" class="btn btn-success">
                                <span title="Add I-Product">
                                    <i class="fa-solid fa-plus"></i> Add iProduct
                                </span>
                            </a>
                        </div>
                    </div>


                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-striped display" id="iproductTable" >
                      <thead>
                        {{--  $category=Category::select('id','category_name')->get();
        $iproduct=Color::select('id','color_name')->get();
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
                            <td>
                                @forelse($ipr->size_details as $size)
                                    <span class="badge bg-info">
                                        {{ $size->size_name }}
                                    </span>
                                @empty
                                    <span class="text-muted">N/A</span>
                                @endforelse
                            </td>
                            <td>
                                @forelse($ipr->color_details as $color)
                                    <span class="badge bg-primary"
                                          style="background-color: {{ $color->color_code ?? $color_name }} !important ; cursor: wait;" title="{{ $color->color_name }}">
                                        {{ $color->color_name }}
                                    </span>
                                @empty
                                    <span class="text-muted">N/A</span>
                                @endforelse
                            </td>
                            <td>{{ $ipr->created_at ? $ipr->created_at->format('d M Y, h:i A') : 'N/A' }}</td>
                            <td>{{ $ipr->updated_at ? $ipr->updated_at->format('d M Y, h:i A') : 'N/A' }}</td>
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
        // DataTable initialization
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

        // Handle bulk actions
        $('#actions').on('change', function() {
            var selectedAction = $(this).val();

            if (selectedAction === 'delete') {
                var selectedIds = [];

                $('.iproduct-check:checked').each(function() {
                    selectedIds.push($(this).val());
                });

                if (selectedIds.length === 0) {
                    Swal.fire({
                        title: 'Warning!',
                        text: 'Please select at least one iproduct to delete.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    $(this).val(''); // Reset select
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You want to delete the selected iproducts ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtoniproduct: '#3085d6',
                    cancelButtoniproduct: '#d33',
                    confirmButtonText: 'Yes, delete!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('iproduct.massDelete') }}",
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
                                    text: 'An error occurred while deleting iproducts.',
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
    .badge {
        margin: 0.2rem;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.75rem;
        white-space: nowrap;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .badge.bg-primary {
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    .badge.bg-primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.15);
    }

    .badge.bg-info {
        background-color: #0dcaf0;
        color: #000;
        box-shadow: 0 2px 4px rgba(13, 202, 240, 0.2);
    }

    .badge.bg-info:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(13, 202, 240, 0.3);
    }

    .text-muted {
        font-style: italic;
        color: #6c757d;
    }
</style>
@endpush

