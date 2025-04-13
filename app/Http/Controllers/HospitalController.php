<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::latest()->paginate(10);
        return view('hospitals.index', compact('hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hospitals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email',
        ]);
        // dd($request->all());
        // exit();

        Hospital::create($request->all());

        return redirect()->route('hospitals.index')->with('success', 'Rumah sakit berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hospital = Hospital::findOrFail($id);
        return view('hospitals.edit', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email',
        ]);

        // dd($request->all());
        // exit();
        $hospital = Hospital::findOrFail($id);
        $hospital->update($request->all());

        return redirect()->route('hospitals.index')->with('success', 'Rumah sakit berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hospital $hospital)
    {
        try {
            $hospital->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'rumah sakit berhasil dihapus!'
                ]);
            }

            return redirect()->route('patients.index')
                ->with('success', 'rumah sakit berhasil dihapus');
        } catch (\Exception $e) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'rumah sakit gagal dihapus: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'rumah sakit gagal dihapus: ' . $e->getMessage());
        }
    }
}
