<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Voo.
 *
 * @package namespace App\Entities;
 */
class Voo extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "classe_voo",
        "hora_partida",
        "hora_chegada",
        "local_partida",
        "ativo",
        "local_desembarque",
        "valor",
        "estado_destino",
        "id_piloto",
        "data_volta",
        "data_partida",
    ];


    public function Users(){
        return $this->belongsToMany(User::class, 'user_voos');
    }

    public function Piloto(){
        return $this->belongsTo(Piloto::class, 'id_piloto');
    }

    public function getFormattedAtivoAttribute(){
        $active = $this->attributes['ativo'];
        $active = $active == 1 ? 'ativo' : 'cancelado';
        
        return  $active;
    }
}
