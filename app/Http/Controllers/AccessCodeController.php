<?php

namespace App\Http\Controllers;

use App\Mail\AccessTokenSend;
use App\Models\AccessCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AccessCodeController extends Controller
{

    public function view()
    {

        if(auth()->check()){

            $this->envio_email();

            return view('admin.code');
        }else{

            return view('admin.login');
        }
    }

    public function envio_email()
    {
        if(AccessCode::where('usuario_id', auth()->user()->id)->count()){

            $access_token = AccessCode::where('usuario_id', auth()->user()->id)->first();

            return;
        }

        $token = rand() % 90000 + 10000;

        $new_token = new AccessCode();
        $new_token->token = $token;
        $new_token->token_enviado = 1;
        $new_token->expira_em = Carbon::now()->addDays(7)->endOfDay()->format('Y-m-d H:i:s');
        $new_token->usuario_id = Auth()->user()->id;
        $new_token->ip_rede = \Request::ip();

        $new_token->save();

        return Mail::to('paulo-henrique-morada@hotmail.com')->send(new AccessTokenSend(Auth()->user() ,$new_token));

    }

    public function verificar(Request $request)
    {
        if($request['token_code'] != null)
        {
            $code = (int) $request['token_code'];
            $access_token = AccessCode::where('usuario_id', auth()->user()->id)->first()->token;
            if($code === (int) $access_token)
            {

                return view('admin.index');
            }else{

                \Session::flash('mensagem', ['msg'=>'Token Inválido']);
                return redirect()->back();
            }

        }
    }
}
