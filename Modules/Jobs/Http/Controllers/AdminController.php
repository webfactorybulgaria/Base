<?php

namespace TypiCMS\Modules\Jobs\Http\Controllers;

use TypiCMS\Modules\Core\Shells\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Jobs\Shells\Http\Requests\FormRequest;
use TypiCMS\Modules\Jobs\Shells\Models\Job;
use TypiCMS\Modules\Jobs\Shells\Repositories\JobInterface;

class AdminController extends BaseAdminController
{
    public function __construct(JobInterface $job)
    {
        parent::__construct($job);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('jobs::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('jobs::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Jobs\Shells\Models\Job $job
     *
     * @return \Illuminate\View\View
     */
    public function edit(Job $job)
    {
        return view('jobs::admin.edit')
            ->with(['model' => $job]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Jobs\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $job = $this->repository->create($request->all());

        return $this->redirect($request, $job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Jobs\Shells\Models\Job            $job
     * @param \TypiCMS\Modules\Jobs\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Job $job, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $job);
    }
}
