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
                if ($filter['cond'] == 'like')
                    $value = "%$value%";
                elseif ($filter['cond'] == 'liker')
                    $value = "$value%";
                elseif ($filter['cond'] == 'likel')
                    $value = "%$value";

                if (in_array($filter['cond'], ['liker', 'likel']))
                    $filter['cond'] = 'like';

                if (isset($filter['relation'])) {
                    $query->whereHas($filter['relation']['name'], function ($q) use ($filter, $value) {
                        $q->where($filter['field'], $filter['cond'], $value);
                    });
                } else {
                    $query->where($filter['field'], $filter['cond'], $value);
                }

            }
        }

        return $query;
    }
}
