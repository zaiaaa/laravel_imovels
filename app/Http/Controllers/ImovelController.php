<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
// Use the Post Model
use App\Models\Imovel;
// We will use Form Request to validate incoming requests from our store and update method
use App\Http\Requests\Imovel\StoreRequest;
use App\Http\Requests\Imovel\UpdateRequest;

class ImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        return response()->view('imovels.index', [
            'imovels' => Imovel::orderBy('updated_at', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response()->view('imovels.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
             // put image in the public storage
            $filePath = Storage::disk('public')->put('images/imovels/fotos', request()->file('foto'));
            $validated['foto'] = $filePath;
        }

        // insert only requests that already validated in the StoreRequest
        $create = Imovel::create($validated);

        if($create) {
            // add flash for the success notification
            session()->flash('notif.success', 'Post created successfully!');
            return redirect()->route('imovels.index');
        }

        return abort(500);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        return response()->view('imovels.show', [
            'imovel' => Imovel::findOrFail($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        return response()->view('imovels.form', [
            'imovel' => Imovel::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        $imovel = Imovel::findOrFail($id);
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            // delete image
            Storage::disk('public')->delete($imovel->foto);

            $filePath = Storage::disk('public')->put('images/imovels/fotos', request()->file('foto'), 'public');
            $validated['foto'] = $filePath;
        }

        $update = $imovel->update($validated);

        if($update) {
            session()->flash('notif.success', 'Post updated successfully!');
            return redirect()->route('imovels.index');
        }

        return abort(500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $imovel = Imovel::findOrFail($id);

        Storage::disk('public')->delete($imovel->foto);
        
        $delete = $imovel->delete();

        if($delete) {
            session()->flash('notif.success', 'imovel deleted successfully!');
            return redirect()->route('imovels.index');
        }

        abort(500);
    }
}
