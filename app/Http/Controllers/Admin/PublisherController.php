<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublisherRequest;
use App\Models\Publisher; // Sesuaikan namespace
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PublisherController extends Controller
{
    public function index(): View
    {
        return view('page.admin.publisher');
    }

    public function store(PublisherRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        $operation = Publisher::createNewPublisher($validatedData);

        if ($operation) {
            return redirect()->route('admin.publisher')->with('success', 'Data penerbit berhasil ditambahkan.');
        } else {
            return redirect()->route('admin.publisher')->with('error', 'Gagal menambahkan data penerbit.');
        }
    }

    public function update(PublisherRequest $request, string $id): RedirectResponse
    {
        $validatedData = $request->validated();
        $operation = Publisher::updateExistingPublisher($validatedData, $id);

        if ($operation) {
            return redirect()->route('admin.publisher')->with('success', 'Data penerbit berhasil diperbarui.');
        } else {
            return redirect()->route('admin.publisher')->with('error', 'Gagal memperbarui data penerbit.');
        }
    }

    public function destroy(string $id): RedirectResponse
    {
        $operation = Publisher::deletePublisherById($id);

        if ($operation) {
            return redirect()->route('admin.publisher')->with('success', 'Data penerbit berhasil dihapus.');
        } else {
            return redirect()->route('admin.publisher')->with('error', 'Gagal menghapus data penerbit.');
        }
    }
}

