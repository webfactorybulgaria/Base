<?php

namespace TypiCMS\Modules\Candidates\Repositories;

use Illuminate\Database\Eloquent\Model;
use TypiCMS\Modules\Core\Shells\Repositories\RepositoriesAbstract;

class EloquentCandidate extends RepositoriesAbstract implements CandidateInterface
{
    public function __construct(Model $model)
    {
        $this->model = $model;
    }
}
