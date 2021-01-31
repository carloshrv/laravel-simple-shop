<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class User.
 *
 * @package namespace App\Entities;
 */
class User extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "numero_rg",
        "nome_cliente",
        "telefone",
        "email",
        "endereco",
        "numero_cadeira",
        "qtd_bagagem",
        'password',
    ];

    public function Voos(){
        return $this->belongsToMany(Voo::class, 'user_voos');
    }

}
