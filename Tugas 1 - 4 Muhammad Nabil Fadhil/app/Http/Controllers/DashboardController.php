<?php
// DashboardController.php
namespace App\Http\Controllers;

use App\Models\Papan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $data = Papan::getDashboardData($user);

        return view('papanboard', compact('data'));
    }
}