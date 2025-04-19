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
                                    <th>Colors</th>
                                    <td>
                                        @forelse($iProduct->color_details as $color)
                                            <span class="badge bg-primary"
                                                  style="background-color: {{ $color->color_code ?? $color_name }} !important">
                                                {{ $color->color_name }}
                                            </span>
                                        @empty
                                            <span class="text-muted">No colors assigned</span>
                                        @endforelse
                                    </td>
                                </tr>
                                <tr>
                                    <th>Sizes</th>
                                    <td>
                                        @forelse($iProduct->size_details as $size)
                                            <span class="badge bg-info">
                                                {{ $size->size_name }}
                                            </span>
                                        @empty
                                            <span class="text-muted">No sizes assigned</span>
                                        @endforelse
                                    </td>
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
                                    <div class="col-md-3 mb-3">
                                        <div class="card">
                                            <img src="{{ asset('storage/iproduct_img/' . $image->product_img) }}"
                                                 class="card-img-top"
                                                 alt="Product Image"
                                                 style="height: auto;max-width:90vw; object-fit: cover;">
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

    /* .card-img-top:hover {
        transform: scale(1.05);
    } */

    .badge {
        margin: 0.2rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: all 0.3s ease;
    }

    .badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px rgba(0,0,0,0.15);
    }

    .text-muted {
        font-style: italic;
    }
</style>
@endpush
