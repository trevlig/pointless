<?php
namespace Apply;

function apply($expr, $args)
{
    switch ($expr['type']) {
        case 'function':
            return apply_fn($expr, $args);
            break;
        case 'value':
            return $expr['sexp'];
            break;
    }
}

function apply_fn($expr, $args)
{
    switch ($expr['name']) {
        case 'build':
            return apply_build($expr['sexp'], $args);
        case 'die':
            return apply_die();
        case 'dump':
            return apply_dump($args);
        case 'first':
            return apply_first($expr['sexp'], $args);
        case 'last':
            return apply_last($expr['sexp'], $args);
        case 'map':
            return apply_map($expr['sexp'], $args);
        case 'pipe':
            return apply_pipe($expr['sexp'], $args);
        case 'seq':
            return apply_seq($expr['sexp'], $args);
        case 'user_fn':
            return apply_user_fn($expr['sexp'], $args);
    }
}

function is_failure($value)
{
    return
        is_array($value) &&
        isset($value['is-failure']) &&
        $value['is-failure'] === true;
}

function apply_build($sexp, $args)
{
    return apply($sexp[0], $args);
}

function apply_die()
{
    die;
}

function apply_dump($args)
{
    var_dump($args);
    return $args;
}

function apply_first($sexp, $args)
{
    foreach ($sexp as $expr) {
        $value = apply($expr, $args);
        if (!is_failure($value)) {
            return $value;
        }
    }
    return $value;
}

function apply_last($sexp, $args)
{
    foreach ($sexp as $expr) {
        $value = apply($expr, $args);
        if (is_failure($value)) {
            break;
        }
    }
    return $value;
}

function apply_map($sexp, $args)
{
    $map = [];
    foreach ($sexp as $key => $expr) {
        $value = apply($expr, $args);
        if (is_failure($value)) {
            return $value;
        }
        $map[$key] = $value;
    }
    return $map;
}

function apply_pipe($sexp, $args)
{
    $value = $args;
    foreach ($sexp as $expr) {
        $value = apply($expr, $value);
        if (is_failure($value)) {
            break;
        }
    }
    return $value;
}

function apply_seq($sexp, $args)
{
    foreach ($sexp as $expr) {
        $value = apply($expr, $args);
        if (is_failure($value)) {
            break;
        }
    }
    return $args;
}

function apply_user_fn($name, $args)
{
    return call_user_func_array($name, $args);
}
