<?php

function slugify($title) {
  return strtolower(str_replace(array(' ', '#'), '-', $title));
}

function number_pad($number, $n) {
  return str_pad((int) $number, $n, "0", STR_PAD_LEFT);
}

function filter_toc($md_contents) {
  $tocStart = '*generated with [DocToc](http://doctoc.herokuapp.com/)*';
  $tocEnd = '<!-- END doctoc';
  $toc = substr(
    $md_contents,
    strpos($md_contents, $tocStart) + strlen($tocStart),
    strpos($md_contents, $tocEnd) - (
      strpos($md_contents, $tocStart) + strlen($tocStart)
    )
  );
  return trim($toc);
}

function parse_file_links($toc) {
  $fileLinks = array();
  $chapter = '';
  $chapterCount = 1;
  $linkCount = 0;
  foreach(preg_split("/((\r?\n)|(\r\n?))/", $toc) as $line) {
    $round = 0;
    while (!preg_match('/^\s{' . $round * 2 . '}\-/', $line)) {
      $round ++;
    }
    if ($round === 0) {
      $aux = explode(
        '](',
        str_replace(
          array('[', ')', '- ', '#'), '', trim($line)
        )
      );
      $chapter = number_pad($chapterCount, 3) .
        '-' . $aux[1] . '.md';
      $chapterCount ++;
      $generalCounter = 0;
      $fileLinks[$linkCount]['pattern'] = '[§§](#' . $aux[1] . ')';
      $fileLinks[$linkCount]['replacement'] = '[' . $aux[0] .
        '](' . $chapter . ')';
    } else {
      $aux = explode(
        '](',
        str_replace(
          array('[', ')', '- ', '#'), '', trim($line)
        )
      );
      $fileLinks[$linkCount]['pattern'] = '[§§](#' . $aux[1] . ')';
      if (preg_match('/general\-[0-9]/', $aux[1])) {
        if ($generalCounter === 0){
          $aux[1] = 'general';
        } else {
          $aux[1] = 'general-' . $generalCounter;
        }
        $generalCounter ++;
      }
      $fileLinks[$linkCount]['replacement'] = '[' . $aux[0] .
        '](' . $chapter . '#' . $aux[1] . ')';
    }
    $linkCount ++;
  }
  return $fileLinks;
}

function update_links($line, $links) {
  foreach ($links as $link) {
    if (preg_match('/' . str_replace('[§§]', '.*', preg_quote($link['pattern'], '/')) . '/', $line)) {
      $line = preg_replace(
        '/' . str_replace('[§§]', '.*', preg_quote($link['pattern'], '/')) . '/',
        $link['replacement'],
        $line
      );
    }
  }
  return $line;
}

function make_chapter($index, $chapter, $link) {
  $filename = dirname(__FILE__) . DIRECTORY_SEPARATOR . '..'
    . DIRECTORY_SEPARATOR . '..'
    . DIRECTORY_SEPARATOR . 'spec'
    . DIRECTORY_SEPARATOR . number_pad($index, 3) . $link . '.md';
  @unlink($filename);
  $f = fopen($filename, 'a');
  fwrite($f, $chapter);
}

function chapterize($md_file) {
  $md_contents = file_get_contents($md_file);
  $toc = filter_toc($md_contents);
  $links = parse_file_links($toc);
  $chapters = array();
  $chapterCount = -1;
  foreach(preg_split("/((\r?\n)|(\r\n?))/", $md_contents) as $line) {
    $pattern = '/^\#[^\#].*$/';
    if (preg_match($pattern, $line)) {
      $chapterCount ++;
      $chapters[$chapterCount]['title'] = $line;
      $chapters[$chapterCount]['link'] = slugify($line);
      $chapters[$chapterCount]['content'] = $line;
    } else {
      $chapters[$chapterCount]['content'] .= "\n" . update_links($line, $links);
    }
  }
  foreach ($chapters as $index => $chapter) {
    make_chapter($index, $chapter['content'], $chapter['link']);
  }
}

function main($argv) {
  $opts = getopt("hm:");
  if (array_key_exists("h", $opts)) {
    die("php chapterizer.php -m <input markdown file>" . PHP_EOL);
  }
  if (!array_key_exists("m", $opts)) {
    die("Specify input markdown file" . PHP_EOL);
  }
  $md_file = $opts["m"];
  chapterize($md_file);
}

main($argv);