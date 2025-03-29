<?php

// app/Http/Controllers/ReportController.php
namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Category;

class ReportController extends Controller
{
    public function index() // Client
    {
        $expenses = Expense::where('user_id', auth()->id())->with('category')->get();
        $categories = Category::all();
        return view('reports.index', compact('expenses', 'categories'));
    }

    public function adminIndex() // Admin (RQ13)
    {
        $expenses = Expense::with('category', 'user')->get();
        $categories = Category::all();
        return view('admin.reports.index', compact('expenses', 'categories'));
    }
}