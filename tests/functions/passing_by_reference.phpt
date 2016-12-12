--TEST--
PHP Spec test generated from ./functions/passing_by_reference.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

// A useful pass-by-reference example; swap the values of two variables

function swap(&$p1, &$p2)
{
   $temp = $p1;
   $p1 = $p2;
   $p2 = $temp;
}

$a1 = 1.23e27;
$a2 = [10,TRUE,NULL];
var_dump($a1);
var_dump($a2);
swap($a1, $a2);
var_dump($a1);
var_dump($a2);

///*
// a simple example of passing by reference

function f(&$p)
{
   echo '$p '.(isset($p) ? "is set\n" : "is not set\n");
	echo "f In:  \$p: $p\n";
	$p = 200;		// actual argument's value changed
	echo "f Out: \$p: $p\n";
}

// pass a variable by reference; f changes its value

$a = 10;
var_dump($a);
f($a);   // change $a from 10 to 200
var_dump($a);
// f(&$a);  // PHP5 32/62, Fatal error: Call-time pass-by-reference has been removed
         // HHVM accepts the & as being redundant
         // The php.net on-line help states: "As of PHP 5.3.0, you will get a warning
         // saying that "call-time pass-by-reference" is deprecated when you use & in
         // foo(&$a);. And as of PHP 5.4.0, call-time pass-by-reference was removed,
         // so using it will raise a fatal error."
var_dump($a);

// f();  // PHP7.1, Fatal error: Uncaught ArgumentCountError: Too few arguments 
         // to function f(), 0 passed
//*/

///*
// passing by reference with a default argument value

function g(&$p = "red")
{
   echo '$p '.(isset($p) ? "is set\n" : "is not set\n");
   echo "g In:  \$p: $p\n";
   $p = 200;      // actual argument's value changed
   echo "g Out: \$p: $p\n";
}

// pass a variable by reference; f changes its value

g();      // Unlike the f() call above, here the default parameter is used

$a = 10;
var_dump($a);
g($a);
var_dump($a);
//*/
--EXPECTF--
float(1.23E+27)
array(3) {
  [0]=>
  int(10)
  [1]=>
  bool(true)
  [2]=>
  NULL
}
array(3) {
  [0]=>
  int(10)
  [1]=>
  bool(true)
  [2]=>
  NULL
}
float(1.23E+27)
int(10)
$p is set
f In:  $p: 10
f Out: $p: 200
int(200)
int(200)
$p is set
g In:  $p: red
g Out: $p: 200
int(10)
$p is set
g In:  $p: 10
g Out: $p: 200
int(200)
