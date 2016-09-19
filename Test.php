<?php
namespace Test;

require_once('Build.php');
require_once('Apply.php');

use function \Build\build;
use function \Build\dump;
use function \Build\fn;
use function \Build\init;
use function \Build\last;
use function \Build\seq;

use function \Apply\apply;

$expr = build(
    seq(
        init('this is a test'),
        fn('\Test\foobar')
    )
);

$value = apply($expr, [
    'value' => '#@!'
]);

var_dump($value);

function foobar($value)
{
    echo 'VALUE IS ' . $value . "\n";
}
