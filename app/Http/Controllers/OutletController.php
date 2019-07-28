<?php

namespace App\Http\Controllers;

use App\Outlet;
use Illuminate\Http\Request;
use App\Business;
use Illuminate\Support\Facades\File;
use Image;

class OutletController extends Controller
{
    public function index()
    {
        $outlets = Outlet::with('business')->orderBy('created_at', 'DESC')->paginate(10);
        return view('outlets.index', compact('outlets'));
    }

    public function create()
    {
        $businesses = Business::orderBy('business_name', 'ASC')->get();
        return view('outlets.create', compact('businesses'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'business_id' => 'required|exists:businesses,id',
            'outlet' => 'required|string|max:100',
            'note' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'phone_number' => 'nullable|required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->outlet, $request->file('photo'));
            }

            $outlet = Outlet::create([
                'business_id' => $request->business_id,
                'outlet' => $request->outlet,
                'note' => $request->note,
                'address' => $request->address,
                'city' => $request->city,
                'phone_number' => $request->phone_number,
                'photo' => $photo
            ]);
            return redirect(route('outlet.index'))
                ->with(['success' => '<strong>' . $outlet->outlet . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($outlet, $photo)
    {
        $images = str_slug($outlet) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/outlet');

        if (!is_dir($path)) {
            File::makedirectory($path, 0777, true, true);
        }
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }

    public function destroy($id)
    {
        $outlets = Outlet::findOrFail($id);
        if (!empty($outlets->photo)) {
            File::delete(public_path('uploads/outlet/' . $outlets->photo));
        }
        $outlets->delete();
        return redirect()->back()->with(['success' => '<strong>' . $outlets->outlets . '</strong> Telah Dihapus!']);
    }

    public function edit($id)
    {
        $outlet = Outlet::findOrFail($id);
        $businesses = Business::orderBy('business_name', 'ASC')->get();
        return view('outlets.edit', compact('outlet', 'businesses'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            // 'business_id' => 'required|exists:businesses,id',
            'outlet' => 'required|string|max:100',
            'note' => 'required|string|max:100',
            'address' => 'required|string|max:100',
            'city' => 'required|string|max:100',
            'phone_number' => 'nullable|required|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $outlet = Outlet::findOrFail($id);
            $photo = $outlet->photo;

            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/outlet/' . $photo)):null;
                $photo = $this->saveFile($request->outlet, $request->file('photo'));
          }

            $outlet->update([
                // 'business_id' => $request->business_id,
                'outlet' => $request->outlet,
                'note' => $request->note,
                'address' => $request->address,
                'city' => $request->city,
                'phone_number' => $request->phone_number,
                'photo' => $photo
            ]);

            return redirect(route('outlet.index'))
                ->with(['success' => '<strong>' . $outlet->outlet . '</strong> Diperbaharui']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }
}
