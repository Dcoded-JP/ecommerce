@extends('Backend.layouts.backend')

@section('title')
Dashboard
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">
      <div class="row mb-4">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <i class="fas fa-chart-line me-2"></i>
              Sales Overview
            </div>
            <div class="card-body">
              <p>This is where you would display sales charts and key metrics for your clothing store.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <!-- Quick Stats -->
        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                  <i class="fas fa-tshirt text-primary fs-4"></i>
                </div>
                <div>
                  <h5 class="mb-0">1,245</h5>
                  <small class="text-muted">Total Products</small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="bg-success bg-opacity-10 p-3 rounded me-3">
                  <i class="fas fa-shopping-bag text-success fs-4"></i>
                </div>
                <div>
                  <h5 class="mb-0">328</h5>
                  <small class="text-muted">Today's Orders</small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="bg-warning bg-opacity-10 p-3 rounded me-3">
                  <i class="fas fa-dollar-sign text-warning fs-4"></i>
                </div>
                <div>
                  <h5 class="mb-0">$12,845</h5>
                  <small class="text-muted">Today's Revenue</small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="bg-danger bg-opacity-10 p-3 rounded me-3">
                  <i class="fas fa-users text-danger fs-4"></i>
                </div>
                <div>
                  <h5 class="mb-0">1,892</h5>
                  <small class="text-muted">New Customers</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Recent Orders -->
      <div class="row mt-4">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <i class="fas fa-shopping-cart me-2"></i>
              Recent Orders
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Customer</th>
                      <th>Items</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Total</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>#ORD-2023-001</td>
                      <td>John Doe</td>
                      <td>2</td>
                      <td>Today, 10:45 AM</td>
                      <td><span class="badge bg-warning text-dark">Processing</span></td>
                      <td>$149.99</td>
                      <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                    </tr>
                    <tr>
                      <td>#ORD-2023-002</td>
                      <td>Jane Smith</td>
                      <td>1</td>
                      <td>Today, 09:30 AM</td>
                      <td><span class="badge bg-success">Completed</span></td>
                      <td>$79.99</td>
                      <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                    </tr>
                    <tr>
                      <td>#ORD-2023-003</td>
                      <td>Robert Johnson</td>
                      <td>3</td>
                      <td>Yesterday</td>
                      <td><span class="badge bg-info">Shipped</span></td>
                      <td>$210.50</td>
                      <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection

