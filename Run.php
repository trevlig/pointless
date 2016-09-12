<?php
namespace Run;

// set_value
function set_value($return, $value)
{
    $return['value']=$value;
    return $return;
}

// get_value
function get_value($return)
{
    return $return['value'];
}

// run
function run($expr, $return = [])
{
    switch ($expr['type']) {
        case 'function':
            return $expr['expr']($return);
        default:
            return $expr['expr'];
    }
}


// is_failure
function is_failure($expr)
{
    return false;
}
