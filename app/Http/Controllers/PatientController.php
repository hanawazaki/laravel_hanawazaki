<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hospitals = Hospital::orderBy('name')->get();
        $patients = Patient::latest()->paginate(10);
        return view('patients.index', compact('patients', 'hospitals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::orderBy('name')->get();

        return view('patients.create', compact('hospitals'));
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
        ]);
        Patient::create($request->all());

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan.');
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
        $patient = Patient::findOrFail($id);
        $hospitals = Hospital::orderBy('name')->get();

        return view('patients.edit', compact('patient', 'hospitals'));
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
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update($request->all());

        return redirect()->route('patients.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Patient $patient)
    {
        try {
            $patient->delete();

            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Patient deleted successfully!'
                ]);
            }

            return redirect()->route('patients.index')
                ->with('success', 'Patient deleted successfully');
        } catch (\Exception $e) {
            if (request()->ajax() || request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to delete patient: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Failed to delete patient: ' . $e->getMessage());
        }
    }

    public function filter(Request $request)
    {
        try {

            $query = Patient::with('hospital');

            if ($request->filled('hospital_id')) {
                $query->where('hospital_id', $request->hospital_id);
            }

            $patients = $query->latest()->paginate(10);

            if ($request->ajax()) {
                return view('patients.table', compact('patients'))->render();
            }

            $hospitals = Hospital::orderBy('nama_rumah_sakit')->get();
            return view('patients.index', compact('patients', 'hospitals'));
        } catch (\Exception $e) {
            \Log::error('Filter error: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }

            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
