<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PolygonRepository;
use App\Entities\Polygon;
use App\Validators\PolygonValidator;

/**
 * Class PolygonRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PolygonRepositoryEloquent extends BaseRepository implements PolygonRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Polygon::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PolygonValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
