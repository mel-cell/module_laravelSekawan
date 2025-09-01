<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shelf;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ShelfRequest;

class ShelfController extends Controller
{
    public function index(): View
    {
       return view('page.admin.shelf');
    }

    public function store(ShelfRequest $request): RedirectResponse
    {
       $validaetedData = $request->validated();
       $operation = Shelf::create($validaetedData);
       if($operation){
            return redirect()->route('admin.shelf')->with('success', 'Shelf created successfully.');
       } else {
            return redirect()->route('admin.shelf')->with('error', 'Failed to create shelf.');
       }
    }

    public function update(ShelfRequest $request, int $id): RedirectResponse
    {
       $validaetedData = $request->validated();
       $operation = Shelf::where('id', $id)->update($validaetedData);
       if($operation){
            return redirect()->route('admin.shelf')->with('success', 'Shelf updated successfully.');
       } else {
            return redirect()->route('admin.shelf')->with('error', 'Failed to update shelf.');
       }
    }

    public function destroy(int $id): RedirectResponse
    {
       $operation = Shelf::where('id', $id)->delete();
       if($operation){
            return redirect()->route('admin.shelf')->with('success', 'Shelf deleted successfully.');
       } else {
            return redirect()->route('admin.shelf')->with('error', 'Failed to delete shelf.');
       }
    }
}
