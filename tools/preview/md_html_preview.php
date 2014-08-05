#!/usr/bin/env php
<?php

if ($argc < 2) {
    exit(1);
}

require './vendor/autoload.php';
use \Michelf\MarkdownExtra;

$input = file_get_contents(realpath($argv[1]));

$header = "<html><head><title>Markdown preview</title></head><body>" . PHP_EOL;
$footer = PHP_EOL . "</body></html>" . PHP_EOL;
$body = MarkdownExtra::defaultTransform($input);

$file = tempnam(sys_get_temp_dir(), 'md_preview_');
file_put_contents($file, $header . $body . $footer);

echo $file . PHP_EOL;

$cmd = null;
$uname = `uname -a`;
if (strstr($uname, 'Darwin') !== false) {
    $cmd = "open";
} else {
    $lsb = `lsb_release -d`;
    if (strstr($lsb, 'Ubuntu') !== false || strstr($lsb, 'Debian') !== false) {
        $browser = "/etc/alternatives/x-www-browser";
        if (is_executable($browser)) {
            $cmd = $browser;
        }
    }
}
if ($cmd) {
    shell_exec(sprintf("%s %s", $cmd, $file));
}
