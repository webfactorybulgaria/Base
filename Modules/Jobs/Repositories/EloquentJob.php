<?php

namespace TypiCMS\Modules\Jobs\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Shells\Repositories\RepositoriesAbstract;

class EloquentJob extends RepositoriesAbstract implements JobInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
