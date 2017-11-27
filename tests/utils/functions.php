<?php

function create()
{
    $arguments = func_get_args();

    if (isset($arguments[1]) && is_string($arguments[1])
        && !isset($arguments[2])) {
        return factory($arguments[0])
            ->states($arguments[1])
            ->create();
    } elseif (isset($arguments[1]) && is_string($arguments[1])
        && isset($arguments[2]) && is_array($arguments[2])) {
        return factory($arguments[0])
            ->states($arguments[1])
            ->times($arguments[3] ?? null)
            ->create($arguments[2]);
    } elseif (isset($arguments[1]) && is_string($arguments[1])
        && isset($arguments[2]) && is_numeric($arguments[2])) {
        return factory($arguments[0])
            ->states($arguments[1])
            ->times($arguments[2])
            ->create();
    } elseif (isset($arguments[1]) && is_array($arguments[1])) {
        return factory($arguments[0])
            ->times($arguments[2] ?? null)
            ->create($arguments[1]);
    } elseif (isset($arguments[1]) && is_numeric($arguments[1])) {
        return factory($arguments[0])
            ->times($arguments[1] ?? null)
            ->create();
    } else {
        return factory($arguments[0])->create();
    }
}

function make()
{
    $arguments = func_get_args();
    if (isset($arguments[1]) && is_string($arguments[1])
        && isset($arguments[2]) && is_array($arguments[2])) {
        return factory($arguments[0])
            ->states($arguments[1])
            ->times($arguments[3] ?? null)
            ->make($arguments[2]);
    } elseif (isset($arguments[1]) && is_string($arguments[1])
        && !isset($arguments[2])) {
        return factory($arguments[0])
            ->states($arguments[1])
            ->make();
    } elseif (isset($arguments[1]) && is_string($arguments[1])
        && isset($arguments[2]) && is_numeric($arguments[2])) {
        return factory($arguments[0])
            ->states($arguments[1])
            ->times($arguments[2])
            ->make();
    } elseif (isset($arguments[1]) && is_array($arguments[1])) {
        return factory($arguments[0])
            ->times($arguments[2] ?? null)
            ->make($arguments[1]);
    } elseif (isset($arguments[1]) && is_numeric($arguments[1])) {
        return factory($arguments[0])
            ->times($arguments[1] ?? null)
            ->make();
    } else {
        return factory($arguments[0])->make();
    }
}

function raw()
{
    $arguments = func_get_args();
    if (isset($arguments[1]) && is_string($arguments[1])
        && isset($arguments[2]) && is_array($arguments[2])) {
        return factory($arguments[0])
            ->states($arguments[1])
            ->times($arguments[3] ?? null)
            ->raw($arguments[2]);
    } elseif (isset($arguments[1]) && is_string($arguments[1])
        && !isset($arguments[2])) {
        return factory($arguments[0])
            ->states($arguments[1])
            ->raw();
    } elseif (isset($arguments[1]) && is_string($arguments[1])
        && isset($arguments[2]) && is_numeric($arguments[2])) {
        return factory($arguments[0])
            ->states($arguments[1])
            ->times($arguments[2])
            ->raw();
    } elseif (isset($arguments[1]) && is_array($arguments[1])) {
        return factory($arguments[0])
            ->times($arguments[2] ?? null)
            ->raw($arguments[1]);
    } elseif (isset($arguments[1]) && is_numeric($arguments[1])) {
        return factory($arguments[0])
            ->times($arguments[1] ?? null)
            ->raw();
    } else {
        return factory($arguments[0])->raw();
    }
}