<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use App\Models\Marca;

class MarcaController extends Controller
{
    public function create()
    {
        try {

            $types = array('cars', 'motorcycles', 'trucks');

            foreach($types as $type){
                $response = Http::withoutVerifying()->get("https://parallelum.com.br/fipe/api/v2/{$type}/brands");

                    if ($response->successful()) {
                        $data = $response->json();
        
                        foreach($data as $marca) {
                            $marcas = new Marca();
                            $marcas->code = $marca['code'];
                            $marcas->nome = $marca['name'];
                            $marcas->tipo = $type;
                            $marcas->save();
                        }
        
                    } else {
                        $error = $response->json();
                        return response()->json($error, $response->status());
                    }
            }

            return response()->json(['message' => 'Data inserted successfully'], 200);

        } catch (RequestException $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
}
?>
