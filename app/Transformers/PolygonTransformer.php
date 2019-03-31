<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Polygon;

/**
 * Class PolygonTransformer.
 *
 * @package namespace App\Transformers;
 */
class PolygonTransformer extends TransformerAbstract
{
    /**
     * Transform the Polygon entity.
     *
     * @param \App\Entities\Polygon $model
     *
     * @return array
     */
    public function transform(Polygon $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
