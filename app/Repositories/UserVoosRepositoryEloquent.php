<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserVoosRepository;
use App\Entities\UserVoos;
use App\Validators\UserVoosValidator;

/**
 * Class UserVoosRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class UserVoosRepositoryEloquent extends BaseRepository implements UserVoosRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserVoos::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
