@extends('Backend.layouts.backend')

@section('title', 'Order Details')

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Order #{{ $o->id }}</h4>
                        <span class="badge bg-{{ $o->status == 'completed' ? 'success' : ($o->status == 'pending' ? 'warning' : 'info') }}">
                            {{ ucfirst($o->status) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <!-- Customer Information -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Billing Information</h5>
                                <p>
                                    <strong>Name:</strong> {{ $o->first_name }} {{ $o->last_name }}<br>
                                    <strong>Company:</strong> {{ $o->company_name ?? 'N/A' }}<br>
                                    <strong>Email:</strong> {{ $o->email }}<br>
                                    <strong>Phone:</strong> {{ $o->phone }}<br>
                                    <strong>Address:</strong><br>
                                    {{ $o->street_address }}<br>
                                    {{ $o->apartment ? $o->apartment  : '' }}&nbsp; <br>
                                    {{ $o->city }}, {{ $o->state }} {{ $o->zip_code }}<br>
                                    {{ $o->country }}
                                </p>
                            </div>
                            @if($o->different_shipping)
                            <div class="col-md-6">
                                <h5>Shipping Information</h5>
                                <p>
                                    <strong>Name:</strong> {{ $o->shipping_first_name }} {{ $o->shipping_last_name }}<br>
                                    <strong>Company:</strong> {{ $o->shipping_company_name ?? 'N/A' }}<br>
                                    <strong>Address:</strong><br>
                                    {{ $o->shipping_street_address }}<br>
                                    {{ $o->shipping_apartment ? $o->shipping_apartment  : '' }}&nbsp;
                                    {{ $o->shipping_city }}, {{ $o->shipping_state }} {{ $o->shipping_zip_code }}<br>
                                    {{ $o->shipping_country }}
                                </p>
                            </div>
                            @endif
                        </div>

                        <!-- Order Items -->
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach($oi as $item)

                                  <tr>

                                     <td>{{ $item->product_name }}</td>
                                      <td>{{ $item->size }}</td>
                                     <td>
                                            <span class="color-dot" style="background-color: {{ $item->color }}" title=" {{ $item->color }}"></span>
                                            {{ $item->color }}
                                        </td>
                                       <td>${{ number_format($item->price, 2) }}</td>
                                       <td>{{ $item->quantity }}</td>
                                       <td>${{ number_format($item->price * $item->quantity, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5" class="text-end">Subtotal:</td>
                                        <td>${{ number_format($o->subtotal, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end">Shipping Cost:</td>
                                        <td>${{ number_format($o->shipping_cost, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end">Tax:</td>
                                        <td>${{ number_format($o->tax, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="text-end"><strong>Total:</strong></td>
                                        <td><strong>${{ number_format($o->total, 2) }}</strong></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Additional Information -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <h5>Order Notes</h5>
                                <p>{{ $o->order_notes ?? 'No notes provided' }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Additional Details</h5>
                                <p>
                                    <strong>Order Date:</strong> {{ $o->created_at->format('F j, Y g:i A') }}<br>
                                    <strong>Payment Method:</strong> {{ ucfirst($o->payment_method) }}<br>
                                    <strong>Shipping Method:</strong> {{ ucfirst($o->shipping_method) }}
                                </p>
                            </div>
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
.color-dot {
    display: inline-block;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-right: 8px;
    vertical-align: middle;
    border: 1px solid #ddd;
}

.badge {
    font-size: 0.9rem;
    padding: 8px 16px;
}

.table td, .table th {
    vertical-align: middle;
}

.card {
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}
</style>
@endpush
