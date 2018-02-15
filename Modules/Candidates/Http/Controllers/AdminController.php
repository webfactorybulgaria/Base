<?php

namespace TypiCMS\Modules\Candidates\Http\Controllers;

use TypiCMS\Modules\Core\Shells\Http\Controllers\BaseAdminController;
use TypiCMS\Modules\Candidates\Shells\Http\Requests\FormRequest;
use TypiCMS\Modules\Candidates\Shells\Models\Candidate;
use TypiCMS\Modules\Candidates\Shells\Repositories\CandidateInterface;

class AdminController extends BaseAdminController
{
    public function __construct(CandidateInterface $candidate)
    {
        parent::__construct($candidate);
    }

    /**
     * List models.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('candidates::admin.index');
    }

    /**
     * Create form for a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = $this->repository->getModel();

        return view('candidates::admin.create')
            ->with(compact('model'));
    }

    /**
     * Edit form for the specified resource.
     *
     * @param \TypiCMS\Modules\Candidates\Shells\Models\Candidate $candidate
     *
     * @return \Illuminate\View\View
     */
    public function edit(Candidate $candidate)
    {
        return view('candidates::admin.edit')
            ->with(['model' => $candidate]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \TypiCMS\Modules\Candidates\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $candidate = $this->repository->create($request->all());

        return $this->redirect($request, $candidate);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \TypiCMS\Modules\Candidates\Shells\Models\Candidate            $candidate
     * @param \TypiCMS\Modules\Candidates\Shells\Http\Requests\FormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Candidate $candidate, FormRequest $request)
    {
        $this->repository->update($request->all());

        return $this->redirect($request, $candidate);
    }
}
