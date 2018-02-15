<?php

namespace TypiCMS\Modules\Candidates\Models;

use TypiCMS\Modules\Core\Shells\Models\BaseTranslation;

class CandidateTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Candidates\Shells\Models\Candidate', 'candidate_id')->withoutGlobalScopes();
    }
}
