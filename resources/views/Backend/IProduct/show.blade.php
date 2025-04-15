@extends('Backend.layouts.backend')

@section('title')
Show I-Product Details
@endsection

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3><i class="fas fa-eye"></i> Product Details</h3>
                        <a href="{{ route('iproduct.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> Product List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Basic Details --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h3><i class="fas fa-info-circle"></i> Basic Information</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{$iProduct->id}}</td>
                                </tr>
                                <tr>
                                    <th width="150">Product Name</th>
                                    <td>{{ $iProduct->product_name }}</td>
                                </tr>
                                <tr>
                                    <th>Sub Title</th>
                                    <td>{{ $iProduct->sub_title }}</td>
                                </tr>
                                <tr>
                                    <th>SKU</th>
                                    <td>{{ $iProduct->sku }}</td>
                                </tr>
                                <tr>
                                    <th>Price</th>
                                    <td>₹{{ number_format($iProduct->price, 2) }}</td>
                                </tr>
                                <tr>
                                    <th>Description</th>
                                    <td>{{ $iProduct->description }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Relationships --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header">
                        <h3><i class="fas fa-link"></i> Related Information</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th width="150">Category</th>
                                    <td>{{ $iProduct->category->category_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Color</th>
                                    <td>{{ $iProduct->color->color_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Size</th>
                                    <td>{{ $iProduct->size->size_name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Created At</th>
                                    <td>{{ optional($iProduct->created_at)->format('d M Y, h:i A') ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Updated At</th>
                                    <td>{{ optional($iProduct->updated_at)->format('d M Y, h:i A') ?? 'N/A' }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Images --}}
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h3><i class="fas fa-images"></i> Product Images</h3>
                    </div>
                    <div class="card-body">
                        @if($iProduct->productImages->count() > 0)
                            <div class="row">
                                @foreach($iProduct->productImages as $image)
                                    <div class="col-md-11 mb-3" style="margin-left: 5px">
                                        <div class="card">
                                            <img src="{{ asset('storage/iproduct_img/' . $image->product_img) }}"
                                                 class="card-img-top"
                                                 alt="Product Image"
                                                 style="height: auto; width:50vh; object-fit: cover;">
                                            <div class="card-footer text-center">
                                                <small class="text-muted">
                                                    Added: {{ $image->created_at->diffForHumans() }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-info">
                                No images available for this product.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('css')
<style>
    .card {
        box-shadow: var(--shadow-sm);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: var(--shadow-md);
    }

    .table th {
        background-color: var(--light-color);
    }

    .card-img-top {
        transition: transform 0.3s ease;
    }

</style>
@endpush
