<?php

namespace TypiCMS\Modules\Candidates\Http\Controllers;

use TypiCMS\Modules\Core\Shells\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Candidates\Shells\Repositories\CandidateInterface;

class PublicController extends BasePublicController
{
    public function __construct(CandidateInterface $candidate)
    {
        parent::__construct($candidate, 'candidates');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('candidates::public.index')
            ->with(compact('models'));
    }

    /**
     * Show news.
     *
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $model = $this->repository->bySlug($slug);

        return view('candidates::public.show')
            ->with(compact('model'));
    }
}
