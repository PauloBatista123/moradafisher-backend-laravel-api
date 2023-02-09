<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetConfirmPassword;
use App\Mail\ResetPasswordSend;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Bloqueio;
use App\Models\Papel;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    public function login(Request $request)
    {
        $dados = $request->all();

        if (User::where('email', '=', $dados['email'])->where('status','<>', 'A')->count()) {
            \Session::flash('mensagem', ['msg'=>'Não é possível logar. Entre em contato com o administrador'.User::where('email', '=', $dados['email'])->where('status','=', 'B')->orWhere('status','=', 'I')->count(), 'title' => 'Erro!!', 'icon' => 'info']);

            return redirect()->route('admin.login');
        }

        //verifica se existe varias tentativas de login
        if (method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            \Session::flash('mensagem', ['msg'=>'Email inválido ou senhas inválidos', 'class'=>'red white-text',  'title' => 'Erro!!', 'icon' => 'info']);
            //incrementando metodo de tentativas de login invalidas
            return redirect()->route('admin.login');
        }

        if (Auth::attempt(['email'=>$dados['email'], 'password'=>$dados['password']])) {

                return redirect()->route('lancamentos.index');
        }else{

            \Session::flash('mensagem', ['msg'=>'Email ou senha inválidos. Tente novamente', 'class'=>'red white-text',  'title' => 'Erro!!', 'icon' => 'info']);

            return redirect()->route('admin.login');
        }

    }

    public function index(){
        abort_if(!Auth()->user()->can('usuario_listar'), 403);

        return redirect()->route('lancamentos.index');
    }

    public function expire_password()
    {

        return view('admin.usuarios.expire');
    }

    //chave de autenticação
    public function username(){
        return 'email';
    }

    public function sair(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');

    }

    public function index_usuario()
    {
        abort_if(!Auth()->user()->can('usuario_listar'), 403);

        return view('admin.usuario.index');
    }


    public function atualizar(Request $request)
    {

        if (!auth()->user()->can('usuario_editar')) {
            return response()->json([
            'msg' => 'Você não tem permissão!',
            'titulo' => 'Erro!',
            'icon' => 'info',
            ]);
        }


        $usuario = User::find($request['id_usuario']);
        $dados = $request->all();

        if (isset($dados['password'])) {

            if (strlen($dados['password']) > 5) {

                $usuario->name = $dados['name'];
                $usuario->email = $dados['email'];
                $usuario->status = $dados['status'];
                $usuario->password = bcrypt($dados['password']);

                $usuario->update();

                return response()->json([
                'msg' => 'Salvo com sucesso!',
                'titulo' => 'Sucesso!',
                'icon' => 'success',
                ]);

            }else{

                return response()->json([
                'msg' => 'Digite uma senha com mais de 5 digitos',
                'titulo' => 'Atenção!',
                'icon' => 'info',
                ]);

            }

        }else{

            unset($dados['password']);
            $usuario->name = $dados['name'];
            $usuario->email = $dados['email'];
            $usuario->status = $dados['status'];

            $usuario->update();


            return response()->json([
            'msg' => 'Salvo com sucesso!',
            'titulo' => 'Sucesso!',
            'icon' => 'success',
            ]);

        }


    }

    public function papel($id)
    {

        if (!auth()->user()->can('usuario_listar')) {
           abort(401);
        }

        $usuario = User::find($id);
        $papeis = Papel::all();

        return view('admin.usuarios.papel', compact('usuario', 'papeis'));
    }

    public function salvarPapel(Request $request, $id){

        if (!auth()->user()->can('usuario_editar')) {
            abort(401);
        }

        $usuario = User::find($id);
        $dados = $request->all();
        $papel = Papel::find($dados['papel_id']);

        $usuario->adicionaPapel($papel);

        return redirect()->back();
    }
    public function removerPapel($id, $papel_id){

        if (!auth()->user()->can('usuario_editar')) {
            abort(401);
        }

        $usuario = User::find($id);
        $papel = Papel::find($papel_id);

        $usuario->removePapel($papel);

        return redirect()->back();
    }

    private function lockoutTime()
    {
        return property_exists($this, 'lockoutTime') ? $this->lockoutTime : 60;
    }

    protected function maxLoginAttempts()
    {
        return property_exists($this, 'maxLoginAttempts') ? $this->maxLoginAttempts : 5;
    }


     /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */

     //resposta de varias tentativas incorretas
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        User::where('email', '=', $request['email'])->update(['status' => 'B']);
        $bloqueio = new Bloqueio();
        $bloqueio->email = $request['email'];
        $bloqueio->ip = $request->ip();
        $bloqueio->save();

        \Session::flash('mensagem', ['msg'=>'Erro: Aguarde '.$seconds.'- ip:'.$request->ip()]);

        return redirect()->route('admin.login');

    }

    function bloqueios(){

        if (!auth()->user()->can('usuario_listar')) {

            abort(401);

        }

            $bloqueios = Bloqueio::orderBy('created_at', 'desc')->get();
            return view('admin.usuarios.bloqueio', compact('bloqueios'));
    }

     public function alterar_senha($id_enc){

         //validar chave
        try {
            $id = \Crypt::decryptString($id_enc);
        } catch (DecryptException $e) {
            \Session::flash('mensagem', ['msg'=> 'Ops! Parece que aconteceu algo errado!' , 'titulo'=>'Erro', 'icon' => 'info']);
            return redirect()->route('admin.index');
        }//validar chave

        if (Auth()->user()->id == $id) {

            $usuario = User::find($id);

            return view('admin.usuarios.perfil', compact('usuario'));

        }else{

            \Session::flash('mensagem', ['msg'=> 'Você não pode acessar essa página' , 'titulo'=>'Erro', 'icon' => 'info']);
            return redirect()->back();

        }



    }

    public function atualizar_perfil(Request $request, $id_enc){

        //validar chave
        try {
            $id = decrypt($id_enc);
        } catch (DecryptException $e) {
            \Session::flash('mensagem', ['msg'=> 'Ops! Parece que aconteceu algo errado!' , 'titulo'=>'Erro', 'icon' => 'info']);
            return redirect()->route('admin.index');
        }//validar chave

        $usuario = User::find($id);
        $dados = $request->all();
        if ($request->hasFile('file')) {
            $arquivo = $request->file('file');

                $dir = "images/usuarios/";//tira os espaços e coloca um texto entre os espaços
                $ext = $arquivo->guessClientExtension();
                $nomeArquivo = "_foto_".$usuario->id.".".$ext;

                $arquivo->move($dir, $nomeArquivo);

                if (isset($dados['password'])) {

                        if (strlen($dados['password']) > 5) {

                            $usuario->name = $dados['name'];
                            $usuario->email = $dados['email'];
                            $usuario->foto = $dir.$nomeArquivo;
                            $usuario->password = bcrypt($dados['password']);

                            $usuario->update();

                            \Session::flash('mensagem', ['msg'=>'Salvo com sucesso', 'titulo'=>'Sucesso!', 'icon'=>'success']);
                            return redirect()->back();

                        }else{


                           \Session::flash('mensagem', ['msg'=>'Digite uma senha com mais de 5 digitos', 'titulo'=>'Atenção!', 'icon'=>'info']);
                            return redirect()->back();

                        }

                    }

        }else{

            if (isset($dados['password'])) {

                if (strlen($dados['password']) > 5) {

                    $usuario->name = $dados['name'];
                    $usuario->email = $dados['email'];
                    $usuario->password = bcrypt($dados['password']);

                    $usuario->update();

                    \Session::flash('mensagem', ['msg'=>'Salvo com sucesso', 'titulo'=>'Sucesso!', 'icon'=>'success']);
                    return redirect()->back();

                }else{

                   \Session::flash('mensagem', ['msg'=>'Digite uma senha com mais de 5 digitos', 'titulo'=>'Atenção!', 'icon'=>'info']);
                    return redirect()->back();

                }

            }
        }

    }

    public function reset()
    {
        return view('admin.usuarios.reset');
    }

    public function password_reset(Request $request)
    {
        $user = User::whereEmail($request->email)->first();

        if(is_null($user)){
            return redirect()->back()->with(['error' => 'Não encontramos esse email em nosso sistema!']);
        }

        $token = \Str::random(60);

        $user = User::where('email', $request->email)->update([
            'remember_token' => $token
        ]);

        Mail::to($request->email)->send(new ResetPasswordSend($token));

        return back()->with('message', 'Enviamos um email para resetar sua senha!');
    }

    public function password_reset_view()
    {
        return view('admin.usuario.reset_confirm');
    }

    public function resetar($token)
    {
        $verify_token_exists = User::where('remember_token', $token)->first();

        if(!$verify_token_exists)
            abort(419, 'Token expirado ou inexistente');

        return view('admin.usuarios.confirm_reset', compact('token'));
    }

    public function resetar_update(ResetConfirmPassword $request, $token)
    {
        $updatePassword = User::where(['email' => $request->email, 'remember_token' => $token])->first();

        if(!$updatePassword)
            return back()->with('error', 'Dados informados inválidos! Tente novamente...');

        $user = User::where('email', $request->email)
            ->update([
                'password' => bcrypt($request->password),
                'expire_in' => Carbon::now()->toDateTimeString(),
                'remember_token' => null
            ]);

        \Session::flash('mensagem', ['msg' => 'Senha alterada com sucesso!!!', 'title' => 'Sucesso!!', 'icon' => 'success']);

        return redirect()->route('admin.login');

    }

    // public function login(Request $request){
    //     $credintials = $request->only('email', 'password');

    //     try {
    //         $token = $this->user->login($credintials);
    //     } catch (\Throwable|\Exception $e) {
    //         return ResponseService::exception('user.login', null, $e);
    //     }

    //     return response()->json(compact('token'));
    // }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(StoreUser $request){
    //     try {

    //         $user = $this->user->create([
    //             'name' => $request->get('name'),
    //             'email' => $request->get('email'),
    //             'password' => $request->get('password'),
    //         ]);

    //     } catch (\Throwable|\Exception $e) {
    //         return ResponseService::exception('users.store',null,$e);
    //     }

    //     return new UserResource($user, array('type' => 'store', 'route' => 'users.store'));
    // }
}
