<?php

namespace App\Http\Controllers; 

use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller
{
    // example dashboard https://phoenix-react.prium.me/pages/demo/vertical-sidenav
    public function dashboardShow()
    {
        $totleCategories = $this->getCategory();
        $monthlySales = $this->getMonthlySales(); // Add method to get monthly sales
        $categoryDistribution = $this->getCategoryDistribution(); // Add method to get category distribution

        return view('Backend.Dashboard.dashboard', compact(
            'totleCategories',
            'monthlySales',
            'categoryDistribution'
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
}
