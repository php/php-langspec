--TEST--
PHP Spec test generated from ./functions/basics.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

// Function names are not case-sensitive

//function f() { echo "f\n"; }
//function F() { echo "F\n"; }	// F is equivalent to f

// function having no declared parameters

function f1()
{
	$argList = func_get_args();
	echo "f1: # arguments passed is ".count($argList)."\n";

	foreach ($argList as $k => $e)
	{
		echo "\targ[$k] = >$e<\n";
	}
}

var_dump(f1());	// call f1, default return value is NULL
f1;				// valid, but vacuous, as it has no side effect and its value is not used
var_dump(f1);	// string with value "f1"
$f = f1;		// assign this string to a variable
$f();			// call f1 indirectly via $f
//"f1"();			// call f1 via the string "f1" -- Can't be a string literal!!!

// f1() = 123;	// a function return is not an lvalue

f1();
f1(10);
f1(TRUE, "green");
f1(23.45, NULL, array(1,2,3));

// function having 2 declared parameters

function f2($p1, $p2)
{
	// A NULL value doesn't prove the argument wasn't passed; find a better test

	echo "f2: \$p1 = ".($p1 == NULL ? "NULL" : $p1).
		", \$p2 = ".($p2 == NULL ? "NULL" : $p2)."\n";
}

// if fewer arguments are passed than there are paramaters declared, an ArgumentCountError is thrown

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
f2(10, 20);		// pass 2 (== 2)
f2(10, 20, 30);	// pass 3 (> 2)

// some simple examples of function calls

function square($v) { return $v * $v; }
echo "5 squared = ".square(5)."\n";
var_dump($funct = square);
var_dump($funct(-2.3));

echo strlen("abcedfg")."\n";
--EXPECTF--
f1: # arguments passed is 0
NULL

Warning: Use of undefined constant f1 - assumed 'f1' (this will throw an Error in a future version of PHP) in %s/functions/basics.php on line 30

Warning: Use of undefined constant f1 - assumed 'f1' (this will throw an Error in a future version of PHP) in %s/functions/basics.php on line 31
string(2) "f1"

Warning: Use of undefined constant f1 - assumed 'f1' (this will throw an Error in a future version of PHP) in %s/functions/basics.php on line 32
f1: # arguments passed is 0
f1: # arguments passed is 0
f1: # arguments passed is 1
	arg[0] = >10<
f1: # arguments passed is 2
	arg[0] = >1<
	arg[1] = >green<
f1: # arguments passed is 3
	arg[0] = >23.45<
	arg[1] = ><

Notice: Array to string conversion in %s/functions/basics.php on line 25
	arg[2] = >Array<
Too few arguments to function f2(), 0 passed in %s on line %d and exactly 2 expected
Too few arguments to function f2(), 1 passed in %s on line %d and exactly 2 expected
f2: $p1 = 10, $p2 = 20
f2: $p1 = 10, $p2 = 20
5 squared = 25

Warning: Use of undefined constant square - assumed 'square' (this will throw an Error in a future version of PHP) in %s/functions/basics.php on line 74
string(6) "square"
float(5.29)
7
