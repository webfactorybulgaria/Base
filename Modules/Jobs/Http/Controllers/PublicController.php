<?php

namespace TypiCMS\Modules\Jobs\Http\Controllers;

use TypiCMS\Modules\Core\Shells\Http\Controllers\BasePublicController;
use TypiCMS\Modules\Jobs\Shells\Repositories\JobInterface;

class PublicController extends BasePublicController
{
    public function __construct(JobInterface $job)
    {
        parent::__construct($job, 'jobs');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $models = $this->repository->all();

        return view('jobs::public.index')
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

        return view('jobs::public.show')
            ->with(compact('model'));
    }
}
