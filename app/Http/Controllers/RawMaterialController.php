<?php

namespace App\Http\Controllers;

use App\Outlet;
use App\Raw_material;
use Illuminate\Http\Request;

class RawMaterialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $raw_materials = Raw_material::with('outlet')->orderBy('created_at', 'DESC')->paginate(10);
        return view('materials.index', compact('raw_materials'));
    }

    public function create()
    {
        $outlets = Outlet::orderBy('outlet', 'ASC')->get();
        return view('materials.create', compact('outlets'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'outlet_id' => 'required|exists:outlets,id',
            'raw_material' => 'required|string|max:100',
            'stock' => 'required|string|',
            'uom' => 'required|string|max:100'
        ]);

        try {
            $raw_material = Raw_material::create([
                'outlet_id' => $request->outlet_id,
                'raw_material' => $request->raw_material,
                'stock' => $request->stock,
                'uom' => $request->uom

            ]);
            return redirect(route('material.index'))
                ->with(['success' => '<strong>' . $raw_material->raw_material . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $raw_materials = Raw_material::findOrFail($id);

        $raw_materials->delete();
        return redirect()->back()->with(['success' => '<strong>' . $raw_materials->raw_material . '</strong> Telah Dihapus!']);
    }

    public function edit($id)
    {
        $raw_material = Raw_material::findOrFail($id);
        $outlets = Outlet::orderBy('outlet', 'ASC')->get();
        return view('materials.edit', compact('raw_material','outlets'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'outlet_id' => 'required|exists:outlets,id',
            'raw_material' => 'required|string|max:100',
            'stock' => 'required|string|max:100',
            'uom' => 'required|string|max:100'

        ]);

        try {
            $raw_material = Raw_material::findOrFail($id);

            $raw_material->update([
                'outlet_id' => $request->outlet_id,
                'raw_material' => $request->raw_material,
                'stock' => $request->stock,
                'uom' => $request->uom
            ]);

            return redirect(route('material.index'))
                ->with(['success' => '<strong>' . $raw_material->name . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
}
