<?php

namespace Wikichua\VAM\Http\Traits;

trait ModelScopes
{
    public function scopeFilter($query, $search, $fields = [])
    {
        if ($search != '') {
            $query->where(function ($Q) use ($search, $fields) {
                foreach ($fields as $field) {
                    $method = camel_case('scopeFilter_' . $field);
                    $scope = camel_case('filter_' . $field);
                    if (method_exists($this, $method)) {
                        $Q->{$scope}($search);
                    }
                }
            });
        }
        return $query;
    }

    public function scopeSorting($query, $sortBy, $sortDesc)
    {
        if ($sortBy != '') {
            $query->when($sortBy, function ($q) use ($sortDesc, $sortBy) {
                return $q->orderBy($sortBy, (($sortDesc == 'true') ? 'desc' : 'asc'));
            });
        }
        return $query;
    }
}
