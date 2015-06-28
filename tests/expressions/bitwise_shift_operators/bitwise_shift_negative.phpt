--TEST--
PHP Spec test generated from ./expressions/bitwise_shift_operators/bitwise_shift_negative.php
--FILE--
<?php

var_dump(1 >> -1);
var_dump(1 << -1);
--EXPECTF--
Fatal error: Bit shift by negative number in %s/bitwise_shift_negative.php on line %d