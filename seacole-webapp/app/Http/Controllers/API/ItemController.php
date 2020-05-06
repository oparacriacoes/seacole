<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $nomes = [];
      $nomes_input = $request->data;
      for($n = 0; $n < count($nomes_input); $n++){
        array_push($nomes, $nomes_input[$n]);
      }
      $item = new Item;
      $item->paciente_id = $request->input('paciente_id');
      $item->nome_item = json_encode($nomes);
      try {
        $item->save();
      } catch(\Exception $exception) {
        return response()->json(['message', 'Não foi possível salvar os itens, tente novamente.']);
      }

      return response()->json(['message' => 'Itens salvos com sucesso.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return null;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $nomes = [];
      $nomes_input = $request->data;
      for($n = 0; $n < count($nomes_input); $n++){
        array_push($nomes, $nomes_input[$n]);
      }
      $item = Item::find($request->input('item_id'));
      $item->nome_item = json_encode($nomes);
      try {
        $item->save();
      } catch(\Exception $exception) {
        return response()->json(['message', 'Não foi possível atualizar os itens, tente novamente.']);
      }

      return response()->json(['message' => 'Itens atualizados com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      return null;
    }
}
