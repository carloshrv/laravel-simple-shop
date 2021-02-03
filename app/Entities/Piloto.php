<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Piloto.
 *
 * @package namespace App\Entities;
 */
class Piloto extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "nome_piloto",
        "data_validade_registro",
    ];

    public function Voos(){
        return $this->hasMany(Voo::class, 'id_piloto');
    }


}
