<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Papel;
use App\Models\Permissao;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'password', 'status', 'expire_in'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function create($fields)
    {
        return parent::create([
            'name' => $fields['name'],
            'email' => $fields['email'] ,
            'password' => Hash::make($fields['password']),
        ]);
    }

    public function papeis(){

        return $this->belongsToMany(Papel::class);
    }

    public function permissoes(){

        return $this->belongsToMany(Permissao::class);
    }

    public function adicionaPapel($papel){

        if (is_string($papel)) {
            return $this->papeis()->save(
                Papel::where('nome', '=', $papel)->firstOrFail()

            );
        }
        return $this->papeis()->save(
            Papel::where('nome', '=', $papel->nome)->firstOrFail()

        );
    }

    public function removePapel($papel){
        if (is_string($papel)) {
            return $this->papeis()->detach(
                Papel::where('nome', '=', $papel)->firstOrFail()

            );
        }
        return $this->papeis()->detach(
            Papel::where('nome', '=', $papel->nome)->firstOrFail()

        );
    }

    public function existePapel($papel){

        if (is_string($papel)) {
            return $this->papeis->contains('nome', $papel);
        }

        return $papel->intersect($this->papeis)->count();

    }

    public static function existePermissao($permissao, $papel){

        if (DB::table('papel_permissao')->where('permissao_id', $permissao)->where('papel_id', $papel)->count()) {

            return true;

        }else{
            return false;
        }

    }

    public function existeAdmin(){

        return $this->existePapel('admin');

    }

}
