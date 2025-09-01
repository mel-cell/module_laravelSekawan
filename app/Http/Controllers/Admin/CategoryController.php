<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index(): View
    {
         $categories = Category::getAllCategories(10);
         return view('page.admin.category', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
         $validatedData = $request->validate([
             'category_name' => 'required|string|max:100',
             'category_description' => 'nullable|string|max:255',
         ]);

         $operation = Category::create($validatedData);
         if($operation){
              return redirect()->route('admin.category')->with('success', 'Category created successfully.');
         } else {
              return redirect()->route('admin.category')->with('error', 'Failed to create category.');
         }
    }

    public function update(Request $request, int $id): RedirectResponse
    {
         $validatedData = $request->validate([
             'category_name' => 'required|string|max:100',
             'category_description' => 'nullable|string|max:255',
         ]);

         $operation = Category::where('id', $id)->update($validatedData);
         if($operation){
              return redirect()->route('admin.category')->with('success', 'Category updated successfully.');
         } else {
              return redirect()->route('admin.category')->with('error', 'Failed to update category.');
         }
    }

    public function destroy(int $id): RedirectResponse
    {
         $operation = Category::where('id', $id)->delete();
         if($operation){
              return redirect()->route('admin.category')->with('success', 'Category deleted successfully.');
         } else {
              return redirect()->route('admin.category')->with('error', 'Failed to delete category.');
         }
    }
}
