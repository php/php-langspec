--TEST--
PHP Spec test generated from ./functions/default_arguments.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

// default argument values; must be constants (or intrinsic function calls like array)

///*
function f1($p1 = 10, $p2 = 1.23, $p3 = TRUE, $p4 = NULL, $p5 = "abc", $p6 = [1,2,3,array()])
{
	$argList = func_get_args();
	echo "f1: # arguments passed is ".count($argList)."\n";

	foreach ($argList as $k => $e)
	{
		echo "\targ[$k] = >$e<\n";
	}
	echo "\$p1: $p1, \$p2: $p2, \$p3: $p3, \$p4: $p4, \$p5: $p5, \$p6: $p6\n";
}

f1();
f1(20);
f1(10, TRUE);
f1(NULL, 12, 1.234);
f1(FALSE, 12e2, [99,-99], "abc");
f1(9, 8, 7, 6, 5);
f1(10, 20, 30, 40, 50, 60);
f1(1, 2, 3, 4, 5, 6, 7);
//*/
///*
// 2 default followed by one non-default;

function f2($p1 = 100, $p2 = 1.23, $p3)
{
	$argList = func_get_args();
	echo "f2: # arguments passed is ".count($argList)."\n";

	foreach ($argList as $k => $e)
	{
		echo "\targ[$k] = >$e<\n";
	}
	echo "\$p1: ".($p1 == NULL ? "NULL" : $p1).
		", \$p2: ".($p2 == NULL ? "NULL" : $p2).
		", \$p3: ".($p3 == NULL ? "NULL" : $p3)."\n";
}

// if a non-default parameter is present and not all the arguments before it are provided,
// an ArgumentCountError is thrown

try {
    f2();
}
catch (ArgumentCountError $e) {
    echo $e->getMessage() . PHP_EOL;
}
try {
    f2(10);
}
catch (ArgumentCountError $e) {
    echo $e->getMessage() . PHP_EOL;
}
try {
    f2(10, 20);
}
catch (ArgumentCountError $e) {
    echo $e->getMessage() . PHP_EOL;
}
f2(10, 20, 30);
//*/
///*
// 1 default followed by one non-default followed by 1 default;

function f3($p1 = 100, $p2, $p3 = "abc")
{
	$argList = func_get_args();
	echo "f3: # arguments passed is ".count($argList)."\n";

	foreach ($argList as $k => $e)
	{
		echo "\targ[$k] = >$e<\n";
	}
	echo "\$p1: ".($p1 == NULL ? "NULL" : $p1).
		", \$p2: ".($p2 == NULL ? "NULL" : $p2).
		", \$p3: ".($p3 == NULL ? "NULL" : $p3)."\n";
}

// if a non-default parameter is present and not all the arguments before it are provided,
// an ArgumentCountError is thrown

try {
    f3();
}
catch (ArgumentCountError $e) {
    echo $e->getMessage() . PHP_EOL;
}
try {
    f3(10);
}
catch (ArgumentCountError $e) {
    echo $e->getMessage() . PHP_EOL;
}
f3(10, 20);
f3(10, 20, 30);
//*/
///*
// 1 non-default followed by two default; unusual, but permitted

function f4($p1, $p2 = 1.23, $p3 = "abc")
{
	$argList = func_get_args();
	echo "f4: # arguments passed is ".count($argList)."\n";

	foreach ($argList as $k => $e)
	{
		echo "\targ[$k] = >$e<\n";
	}
	echo "\$p1: ".($p1 == NULL ? "NULL" : $p1).
		", \$p2: ".($p2 == NULL ? "NULL" : $p2).
		", \$p3: ".($p3 == NULL ? "NULL" : $p3)."\n";
}

// if a non-default parameter is present and not all the arguments before it are provided,
// an ArgumentCountError is thrown

try {
    f4();
}
catch (ArgumentCountError $e) {
    echo $e->getMessage() . PHP_EOL;
}
f4(10);
f4(10, 20);
f4(10, 20, 30);
//*/
--EXPECTF--
f1: # arguments passed is 0

Notice: Array to string conversion %s
$p1: 10, $p2: 1.23, $p3: 1, $p4: , $p5: abc, $p6: Array
f1: # arguments passed is 1
	arg[0] = >20<

Notice: Array to string conversion %s
$p1: 20, $p2: 1.23, $p3: 1, $p4: , $p5: abc, $p6: Array
f1: # arguments passed is 2
	arg[0] = >10<
	arg[1] = >1<

Notice: Array to string conversion %s
$p1: 10, $p2: 1, $p3: 1, $p4: , $p5: abc, $p6: Array
f1: # arguments passed is 3
	arg[0] = ><
	arg[1] = >12<
	arg[2] = >1.234<

Notice: Array to string conversion %s
$p1: , $p2: 12, $p3: 1.234, $p4: , $p5: abc, $p6: Array
f1: # arguments passed is 4
	arg[0] = ><
	arg[1] = >1200<

Notice: Array to string conversion %s
	arg[2] = >Array<
	arg[3] = >abc<

Notice: Array to string conversion %s

Notice: Array to string conversion %s
$p1: , $p2: 1200, $p3: Array, $p4: abc, $p5: abc, $p6: Array
f1: # arguments passed is 5
	arg[0] = >9<
	arg[1] = >8<
	arg[2] = >7<
	arg[3] = >6<
	arg[4] = >5<

Notice: Array to string conversion %s
$p1: 9, $p2: 8, $p3: 7, $p4: 6, $p5: 5, $p6: Array
f1: # arguments passed is 6
	arg[0] = >10<
	arg[1] = >20<
	arg[2] = >30<
	arg[3] = >40<
	arg[4] = >50<
	arg[5] = >60<
$p1: 10, $p2: 20, $p3: 30, $p4: 40, $p5: 50, $p6: 60
f1: # arguments passed is 7
	arg[0] = >1<
	arg[1] = >2<
	arg[2] = >3<
	arg[3] = >4<
	arg[4] = >5<
	arg[5] = >6<
	arg[6] = >7<
$p1: 1, $p2: 2, $p3: 3, $p4: 4, $p5: 5, $p6: 6
Too few arguments to function f2(), 0 passed in %s and exactly 3 expected
Too few arguments to function f2(), 1 passed in %s and exactly 3 expected
Too few arguments to function f2(), 2 passed in %s and exactly 3 expected
f2: # arguments passed is 3
	arg[0] = >10<
	arg[1] = >20<
	arg[2] = >30<
$p1: 10, $p2: 20, $p3: 30
Too few arguments to function f3(), 0 passed in %s and at least 2 expected
Too few arguments to function f3(), 1 passed in %s and at least 2 expected
f3: # arguments passed is 2
	arg[0] = >10<
	arg[1] = >20<
$p1: 10, $p2: 20, $p3: abc
f3: # arguments passed is 3
	arg[0] = >10<
	arg[1] = >20<
	arg[2] = >30<
$p1: 10, $p2: 20, $p3: 30
Too few arguments to function f4(), 0 passed in %s and at least 1 expected
f4: # arguments passed is 1
	arg[0] = >10<
$p1: 10, $p2: 1.23, $p3: abc
f4: # arguments passed is 2
	arg[0] = >10<
	arg[1] = >20<
$p1: 10, $p2: 20, $p3: abc
f4: # arguments passed is 3
	arg[0] = >10<
	arg[1] = >20<
	arg[2] = >30<
$p1: 10, $p2: 20, $p3: 30
