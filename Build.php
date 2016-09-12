<?php
namespace Build;

// pointless
function pointless($arg = null)
{
    return [
        'name' => 'pointless',
        'type' => 'function',
        'expr' => function ($return = []) use ($arg) {
            return \Run\run($arg, $return);
        },
        'args' => [ $arg ]
    ];
}

function dump()
{
    return [
        'name' => 'dump',
        'type' => 'function',
        'expr' => function ($return = []) {
            var_dump($return);
            return $return;
        },
        'args' => []
    ];
}

// init
function init($arg = [])
{
    return [
        'name' => 'init',
        'type' => 'function',
        'expr' => function ($return = []) use ($arg) {
            return \Run\set_value($return, $arg);
        },
        'args' => [ $arg ]
    ];
}

// seq
function seq(...$args)
{
    if (count($args) < 1) {
        throw new \Exception('seq(_,?..) expects atleast 1 argument');
    }

    return [
        'name' => 'seq',
        'type' => 'function',
        'expr' => function ($return = []) use ($args) {
            foreach ($args as $expr) {
                $result = \Run\run($expr, $return);
                if (\Run\is_failure($result)) {
                    break;
                }
            }
            return $return;
        },
        'args' => $args
    ];
}

// last
function last(...$args)
{
    if (count($args) < 1) {
        throw new \Exception('last(_,?..) expects atleast 1 argument');
    }

    return [
        'name' => 'last',
        'type' => 'function',
        'expr' => function ($return = []) use ($args) {
            foreach ($args as $expr) {
                $result = \Run\run($expr, $return);
                if (\Run\is_failure($result)) {
                    break;
                }
            }
            return $result;
        },
        'args' => $args
    ];
}

// pipe
function pipe(...$args)
{
    if (count($args) < 1) {
        throw new \Exception('pipe(_,?..) expects atleast 1 argument');
    }

    return [
        'name' => 'pipe',
        'type' => 'function',
        'expr' => function ($return = []) use ($args) {
            $r = $return;
            foreach ($args as $expr) {
                $r = \Run\run($expr, $r);
                if (\Run\is_failure($r)) {
                    break;
                }
            }
            return $r;
        },
        'args' => $args
    ];
}

// map
function map($arg = [])
{
    if (!is_array($arg)) {
        throw new \Exception('map(_) expects an array as argument');
    }

    return [
        'name' => 'map',
        'type' => 'function',
        'expr' => function ($return = []) use ($arg) {
            $r = [];
            foreach ($arg as $k => $expr) {
                $r[$k] = \Run\run($expr, $return);
                if (\Run\is_failure($r[$k])) {
                    return $r[$k];
                }
            }
            return $r;
        },
        'args' => [ $map ]
    ];
}
