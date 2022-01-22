<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function index()
    {
        return Manufacturer::with('carmodel')->get();;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:manufacturers,name|max:32'
        ]);
        return Manufacturer::create($request->all());
    }

    public function show($id)
    {
        $manufacturer =  Manufacturer::with('carmodel')->get()->find($id);
        if ($manufacturer === null) {
            return response()->json(['error' => 'Manufacturer with id = ' . $id . ' not found.'], 404);
        }
        return $manufacturer;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:manufacturers,name|max:32'
        ]);
        $manufacturer = Manufacturer::find($id);
        if ($manufacturer === null) {
            return response()->json(['error' => 'Manufacturer with id = ' . $id . ' not found.'], 404);
        }
        $manufacturer->update($request->all());
        return $manufacturer;
    }

    public function destroy($id)
    {
        $manufacturer = Manufacturer::find($id);
        if ($manufacturer === null) {
            return response()->json(['error' => 'Manufacturer with id = ' . $id . ' not found.'], 404);
        }
        if (json_decode(Manufacturer::with('carmodel')->get()->find($id))->carmodel != null) {
            return response()->json(['error' => 'Manufacturer with id = ' . $id . ' has carModels. Please delete carModels first'], 404);
        }
        Manufacturer::destroy($id);
        return response()->json([], 200);
    }
}
