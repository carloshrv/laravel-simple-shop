<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\pilotoRepository;
use App\Entities\Piloto;
use App\Validators\PilotoValidator;

/**
 * Class PilotoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PilotoRepositoryEloquent extends BaseRepository implements PilotoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Piloto::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
