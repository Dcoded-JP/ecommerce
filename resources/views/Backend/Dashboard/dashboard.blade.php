@extends('Backend.layouts.backend')

@section('title')
Dashboard
@endsection


@section('content')
 <!-- Main Content -->
 <div class="content">
    <div class="container-fluid">

      <div class="row">
        <!-- Quick Stats -->
        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                  <i class="fas fa-tshirt text-primary fs-4"></i>
                </div>
                <div>
                  <h5 class="mb-0">{{$totalProducts}}</h5>
                  <small class="text-muted">Total Products</small>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
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

        <div class="col-md-4">
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

        <div class="col-md-4">
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

        <div class="col-md-4">
          <div class="card">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="bg-primary bg-opacity-10 p-3 rounded me-3">
                  <i class="fas fa-list-alt text-primary fs-4"></i>
                </div>
                <div>
                  <h5 class="mb-0">{{$totleCategories}}</h5>
                  <small class="text-muted">Categories</small>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

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

      <div class="row mb-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-line me-2"></i>
                    Monthly Sales
                </div>
                <div class="card-body">
                    <canvas id="salesChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-2"></i>
                    Product Categories
                </div>
                <div class="card-body">
                    <canvas id="categoryChart"></canvas>
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
              Orders

            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-hover" id="orderTable">
                  <thead>
                    {{-- 'order',
                    'orderItem' --}}
                    <tr>

                      <th style="max-width: 200px ;font-family:cursive">Order ID</th>
                      <th style="max-width: 200px ;font-family:cursive">Customer ID</th>
                      <th style="max-width: 200px ;font-family:cursive">Customer Name</th>
                      <th style="max-width: 200px ;font-family:cursive">Date</th>
                      <th style="max-width: 200px ;font-family:cursive">Status</th>
                      <th style="max-width: 200px ;font-family:cursive">Total Price</th>
                      <th style="max-width: 200px ;font-family:cursive">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($order)
                        @foreach($order as $o)
                            <tr>

                                <td>{{$o->id ? $o->id : 'null'}}</td>
                                <td>{{$o->user_id ? $o->user_id : 'null'}}</td>
                                <td>{{$o->first_name ? $o->first_name : 'null'}} {{$o->last_name ? $o->last_name : 'null'}}</td>
                                <td>{{$o->created_at ? $o->created_at : 'null'}}</td>
                                <td>Status here</td>
                                <td>{{$o->total ? $o->total : 'null'}}</td>
                                <td>
                                    <a href="{{Route('orderdetails.show',$o->id)}}" class="btn btn-outline-info" title="Show"><i class="fas fa-eye"></i></a>
                                    <a href="" class="btn btn-warning" title="Edit"><i class="fas fa-edit"></i></a>

                                    <form action="" method="POST" style="display: inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')"><i class="fa-solid fa-trash" title="Delete" ></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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



@push('js')
<script>
  // Monthly Sales Chart
  const salesCtx = document.getElementById('salesChart').getContext('2d');
  const salesChart = new Chart(salesCtx, {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Sales ($)',
            data: [12000, 19000, 15000, 25000, 22000, 30000],
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
  });

  // Category Distribution Chart
  const categoryCtx = document.getElementById('categoryChart').getContext('2d');
  const categoryChart = new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
        labels: ['T-Shirts', 'Jeans', 'Dresses', 'Accessories'],
        datasets: [{
            data: [30, 25, 25, 20],
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)'
            ]
        }]
    },
    options: {
        responsive: true
    }
  });








    $(document).ready(function () {
        // DataTable initialization
        var table = $('#orderTable').DataTable();
    });


</script>
@endpush

