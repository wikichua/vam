<?php

namespace Wikichua\VAM\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use \Wikichua\VAM\Http\Traits\ModelScopes;
    use \Wikichua\VAM\Http\Traits\DynamicFillable;
    use \Wikichua\VAM\Http\Traits\UserTimezone;

    // permissions relationship
    public function permissions()
    {
        return $this->belongsToMany(config('vam.models.permission'));
    }
}
