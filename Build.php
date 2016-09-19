<?php
namespace Build;

function build(...$sexp)
{
    if (count($sexp) < 1) {
        throw new \Exception('build(_,?..) expect atleast 1 argument');
    }

    return [
        'name' => 'build',
        'type' => 'function',
        'sexp' => $sexp
    ];
}

function dump()
{
    return [
        'name' => 'dump',
        'type' => 'function',
        'sexp' => null
    ];
}

function fn($name)
{
    if (empty($name)) {
        throw new \Exception('fn(_,?..) argument can not be empty');
    }

    return [
        'name' => 'user_fn',
        'type' => 'function',
        'sexp' => $name
    ];
}

function init($value)
{
    return [
        'name' => 'init',
        'type' => 'value',
        'sexp' => $value
    ];
}

function last(...$sexp)
{
    if (count($sexp) < 1) {
        throw new \Exception('last(_,?..) expects atleast 1 argument');
    }

    return [
        'name' => 'last',
        'type' => 'function',
        'sexp' => $sexp
    ];
}

function map($sexp)
{
    if (!is_array($sexp)) {
        throw new \Exception('map(_) expects one array as argument');
    }

    return [
        'name' => 'map',
        'type' => 'function',
        'sexp' => $sexp
    ];
}

function seq(...$sexp)
{
    if (count($sexp) < 1) {
        throw new \Exception('seq(_,?..) expects atleast 1 argument');
    }

    return [
        'name' => 'seq',
        'type' => 'function',
        'sexp' => $sexp
    ];
}

function pipe(...$sexp)
{
    if (count($sexp) < 1) {
        throw new \Exception('pipe(_,?..) expects atleast 1 argument');
    }

    return [
        'name' => 'pipe',
        'type' => 'function',
        'sexp' => $sexp
    ];
}
