<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Modelo;
use App\Models\Marca;
use Illuminate\Support\Facades\Http;

class ModeloController extends Controller
{
    public function create() {
        try {

            $types = array('cars', 'motorcycles', 'trucks');
            $marcas = Marca::all();

            foreach($types as $type){
                foreach($marcas as $marca){
                    $id = $marca->id;
                    $response = Http::withoutVerifying()->get("https://parallelum.com.br/fipe/api/v2/{$type}/brands/{$id}/models");

                        if ($response->successful()) {
                            $data = $response->json();
            
                            foreach($data as $modelo) {
                                $modelos = new Modelo();
                                $modelos->code = $modelo['code'];
                                $modelos->nome = $modelo['name'];
                                $modelos->marca_id = $id;
                                $modelos->save();
                            }
            
                        } else {
                            $error = $response->json();
                            return response()->json($error, $response->status());
                        }
                }
            }

            return response()->json(['message' => 'Data inserted successfully'], 200);

        } catch (RequestException $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
