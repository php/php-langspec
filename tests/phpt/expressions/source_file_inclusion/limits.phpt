--TEST--
PHP Spec test generated from ./expressions/source_file_inclusion/limits.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/
namespace MyInclude;

error_reporting(-1);

echo "================= xxx =================\n";

echo "Inside file >" . __FILE__ . "< at line >" . __LINE__ . 
	"< with namespace >" . __NAMESPACE__ . "<\n";

const MY_MIN = 10;
const MY_MAX = 50;

// ?>
--EXPECTF--
================= xxx =================
Inside file >%s/expressions/source_file_inclusion/limits.php< at line >14< with namespace >MyInclude<