<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorController extends Controller
{
   public function index(Request $request)
{
    $query = Sensor::query();

    if ($request->search) {
        $search = $request->search;

        $query->where(function ($q) use ($search) {
            $q->where('sensor_name', 'like', "%{$search}%")
              ->orWhere('sensor_type', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
        });
    }

    if ($request->has('status')) {
        $query->where('status', $request->status);
    }

    $sensors = $query->latest()->paginate(10);

    return view('sensors.index', compact('sensors'));
}



    public function create()
    {
        return view('sensors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'sensor_name' => 'required|string|max:255',
            'sensor_type' => 'required|string|max:100',
            'value' => 'required|numeric',
            'unit' => 'required|string|max:50',
            'location' => 'nullable|string|max:255',
            'status' => 'boolean'
        ]);

        Sensor::create($request->all());

        return redirect()->route('sensors.index')
            ->with('success', 'Sensor berhasil ditambahkan.');
    }

    public function show(Sensor $sensor)
    {
        return view('sensors.show', compact('sensor'));
    }

    public function edit(Sensor $sensor)
    {
        return view('sensors.edit', compact('sensor'));
    }

    public function update(Request $request, Sensor $sensor)
    {
        $request->validate([
            'sensor_name' => 'required|string|max:255',
            'sensor_type' => 'required|string|max:100',
            'value' => 'required|numeric',
            'unit' => 'required|string|max:50',
            'location' => 'nullable|string|max:255',
            'status' => 'boolean'
        ]);

        $sensor->update($request->all());

        return redirect()->route('sensors.index')
            ->with('success', 'Sensor berhasil diupdate.');
    }

    public function destroy(Sensor $sensor)
    {
        $sensor->delete();
        return redirect()->route('sensors.index')
            ->with('success', 'Sensor berhasil dihapus.');
    }

    
}