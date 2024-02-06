<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\idea;
class DashboardController extends Controller
{
    //
    public function index()
    {
        $ideas = idea::when(request()->has('search') , function($query){
            $query->search(request()->get('search',''));
        })->orderBy('created_at',"DESC")->paginate(5);
        return view('dashboard', ['ideas' => $ideas]);
    }
}
