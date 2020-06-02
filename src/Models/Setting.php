<?php

namespace Wikichua\VAM\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use \Wikichua\VAM\Http\Traits\ModelScopes;
    use \Wikichua\VAM\Http\Traits\DynamicFillable;
    use \Wikichua\VAM\Http\Traits\UserTimezone;

    protected $appends = ['isMultiple', 'rows'];

    public function getValueAttribute($value)
    {
        if (json_decode($value)) {
            return json_decode($value, 1);
        }
        return $value;
    }
    public function setValueAttribute($value)
    {
        if (is_array($value)) {
            $this->attributes['value'] = json_encode($value);
        } else {
            $this->attributes['value'] = $value;
        }
    }
    public function getIsMultipleAttribute()
    {
        if (json_decode($this->attributes['value'])) {
            return true;
        }
        return false;
    }
    public function getRowsAttribute()
    {

        if (json_decode($this->attributes['value'])) {
            $array = json_decode($this->attributes['value'], true);
            $rows = [];
            foreach ($array as $key => $value) {
                $rows[] = [
                    'index' => $key,
                    'value' => $value,
                ];
            }
            return $rows;
        }
        return [
            'index' => null,
            'value' => null,
        ];;
    }
}
