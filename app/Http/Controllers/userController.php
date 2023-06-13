<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//classes úteis
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Socialite;

//modelos
use App\Models\Usuario;

class userController extends Controller
{
    public function auth(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = Usuario::where('email', $credentials['email'])->first();

        if ($user && Hash::check($credentials['password'], $user->password)) {
            // Autenticação bem-sucedida

            Auth::login($user);

            Session::put($user->toArray());

            return response()->json(true);
        }

        return response()->json(false);
    }

    public function logout()
    {
        // Código para fazer logout
        Session::flush();

        // Redirecionar para a página de login
        return redirect()->route('home');
    }

    //carregamento do perfil
    public function load_profile()
    {
        $user = Usuario::where('id',session('id'))->get();

        return view('profile')->with(['user' => $user]);
    }

    public function store_profile(Request $form)
    {
        //executa o update no banco de dados
        $updateProfile = Usuario::where('id',session('id'))->update([

            'nome' => $form->name,

        ]);

        //atualizando a sessão
        Session::put('nome',$form->name);

        if($updateProfile = 1)
            return response()->json(['status'=>'sucess','name'=>$form->name]); 
        else 
            return response()->json(['status' => 'error']);
    }

    public function load_all_users()
    {
        return view('userlist')->with('users',Usuario::paginate(20));
    }

    public function store_neW_user(Request $form)
    {   

        //verificar se há registros no banco
        $sql = Usuario::where('email',$form->email)->exists();

        if(!$sql)
        {
            //não há registros com o mesmo email
            try {
            //cadastro do novo usuário
            $user = Usuario::create([

                'nome'      => $form->name,
                'email'     => $form->email,
                'password'  => Hash::make('123'),
                'cpf'       => $form->cpf,
                'prazo'     => $form->prazo,
                'nivel'     => $form->nivel,

            ]);

            return response()->json(['status'=>true,'msg' => 'Usuário Criado']);

        } catch (\Exception $e) {
            // Tratamento do erro caso ocorra
            // Por exemplo, você pode registrar o erro ou retornar uma resposta de erro
            return response()->json(['status'=>false,'msg' => 'Erro ao criar o usuário'.$e], 500);   
        }
        } else {

            return response()->json(['status'=>false,'msg' => 'Existe um usuário com esse e-mail. Por favor, utilize outro.']);
        }
    }

    public function edit_new_user(Request $request)
    {
        $user = Usuario::where('id',$request->id)->get();

        return view('editNewUser')->with('user',$user);
    }

    public function update_user(Request $form)
    {
        $update = Usuario::where('id',$form->id)->update([


            'nome'      => $form->name,
            'email'     => $form->email,
            'cpf'       => $form->cpf,
            'prazo'     => $form->prazo,
            'nivel'     => $form->nivel,

        ]);

        if($update == 1)
        {
            return response()->json(['status'=>true, 'msg'=>'Usuário Alterado com Sucesso!']);
        } else {
            return response()->json(['status'=>false, 'msg'=>'Erro ao Alterar Usuário!']);
        }
    }

    public function delete_new_user(Request $request)
    {
        $delete = Usuario::where('id',$request->id)->delete();

        if($delete = 1)
        {
            return redirect()->route('userlist',['action'=>true]);
        } else {
            return redirect()->route('userlist',['action'=>false]);
        }
    }
}
