<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title','Ecommerce Admin')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  {{-- <link rel="stylesheet" href="/css/backend/styles.css"> --}}
  <link rel="stylesheet" href="{{asset('/css/backend/styles.css')}}">

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

{{-- Chart Js  --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @stack('css')
</head>
<body>


  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <div class="sidebar-header">
      <a href="#" class="sidebar-brand">
        <img src="{{asset('images/backend/john.jpg')}}" alt="Logo">
        Admin Crafto
      </a>
      <button class="sidebar-close" id="sidebarClose">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <ul class="sidebar-menu">
      <li>
        <a href="{{Route('admin.dashboard')}}" class="nav-link active">
          <i class="fas fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <!-- Products Section -->
      <li>
        <a href="#productsSubmenu" class="nav-link" data-bs-toggle="collapse">
          <i class="fas fa-tshirt"></i>
          <span>Products</span>
          <i class="fas fa-angle-down arrow"></i>
        </a>
        <ul class="submenu collapse show" id="productsSubmenu">
          <li><a href="{{Route('iproduct.index')}}" class="nav-link">All Products</a></li>
          <li><a href="{{Route('iproduct.create')}}" class="nav-link">Add New Product</a></li>
          <li><a href="#" class="nav-link">Tags & Attributes</a></li>
          <li><a href="#" class="nav-link">Inventory</a></li>
        </ul>
      </li>


      <!-- Orders Section -->
      <li>
        <a href="#ordersSubmenu" class="nav-link collapsed" data-bs-toggle="collapse">
          <i class="fas fa-shopping-bag"></i>
          <span>Orders</span>
          <i class="fas fa-angle-down arrow"></i>
        </a>
        <ul class="submenu collapse" id="ordersSubmenu">
          <li><a href="#" class="nav-link">All Orders</a></li>
          <li><a href="#" class="nav-link">Pending</a></li>
          <li><a href="#" class="nav-link">Processing</a></li>
          <li><a href="#" class="nav-link">Completed</a></li>
          <li><a href="#" class="nav-link">Cancelled</a></li>
          <li><a href="#" class="nav-link">Returns</a></li>
        </ul>
      </li>

      <!-- Customers Section -->
      <li>
        <a href="#" class="nav-link">
          <i class="fas fa-users"></i>
          <span>Customers</span>
        </a>
      </li>

      <!-- Marketing Section -->
      <li>
        <a href="#marketingSubmenu" class="nav-link collapsed" data-bs-toggle="collapse">
          <i class="fas fa-bullhorn"></i>
          <span>Marketing</span>
          <i class="fas fa-angle-down arrow"></i>
        </a>
        <ul class="submenu collapse" id="marketingSubmenu">
          <li><a href="#" class="nav-link">Discounts & Coupons</a></li>
          <li><a href="#" class="nav-link">Email Campaigns</a></li>
          <li><a href="#" class="nav-link">Social Media</a></li>
          <li><a href="#" class="nav-link">Banners & Promotions</a></li>
        </ul>
      </li>

      <!-- Reports Section -->
      <li>
        <a href="#" class="nav-link">
          <i class="fas fa-chart-pie"></i>
          <span>Reports</span>
        </a>
      </li>



      <!-- Master Section -->
      <li>
        <a href="#masterSubmenu" class="nav-link collapsed" data-bs-toggle="collapse">
          <i class="fa-solid fa-server"></i>
          <span>Master</span>
          <i class="fas fa-angle-down arrow"></i>
        </a>
        <ul class="submenu collapse" id="masterSubmenu">
          <li><a href="{{Route('category.index')}}" class="nav-link">Category</a></li>
          <li><a href="{{Route('color.index')}}" class="nav-link">Color</a></li>
          <li><a href="{{Route('size.index')}}" class="nav-link">Size</a></li>
        </ul>
      </li>


      <!-- Settings Section -->
      <li>
        <a href="#settingsSubmenu" class="nav-link collapsed" data-bs-toggle="collapse">
          <i class="fas fa-cog"></i>
          <span>Settings</span>
          <i class="fas fa-angle-down arrow"></i>
        </a>
        <ul class="submenu collapse" id="settingsSubmenu">
          <li><a href="#" class="nav-link">Store Settings</a></li>
          <li><a href="#" class="nav-link">Shipping</a></li>
          <li><a href="#" class="nav-link">Payment Methods</a></li>
          <li><a href="#" class="nav-link">Tax Settings</a></li>
          <li><a href="#" class="nav-link">Staff Accounts</a></li>
        </ul>
      </li>
    </ul>
  </div>

  <!-- Overlay -->
  <div class="overlay" id="overlay"></div>

  <!-- Header -->
  <div class="header">
    <span class="menu-toggle" id="menuToggle">
      <i class="fas fa-bars" id="toggleIcon"></i>
    </span>

    <div class="user-actions">
      <div class="position-relative">
        <i class="fas fa-bell" style="font-size: 1.2rem;"></i>
        <span class="notification-badge">5</span>
      </div>

      <div class="user-profile">
        <img src="{{asset('images/backend/roman-face.jpg')}}" alt="User" class="user-avatar">
        <span>Admin</span>
        <i class="fas fa-angle-down" style="font-size: 0.9rem;"></i>
      </div>
    </div>
  </div>
