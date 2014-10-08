--TEST--
PHP Spec test generated from ./expressions/source_file_inclusion/return_none.php
--FILE--
<?php

/*
   +-------------------------------------------------------------+
   | Copyright (c) 2014 Facebook, Inc. (http://www.facebook.com) |
   +-------------------------------------------------------------+
*/

error_reporting(-1);

// no return statement, so when included, int(1) is returned
--EXPECT--
