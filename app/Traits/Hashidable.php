<?php

namespace App\Traits;

use Vinkla\Hashids\Facades\Hashids;

trait Hashidable
{
    public function getRouteKey()
    {
        return Hashids::connection(get_called_class())->encode($this->getKey());
    }
}
