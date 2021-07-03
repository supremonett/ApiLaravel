<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Apilaravel;

class ApiController extends Controller
{

    public function index()
    {
        $dados = Apilaravel::all();
        return response($dados);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:50',
            'valor' => 'required',
            'descricao' => 'required|max:100',
        ]);
        $insert = Apilaravel::create($request->all());
        return response($request->all());
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
