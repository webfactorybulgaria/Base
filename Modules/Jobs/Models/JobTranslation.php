<?php

namespace TypiCMS\Modules\Jobs\Models;

use TypiCMS\Modules\Core\Shells\Models\BaseTranslation;

class JobTranslation extends BaseTranslation
{
    /**
     * get the parent model.
     */
    public function owner()
    {
        return $this->belongsTo('TypiCMS\Modules\Jobs\Shells\Models\Job', 'job_id')->withoutGlobalScopes();
    }
}
