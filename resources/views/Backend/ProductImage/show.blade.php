@extends('Backend.layouts.backend')

@section('title')
Show Product Image
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      <a href="{{Route('productimage.index')}}" class="btn btn-primary"><i class="fa-solid fa-list"></i> Product Image List</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            {{-- productimage --}}
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header"><h3><i class="fa-solid fa-image"></i> Product Image Detail</h3></div>
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                              <tr>
                                <th>Image ID</th>
                                <td>{{$productimage->id}}</td>
                              </tr>
                              <tr>
                                <th>Image Name</th>
                                <td>{{$productimage->product_img}}</td>
                              </tr>
                              <tr>
                                <th>Created At</th>
                                <td>{{$productimage->created_at}}</td>
                              </tr>
                              <tr>
                                <th>Updated At</th>
                                <td>{{$productimage->updated_at}}</td>
                              </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h3><i class="fa-solid fa-image"></i> Product Image Preview</h3></div>
                    <div class="card-body">
                        <div class="mb-3">
                            <img id="product_img_preview"
                                 src="{{ asset('storage/product_images/' . $productimage->product_img) }}"
                                 alt="Image Preview"
                                 class="product-preview-image" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>


@endsection

@push('css')
<style>
    .product-preview-image {
        max-width: 75vw;
        max-height: 75vh;
        width: auto;
        height: auto;
        border-radius: var(--border-radius-md);
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
        border: 2px solid var(--border-color);
        padding: 5px;
        overflow: auto;
        box-shadow: var(--shadow-md);
    }


    .form-text.small {
        color: var(--text-muted);
        font-size: var(--font-size-sm);
        margin-top: 0.25rem;
    }
</style>
@endpush
