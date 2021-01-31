<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\vooRepository;
use App\Entities\Voo;
use App\Validators\VooValidator;

/**
 * Class VooRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VooRepositoryEloquent extends BaseRepository implements VooRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Voo::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
