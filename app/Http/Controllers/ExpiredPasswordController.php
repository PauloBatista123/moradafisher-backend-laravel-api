<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Requests\PasswordExpireRequest;
use App\Mail\ExpiredPasswordSend;
use Illuminate\Support\Facades\Mail;

class ExpiredPasswordController extends Controller
{
    public function postExpired(PasswordExpireRequest $request)
    {
        Mail::to(Auth()->user()->email)->send(new ExpiredPasswordSend(Auth()->user()));

        $request->user()->update([
            'password' => bcrypt($request->password),
            'expire_in' => Carbon::now()->toDateTimeString()
        ]);

        return redirect()->back()->with(['status' => 'Senha alterada com sucesso!!! Clique aqui para continuar...']);
    }

    public function expired()
    {
        return view('admin.usuarios.expire');
    }

}
