<?php

namespace App\Http\Controllers;

use App\Business;
use Illuminate\Http\Request;
use App\Business_category;
use App\User;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::orderBy('created_at', 'DESC')->paginate(10);
        return view('businesses.index', compact('businesses'));
    }

    public function create()
    {
        $business_categories = Business_category::orderBy('category', 'ASC')->get();
        return view('businesses.create', compact('business_categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'business_name' => 'required|string|max:100',
            'business_category_id' => 'required|exists:business_categories,id',
            'description' => 'nullable|string|max:100',
            'office_address' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:12'
        ]);

        try {
            $business = Business::create([
                'business_name' => $request->business_name,
                'business_category_id' => $request->business_category_id,
                'description' => $request->description,
                'office_address' => $request->office_address,
                'city' => $request->city,
                'phone' => $request->phone


            ]);
            return redirect(route('bisnis.index'))
                ->with(['success' => '<strong>' . $business->business_name . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        $business = Business::findOrFail($id);
        $business_categories = Business_category::orderBy('category', 'ASC')->get();
        return view('business.edit', compact('business', 'business_categories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [

            'business_name' => 'required|string|max:100',
            'business_category_id' => 'required|exists:business_categories,id',
            'description' => 'nullable|string|max:100',
            'office_address' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'phone' => 'required|string|max:12'

        ]);

        try {
            $business = Business::findOrFail($id);

            $business->update([
                
                'business_name' => $request->business_name,
                'business_category_id' => $request->business_category_id,
                'description' => $request->description,
                'office_address' => $request->office_address,
                'city' => $request->city,
                'phone' => $request->phone

            ]);

            return redirect(route('home'))
                ->with(['success' => '<strong>' . $business->business_name . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
}
