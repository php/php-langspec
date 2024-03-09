--TEST--
PHP Spec test generated from ./expressions/equality_operators/comparisons.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

///*
// checkout the type of the result

$a = 10 == 20;
var_dump($a);
$a = 10 != 20;
var_dump($a);
$a = 10 <> "xxx";
var_dump($a);
$a = "zz" === "xx";
var_dump($a);
$a = "zz" !== "zz";
var_dump($a);
echo "\n";
//*/

///*
// NULL operand with all kinds of operands

$oper1 = array(NULL);
$oper2 = array(0, 100, -3.4, TRUE, FALSE, NULL, "", "123", "abc", [], [10,2.3]);

foreach ($oper1 as $e1)
{
	foreach ($oper2 as $e2)
	{
		echo "{$e1} ==   {$e2}  result: "; var_dump($e1 == $e2);
		echo "{$e1} !=   {$e2}  result: "; var_dump($e1 != $e2);
		echo "{$e1} <>   {$e2}  result: "; var_dump($e1 <> $e2);
		echo "{$e1} ===  {$e2}  result: "; var_dump($e1 === $e2);
		echo "{$e1} !==  {$e2}  result: "; var_dump($e1 !== $e2);
		echo "=======\n";
	}
	echo "-------------------------------------\n";
}
echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++\n\n";
//*/

///*
// Two non-numeric strings

$oper1 = array("", "a", "aa");
$oper2 = array("", "aa", "A", "AB");

foreach ($oper1 as $e1)
{
	foreach ($oper2 as $e2)
	{
		echo "{$e1} ==   {$e2}  result: "; var_dump($e1 == $e2);
		echo "{$e1} !=   {$e2}  result: "; var_dump($e1 != $e2);
		echo "{$e1} <>   {$e2}  result: "; var_dump($e1 <> $e2);
		echo "{$e1} ===  {$e2}  result: "; var_dump($e1 === $e2);
		echo "{$e1} !==  {$e2}  result: "; var_dump($e1 !== $e2);
		echo "=======\n";
	}
	echo "-------------------------------------\n";
}
echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++\n\n";
//*/

///*
// Boolean operand with all kinds of operands

$oper1 = array(TRUE, FALSE);
$oper2 = array(0, 100, -3.4, TRUE, FALSE, NULL, "", "123", "abc", [], [10,2.3]);

foreach ($oper1 as $e1)
{
	foreach ($oper2 as $e2)
	{
		echo "{$e1} ==   {$e2}  result: "; var_dump($e1 == $e2);
		echo "{$e1} !=   {$e2}  result: "; var_dump($e1 != $e2);
		echo "{$e1} <>   {$e2}  result: "; var_dump($e1 <> $e2);
		echo "{$e1} ===  {$e2}  result: "; var_dump($e1 === $e2);
		echo "{$e1} !==  {$e2}  result: "; var_dump($e1 !== $e2);
		echo "=======\n";
	}
	echo "-------------------------------------\n";
}
echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++\n\n";
//*/

///*
// Numeric strings with all kinds of operands

$oper1 = array("10", "-5.1");
$oper2 = array(0, 10, -3.4, TRUE, FALSE, NULL, "", "123", "abc", [], [10,2.3]);

foreach ($oper1 as $e1)
{
	foreach ($oper2 as $e2)
	{
		echo "{$e1} ==   {$e2}  result: "; var_dump($e1 == $e2);
		echo "{$e1} !=   {$e2}  result: "; var_dump($e1 != $e2);
		echo "{$e1} <>   {$e2}  result: "; var_dump($e1 <> $e2);
		echo "{$e1} ===  {$e2}  result: "; var_dump($e1 === $e2);
		echo "{$e1} !==  {$e2}  result: "; var_dump($e1 !== $e2);
		echo "=======\n";
	}
	echo "-------------------------------------\n";
}
echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++\n\n";
//*/

///*
// Two array types

$oper1 = array([10,20], ["red"=>0,"green"=>0]);
$oper2 = array([10,20.0], [10,20,30], ["red"=>0,"green"=>0], ["green"=>0,"red"=>0]);

