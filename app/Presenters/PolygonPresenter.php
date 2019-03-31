<?php

namespace App\Presenters;

use App\Transformers\PolygonTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class PolygonPresenter.
 *
 * @package namespace App\Presenters;
 */
class PolygonPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new PolygonTransformer();
    }
}
