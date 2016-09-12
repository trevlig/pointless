<?php
namespace Test;

require_once('Build.php');
require_once('Run.php');

use function \Build\init;
use function \Build\pointless;
use function \Build\last;
use function \Build\dump;

use function \Run\run;

$expr = pointless(
    init('this is a test')
);

$value = run($expr, [
    'value' => '#@!'
]);

var_dump($value);
