<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Transformers\User\UserResource;
use App\Transformers\User\UserResourceCollection;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
     }

    public function login(Request $request){
        $credintials = $request->only('email', 'password');

        try {
            $token = $this->user->login($credintials);
        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('user.login', null, $e);
        }

        return response()->json(compact('token'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(StoreUser $request){
        try {

            $user = $this->user->create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => $request->get('password'),
            ]);

        } catch (\Throwable|\Exception $e) {
            return ResponseService::exception('users.store',null,$e);
        }

        return new UserResource($user, array('type' => 'store', 'route' => 'users.store'));
    }
}