foreach ($oper1 as $e1)
{
	foreach ($oper2 as $e2)
	{
		echo "{$e1} ==   {$e2}  result: "; var_dump($e1 == $e2);
		echo "{$e1} !=   {$e2}  result: "; var_dump($e1 != $e2);
		echo "{$e1} <>   {$e2}  result: "; var_dump($e1 <> $e2);
		echo "{$e1} ===  {$e2}  result: "; var_dump($e1 === $e2);
		echo "{$e1} !==  {$e2}  result: "; var_dump($e1 !== $e2);
		echo "=======\n";
	}
	echo "-------------------------------------\n";
}
echo "+++++++++++++++++++++++++++++++++++++++++++++++++++++\n\n";
//*/
--EXPECTF--
bool(false)
bool(true)
bool(true)
bool(false)
bool(false)

 ==   0  result: bool(true)
 !=   0  result: bool(false)
 <>   0  result: bool(false)
 ===  0  result: bool(false)
 !==  0  result: bool(true)
=======
 ==   100  result: bool(false)
 !=   100  result: bool(true)
 <>   100  result: bool(true)
 ===  100  result: bool(false)
 !==  100  result: bool(true)
=======
 ==   -3.4  result: bool(false)
 !=   -3.4  result: bool(true)
 <>   -3.4  result: bool(true)
 ===  -3.4  result: bool(false)
 !==  -3.4  result: bool(true)
=======
 ==   1  result: bool(false)
 !=   1  result: bool(true)
 <>   1  result: bool(true)
 ===  1  result: bool(false)
 !==  1  result: bool(true)
=======
 ==     result: bool(true)
 !=     result: bool(false)
 <>     result: bool(false)
 ===    result: bool(false)
 !==    result: bool(true)
=======
 ==     result: bool(true)
 !=     result: bool(false)
 <>     result: bool(false)
 ===    result: bool(true)
 !==    result: bool(false)
=======
 ==     result: bool(true)
 !=     result: bool(false)
 <>     result: bool(false)
 ===    result: bool(false)
 !==    result: bool(true)
=======
 ==   123  result: bool(false)
 !=   123  result: bool(true)
 <>   123  result: bool(true)
 ===  123  result: bool(false)
 !==  123  result: bool(true)
=======
 ==   abc  result: bool(false)
 !=   abc  result: bool(true)
 <>   abc  result: bool(true)
 ===  abc  result: bool(false)
 !==  abc  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d
 ==   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
 !=   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
 <>   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
 ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
 !==  Array  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d
 ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
 !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
 <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
 ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
 !==  Array  result: bool(true)
=======
-------------------------------------
+++++++++++++++++++++++++++++++++++++++++++++++++++++

 ==     result: bool(true)
 !=     result: bool(false)
 <>     result: bool(false)
 ===    result: bool(true)
 !==    result: bool(false)
=======
 ==   aa  result: bool(false)
 !=   aa  result: bool(true)
 <>   aa  result: bool(true)
 ===  aa  result: bool(false)
 !==  aa  result: bool(true)
=======
 ==   A  result: bool(false)
 !=   A  result: bool(true)
 <>   A  result: bool(true)
 ===  A  result: bool(false)
 !==  A  result: bool(true)
=======
 ==   AB  result: bool(false)
 !=   AB  result: bool(true)
 <>   AB  result: bool(true)
 ===  AB  result: bool(false)
 !==  AB  result: bool(true)
=======
-------------------------------------
a ==     result: bool(false)
a !=     result: bool(true)
a <>     result: bool(true)
a ===    result: bool(false)
a !==    result: bool(true)
=======
a ==   aa  result: bool(false)
a !=   aa  result: bool(true)
a <>   aa  result: bool(true)
a ===  aa  result: bool(false)
a !==  aa  result: bool(true)
=======
a ==   A  result: bool(false)
a !=   A  result: bool(true)
a <>   A  result: bool(true)
a ===  A  result: bool(false)
a !==  A  result: bool(true)
=======
a ==   AB  result: bool(false)
a !=   AB  result: bool(true)
a <>   AB  result: bool(true)
a ===  AB  result: bool(false)
a !==  AB  result: bool(true)
=======
-------------------------------------
aa ==     result: bool(false)
aa !=     result: bool(true)
aa <>     result: bool(true)
aa ===    result: bool(false)
aa !==    result: bool(true)
=======
aa ==   aa  result: bool(true)
aa !=   aa  result: bool(false)
aa <>   aa  result: bool(false)
aa ===  aa  result: bool(true)
aa !==  aa  result: bool(false)
=======
aa ==   A  result: bool(false)
aa !=   A  result: bool(true)
aa <>   A  result: bool(true)
aa ===  A  result: bool(false)
aa !==  A  result: bool(true)
=======
aa ==   AB  result: bool(false)
aa !=   AB  result: bool(true)
aa <>   AB  result: bool(true)
aa ===  AB  result: bool(false)
aa !==  AB  result: bool(true)
=======
-------------------------------------
+++++++++++++++++++++++++++++++++++++++++++++++++++++

