<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Outlet;
use App\Product;
use App\Raw_material;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::with('raw_material')->orderBy('created_at', 'DESC')->paginate(10);
        return view('materials.index', compact('ingredients'));
    }

    public function create()
    {
        $outlets = Outlet::orderBy('outlet', 'ASC')->get();
        $products = Product::orderBy('name', 'ASC')->get();
        $raw_materials = Raw_material::orderBy('raw_material','uom','ASC')->get();
        return view('ingredients.create', compact('products','outlets','raw_materials'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'outlet_id' => 'required|exists:outlets,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'product_id' => 'required|exists:products,id',
            'stock_used' => 'required|integer'
        ]);

        try {
            $ingredient = Ingredient::create([
                'outlet_id' => $request->outlet_id,
                'raw_material_id' => $request->raw_material_id,
                'product_id' => $request->product_id,
                'stock_used' => $request->stock_used

            ]);
            return redirect(route('resep.create'))
                ->with(['success' => '<strong>' . $ingredient->raw_material . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }


    public function destroy($id)
    {
        $ingredients = Ingredient::findOrFail($id);

        $ingredients->delete();
        return redirect()->back()->with(['success' => '<strong>' . $ingredients->product_id . '</strong> Telah Dihapus!']);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $raw_materials = Raw_material::orderBy('raw_material', 'ASC')->get();
        $outlets = Outlet::orderBy('outlet', 'ASC')->get();
        return view('ingredients.edit', compact('product', 'raw_materials','outlets'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'outlet_id' => 'required|exists:outlets,id',
            'raw_material_id' => 'required|exists:raw_materials,id',
            'product_id' => 'required|exists:products,id',
            'stock_used' => 'required|integer'
        ]);

        try {
            $product = Product::findOrFail($id);

            $product->update([
                'outlet_id' => $request->coutlet_id,
                'raw_material_id' => $request->raw_material_id,
                'product_id' => $request->product_id,
                'stock_used' => $request->stock_used,
            ]);

            return redirect()->back()->with(['success' => 'Ingredient: <strong>' .  '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
}
