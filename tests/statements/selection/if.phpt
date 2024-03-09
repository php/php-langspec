--TEST--
PHP Spec test generated from ./statements/selection/if.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

// an ordinary if having 2 actions on TRUE and none on FALSE

function processTransaction() { echo "Inside processTransaction\n"; }
function postMessage() { echo "Inside postMessage\n"; }

$count = 5;

if ($count > 0)
{
	processTransaction();
	postMessage();
}

// despite the indenting that suggests the true path has 2 statements, in the
// absence of braces, the true path is the first statement only. The second statement
// is always executed.

if (0)
	echo "Line 1\n";
	echo "Line 2\n";	// always executed

// use if with all scalar types + array

$colors = array("red", "white", "blue");
$scalarValueList = array(10, -100, 0, 1.234, 0.0, TRUE, FALSE, NULL, 'xx', "", $colors);

foreach ($scalarValueList as $e)
{
	if ($e)
	{
		echo ">$e< is TRUE\t"; var_dump($e);
	}
	else
	{
		echo ">$e< is FALSE\t"; var_dump($e);
	}
}

// use if with an instance of a class

class Name
{
	var $firstName;
	var $lastName;
}

$aName = new Name();
var_dump($aName);

if ($aName)
{
	echo ">\$aName< is TRUE\n";
}
else
{
	echo ">\$aName< is FALSE\n";
}

// see what happens if I jump into a if statement

goto label1;

echo "Unreachable code\n";

if ($colors)
{
label1:	echo "TRUE path\n";
}
else
{
	echo "FALSE path\n";
}

// show that when elses are nested, an else matches the lexically nearest preceding if that is allowed by the syntax

if (1)
	echo "Path 1\n";
	if (0)
		echo "Path 2\n";
else 	// this else does NOT go with the outer if
	echo "Path 3\n";

if (1)
{
	echo "Path 1\n";
	if (0)
		echo "Path 2\n";
}
else 	// this else does go with the outer if
	echo "Path 3\n";

// test elseif

$a = 10;
if ($a < 0)
	; // ...
elseif ($a == 0)
	; // ...
elseif ($a < 10)
	; // ...
else
	; // ...

// test alternate syntax

if ($a < 0)  : // ...
	++$a; // ...
endif  ; // ...

if ($a < 0)  : // ...
	++$a; // ...
else   /*...*/ :
	--$a; // ...
endif  ; // ...

if ($a < 0):
	; // ...
elseif ($a == 0)  :
	; // ...
elseif ($a < 10):
	; // ...
else:
	; // ...
endif;
--EXPECTF--
Inside processTransaction
Inside postMessage
Line 2
>10< is TRUE	int(10)
>-100< is TRUE	int(-100)
>0< is FALSE	int(0)
>1.234< is TRUE	float(1.234)
>0< is FALSE	float(0)
>1< is TRUE	bool(true)
>< is FALSE	bool(false)
>< is FALSE	NULL
>xx< is TRUE	string(2) "xx"
>< is FALSE	string(0) ""

Notice: Array to string conversion in %s on line %d
>Array< is TRUE	array(3) {
  [0]=>
  string(3) "red"
  [1]=>
  string(5) "white"
  [2]=>
  string(4) "blue"
}
object(Name)#1 (2) {
  ["firstName"]=>
  NULL
  ["lastName"]=>
  NULL
}
>$aName< is TRUE
TRUE path
Path 1
Path 3
Path 1