1 ==   0  result: bool(false)
1 !=   0  result: bool(true)
1 <>   0  result: bool(true)
1 ===  0  result: bool(false)
1 !==  0  result: bool(true)
=======
1 ==   100  result: bool(true)
1 !=   100  result: bool(false)
1 <>   100  result: bool(false)
1 ===  100  result: bool(false)
1 !==  100  result: bool(true)
=======
1 ==   -3.4  result: bool(true)
1 !=   -3.4  result: bool(false)
1 <>   -3.4  result: bool(false)
1 ===  -3.4  result: bool(false)
1 !==  -3.4  result: bool(true)
=======
1 ==   1  result: bool(true)
1 !=   1  result: bool(false)
1 <>   1  result: bool(false)
1 ===  1  result: bool(true)
1 !==  1  result: bool(false)
=======
1 ==     result: bool(false)
1 !=     result: bool(true)
1 <>     result: bool(true)
1 ===    result: bool(false)
1 !==    result: bool(true)
=======
1 ==     result: bool(false)
1 !=     result: bool(true)
1 <>     result: bool(true)
1 ===    result: bool(false)
1 !==    result: bool(true)
=======
1 ==     result: bool(false)
1 !=     result: bool(true)
1 <>     result: bool(true)
1 ===    result: bool(false)
1 !==    result: bool(true)
=======
1 ==   123  result: bool(true)
1 !=   123  result: bool(false)
1 <>   123  result: bool(false)
1 ===  123  result: bool(false)
1 !==  123  result: bool(true)
=======
1 ==   abc  result: bool(true)
1 !=   abc  result: bool(false)
1 <>   abc  result: bool(false)
1 ===  abc  result: bool(false)
1 !==  abc  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d
1 ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
1 !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
1 <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
1 ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
1 !==  Array  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d
1 ==   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
1 !=   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
1 <>   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
1 ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
1 !==  Array  result: bool(true)
=======
-------------------------------------
 ==   0  result: bool(true)
 !=   0  result: bool(false)
 <>   0  result: bool(false)
 ===  0  result: bool(false)
 !==  0  result: bool(true)
=======
 ==   100  result: bool(false)
 !=   100  result: bool(true)
 <>   100  result: bool(true)
 ===  100  result: bool(false)
 !==  100  result: bool(true)
=======
 ==   -3.4  result: bool(false)
 !=   -3.4  result: bool(true)
 <>   -3.4  result: bool(true)
 ===  -3.4  result: bool(false)
 !==  -3.4  result: bool(true)
=======
 ==   1  result: bool(false)
 !=   1  result: bool(true)
 <>   1  result: bool(true)
 ===  1  result: bool(false)
 !==  1  result: bool(true)
=======
 ==     result: bool(true)
 !=     result: bool(false)
 <>     result: bool(false)
 ===    result: bool(true)
 !==    result: bool(false)
=======
 ==     result: bool(true)
 !=     result: bool(false)
 <>     result: bool(false)
 ===    result: bool(false)
 !==    result: bool(true)
=======
 ==     result: bool(true)
 !=     result: bool(false)
 <>     result: bool(false)
 ===    result: bool(false)
 !==    result: bool(true)
=======
 ==   123  result: bool(false)
 !=   123  result: bool(true)
 <>   123  result: bool(true)
 ===  123  result: bool(false)
 !==  123  result: bool(true)
=======
 ==   abc  result: bool(false)
 !=   abc  result: bool(true)
 <>   abc  result: bool(true)
 ===  abc  result: bool(false)
 !==  abc  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d
 ==   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
 !=   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
 <>   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
 ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
 !==  Array  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d
 ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
 !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
 <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
 ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
 !==  Array  result: bool(true)
=======
-------------------------------------
+++++++++++++++++++++++++++++++++++++++++++++++++++++

