<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Modelo;
use App\Models\Marca;
use App\Models\Ano;
use Illuminate\Support\Facades\Http;

class AnoController extends Controller
{
    public function create() {
        try {

            $types = array('cars', 'motorcycles', 'trucks');
            $marcas = Marca::all();
            $modelos = Modelo::all();
            $url = 'https://parallelum.com.br/fipe/api/v2';


            foreach($types as $type){
                foreach($marcas as $marca){
                    foreach($modelos as $modelo){
                        $response = Http::withoutVerifying()->get("{$url}/{$type}/brands/{$marca->id}/models/$modelo->id/years");

                        if ($response->successful()) {
                            $data = $response->json();
            
                            foreach($data as $ano) {
                                $anos = new Ano();
                                $anos->code = $ano['code'];
                                $anos->nome = $ano['name'];
                                $anos->modelo_id = $modelo->id;
                                $anos->save();
                            }
            
                        } else {
                            $error = $response->json();
                            return response()->json($error, $response->status());
                        }
                    }
                }
            }

            return response()->json(['message' => 'Data inserted successfully'], 200);

        } catch (RequestException $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
