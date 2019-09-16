<?php

namespace bashirsh\laravel_easy_controller;

class Helpers {

    public static function flash($message, $type = 'success')
    {
        \Session::flash('message', $message);
        \Session::flash('alert-type', $type);
    }

    public static function apply_filter($query, $filter_fields)
    {
        foreach ($filter_fields as $filter) {
            $default = [
                'cond' => '=',
                'field' => $filter['name']
            ];

            $filter += $default;

            $value = isset($filter['value']) ? $filter['value'] : request($filter['name']);
            $filter['cond'] = strtolower($filter['cond']);

            if ($value) {
                if (isset($filter['relation'])) {
                    $query->whereHas($filter['relation']['name'], function ($q) use ($filter, $value) {
                        self::where($q, $filter['field'], $filter['cond'], $value);
                    });
                } else {
                    self::where($query, $filter['field'], $filter['cond'], $value);
                }

            }
        }

        return $query;
    }

    public static function where($query, $field, $cond, $value){
        if($cond === 'in') {
            if(! is_array($value)){
                $value = [$value];
            }

            $query->whereIn($field, $value);
        } else {
            if ($cond == 'like')
                $value = "%$value%";
            elseif ($cond == 'liker')
                $value = "$value%";
            elseif ($cond == 'likel')
                $value = "%$value";

            if (in_array($cond, ['liker', 'likel']))
                $cond = 'like';

            $query->where($field, $cond, $value);
        }
    }
}