10 ==   0  result: bool(false)
10 !=   0  result: bool(true)
10 <>   0  result: bool(true)
10 ===  0  result: bool(false)
10 !==  0  result: bool(true)
=======
10 ==   10  result: bool(true)
10 !=   10  result: bool(false)
10 <>   10  result: bool(false)
10 ===  10  result: bool(false)
10 !==  10  result: bool(true)
=======
10 ==   -3.4  result: bool(false)
10 !=   -3.4  result: bool(true)
10 <>   -3.4  result: bool(true)
10 ===  -3.4  result: bool(false)
10 !==  -3.4  result: bool(true)
=======
10 ==   1  result: bool(true)
10 !=   1  result: bool(false)
10 <>   1  result: bool(false)
10 ===  1  result: bool(false)
10 !==  1  result: bool(true)
=======
10 ==     result: bool(false)
10 !=     result: bool(true)
10 <>     result: bool(true)
10 ===    result: bool(false)
10 !==    result: bool(true)
=======
10 ==     result: bool(false)
10 !=     result: bool(true)
10 <>     result: bool(true)
10 ===    result: bool(false)
10 !==    result: bool(true)
=======
10 ==     result: bool(false)
10 !=     result: bool(true)
10 <>     result: bool(true)
10 ===    result: bool(false)
10 !==    result: bool(true)
=======
10 ==   123  result: bool(false)
10 !=   123  result: bool(true)
10 <>   123  result: bool(true)
10 ===  123  result: bool(false)
10 !==  123  result: bool(true)
=======
10 ==   abc  result: bool(false)
10 !=   abc  result: bool(true)
10 <>   abc  result: bool(true)
10 ===  abc  result: bool(false)
10 !==  abc  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d
10 ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
10 !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
10 <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
10 ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
10 !==  Array  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d
10 ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
10 !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
10 <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
10 ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
10 !==  Array  result: bool(true)
=======
-------------------------------------
-5.1 ==   0  result: bool(false)
-5.1 !=   0  result: bool(true)
-5.1 <>   0  result: bool(true)
-5.1 ===  0  result: bool(false)
-5.1 !==  0  result: bool(true)
=======
-5.1 ==   10  result: bool(false)
-5.1 !=   10  result: bool(true)
-5.1 <>   10  result: bool(true)
-5.1 ===  10  result: bool(false)
-5.1 !==  10  result: bool(true)
=======
-5.1 ==   -3.4  result: bool(false)
-5.1 !=   -3.4  result: bool(true)
-5.1 <>   -3.4  result: bool(true)
-5.1 ===  -3.4  result: bool(false)
-5.1 !==  -3.4  result: bool(true)
=======
-5.1 ==   1  result: bool(true)
-5.1 !=   1  result: bool(false)
-5.1 <>   1  result: bool(false)
-5.1 ===  1  result: bool(false)
-5.1 !==  1  result: bool(true)
=======
-5.1 ==     result: bool(false)
-5.1 !=     result: bool(true)
-5.1 <>     result: bool(true)
-5.1 ===    result: bool(false)
-5.1 !==    result: bool(true)
=======
-5.1 ==     result: bool(false)
-5.1 !=     result: bool(true)
-5.1 <>     result: bool(true)
-5.1 ===    result: bool(false)
-5.1 !==    result: bool(true)
=======
-5.1 ==     result: bool(false)
-5.1 !=     result: bool(true)
-5.1 <>     result: bool(true)
-5.1 ===    result: bool(false)
-5.1 !==    result: bool(true)
=======
-5.1 ==   123  result: bool(false)
-5.1 !=   123  result: bool(true)
-5.1 <>   123  result: bool(true)
-5.1 ===  123  result: bool(false)
-5.1 !==  123  result: bool(true)
=======
-5.1 ==   abc  result: bool(false)
-5.1 !=   abc  result: bool(true)
-5.1 <>   abc  result: bool(true)
-5.1 ===  abc  result: bool(false)
-5.1 !==  abc  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d
-5.1 ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
-5.1 !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
-5.1 <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
-5.1 ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
-5.1 !==  Array  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d
-5.1 ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
-5.1 !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
-5.1 <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d
-5.1 ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d
-5.1 !==  Array  result: bool(true)
=======
-------------------------------------
+++++++++++++++++++++++++++++++++++++++++++++++++++++


Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ==   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !=   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array <>   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !==  Array  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !==  Array  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !==  Array  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !==  Array  result: bool(true)
=======
-------------------------------------

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !==  Array  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ==   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !=   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array <>   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !==  Array  result: bool(true)
=======

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ==   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !=   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array <>   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ===  Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !==  Array  result: bool(false)
=======

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ==   Array  result: bool(true)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !=   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array <>   Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array ===  Array  result: bool(false)

Notice: Array to string conversion in %s on line %d

Notice: Array to string conversion in %s on line %d
Array !==  Array  result: bool(true)
=======
-------------------------------------
+++++++++++++++++++++++++++++++++++++++++++++++++++++
