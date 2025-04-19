<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\IProduct;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use App\Models\OrderItem;

class DashboardController extends Controller
{
    // example dashboard https://phoenix-react.prium.me/pages/demo/vertical-sidenav
    public function dashboardShow()
    {
        $totalProducts= $this->getTotalProduct();
        $totleCategories = $this->getCategory();
        $monthlySales = $this->getMonthlySales(); // Add method to get monthly sales
        $categoryDistribution = $this->getCategoryDistribution(); // Add method to get category distribution
        $order=Order::all();
        $orderItem=OrderItem::all();
        return view('Backend.Dashboard.dashboard', compact(
            'totleCategories',
            'monthlySales',
            'categoryDistribution',
            'totalProducts',
            'order',
            'orderItem'
        ));
    }

    private function getCategory(){

        try{
            return (Category::count());

        }catch(\Exception $e) {
            Log::error('Total Category get error: ' . $e->getMessage());
            return "Not Found 'Category Count'";
        }


    }

    private function getMonthlySales()
    {
        // Implement your sales calculation logic here
        // Example:
        return [
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            'data' => [12000, 19000, 15000, 25000, 22000, 30000]
        ];
    }

    private function getCategoryDistribution()
    {
        // Implement your category distribution logic here
        // Example:
        return [
            'labels' => ['T-Shirts', 'Jeans', 'Dresses', 'Accessories'],
            'data' => [30, 25, 25, 20]
        ];
    }


    private function getTotalProduct(){
        return (IProduct::count());
    }

    public function showOrder($id){
        $o=Order::find($id);
        $oi=OrderItem::where('order_id',$id);
        return view('Backend.Dashboard.orderShow',compact('o','oi'));
    }
}
