<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//call models
use App\Models\Produto;

class productController extends Controller
{
    public function load_products_user(Request $request)
    {
        $products = Produto::where('user_id',$request->id)->get();
      
        $products =Produto::join('usuarios', 'usuarios.id', '=', 'produtos.user_id')
            ->select('produtos.*', 'usuarios.id AS usuario_id')
            ->get();

        return view('productlist')->with('products',$products);
    }



    public function store_neW_product(Request $request)
    {
        //return $request->preco;
       
        try{
            $create = Produto::create([
                
                'nome'          => $request->nome,
                'categoria'     => $request->categoria,
                'preco'         => $request->preco,
                'qtd_estoque'   => $request->quantidade,
                'prazo'         => $request->prazo,
                'user_id'       => $request->user_id,

            ]);

            
            return response()->json(['status'=>true,'msg'=>'Novo Produto Cadastrado']); 
            

        } catch(\Exception $e){

            return response()->json(['status'=>false,'msg'=>'Erro ao cadastrar novo produto'.$e->getMessage()]);
        }
    }


    public function edit_new_produtct(Request $request)
    {
        //carregar os dados do produto a ser editado

        $product = Produto::find($request->id);

        return view('editNewProduct')->with('p',$product);
    }

    public function updated_product(Request $request)
    {
        try{
        $update = Produto::where('id',$request->id)->update([


            'nome'      => $request->nome,
            'categoria'     => $request->categoria,
            'preco'       => $request->preco,
            'prazo'     => $request->prazo,
            'qtd_estoque'     => $request->quantidade,
            'user_id'   => $request->user_id

        ]);

            if($update == 1)
            {
                return response()->json(['status'=>true, 'msg'=>'Produto Alterado com Sucesso!']);
            } else {
                return response()->json(['status'=>false, 'msg'=>'Erro ao Alterar Produto!']);
            }   

        } catch(\Exception $e) {
            return response()->json(['status'=>false, 'msg'=>'Erro ao Alterar Usuário! \n'.$e->getMessage()]);
        }

        
    } 

    public function delete_new_product(Request $request)
    {
        $delete = Produto::where('id',$request->id)->delete();
    }
}
