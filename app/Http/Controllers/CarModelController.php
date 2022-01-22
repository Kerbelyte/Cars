<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use App\Models\Manufacturer;

class CarModelController extends Controller
{

    public function index()
    {
        return CarModel::all();
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'manufacturer_id' => 'required',
            'horsepower' => 'required',
            'fuel' => 'required',
            'year' => 'required']);

        if (Manufacturer::find($request->get('manufacturer_id')) === null) {
            return response()->json(['error' => 'Manufacturer with id = ' . $request->get('manufacturer_id') . ' not found.'], 404);
        }
        return CarModel::create($request->all());
    }

    public function show($id)
    {
        $carmodel = CarModel::find($id);
        if ($carmodel === null) {
            return response()->json(['error' => 'CarModel with id = ' . $id . ' not found.'], 404);
        }
        return $carmodel;
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'manufacturer_id' => 'required',
            'horsepower' => 'required',
            'fuel' => 'required',
            'year' => 'required']);
        $carmodel = CarModel::find($id);
        if ($carmodel === null) {
            return response()->json(['error' => 'CarModel with id = ' . $id . ' not found.'], 404);
        }
        if (Manufacturer::find($request->get('manufacturer_id')) === null) {
            return response()->json(['error' => 'Manufacturer with id = ' . $request->get('manufacturer_id') . ' not found.'], 404);
        }
        $carmodel->update($request->all());
        return $carmodel;
    }

    public function destroy($id)
    {
        $carmodel = CarModel::find($id);
        if ($carmodel === null) {
            return response()->json(['error' => 'CarModel with id = ' . $id . ' not found.'], 404);
        }
        CarModel::destroy($id);
        return response()->json([], 200);
    }
}
