--TEST--
PHP Spec test generated from ./expressions/source_file_inclusion/mycolors.php
--FILE--
<?php

namespace MyColors;

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

echo "Inside file >" . __FILE__ . "< at line >" . __LINE__ . 
	"< with namespace >" . __NAMESPACE__ . "<\n";

const RED = 1;
const WHITE = 2;
const BLUE = 3;
--EXPECTF--
Inside file >%s/expressions/source_file_inclusion/mycolors.php< at line >13< with namespace >MyColors<