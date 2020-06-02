<?php

namespace Wikichua\VAM\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use \Wikichua\VAM\Http\Traits\ModelScopes;
    use \Wikichua\VAM\Http\Traits\DynamicFillable;
    use \Wikichua\VAM\Http\Traits\UserTimezone;

    const UPDATED_AT = null;

    protected $casts = [
        'data' => 'array',
    ];

    // user relationship
    public function user()
    {
        return $this->belongsTo(config('auth.providers.users.model'))->withDefault(['name' => null]);
    }

    // dynamic model
    public function model()
    {
        return $this->model_class ? app($this->model_class)->find($this->model_id) : null;
    }
}
