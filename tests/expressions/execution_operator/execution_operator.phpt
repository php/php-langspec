--TEST--
PHP Spec test generated from ./expressions/execution_operator/execution_operator.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

$ls = (substr(PHP_OS, 0, 3) != 'WIN') ? 'ls' : 'dir';

///*
// $result = `dir *.*`;
$result = `$ls`;
var_dump($result);
//*/

///*
// $result = `dir *.* >dirlist.txt`;
$result = `$ls >dirlist.txt`;
var_dump($result);
unlink('dirlist.txt');
//*/

///*
$d = "dir";
$f = "*.*";
// $result = `$d {$f}`;
$result = `$ls`;
var_dump($result);
//*/

///*
$result = ``;
var_dump($result);

$result = `  `;
var_dump($result);
//*/
--EXPECTF--
string(%d) "%a
"
NULL
string(%d) "%a
"
NULL
NULL
