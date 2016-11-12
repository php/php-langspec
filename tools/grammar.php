<?php error_reporting(E_ALL);

require __DIR__ . '/util.php';

$dir = __DIR__ . '/../spec/';
$grammarFile = $dir . '19-grammar.md';

$output = <<<'END'
#Grammar

##General

The grammar notation is described in [Grammars section](09-lexical-structure.md#grammars).

##Lexical Grammar


END;

$lexical = file_get_contents($dir . '09-lexical-structure.md');
$lexical = strstr($lexical, '##Lexical analysis');
$output .= extract_grammar($lexical);

$output .= "\n\n##Syntactic Grammar";

foreach (spec_files() as $fileName => $path) {
    if ($fileName === '05-types.md' || $fileName === '09-lexical-structure.md') {
        continue;
    }

    $code = file_get_contents($path);
    $grammar = extract_grammar($code);
    if (null === $grammar) {
        continue;
    }

    $heading = extract_heading($code);
    $output .= "\n\n###$heading\n\n" . $grammar;
}

$output .= "\n";

file_put_contents($grammarFile, $output);

function extract_heading($code) {
    if (!preg_match('/#\s*(.*)/', $code, $matches)) {
        throw new Exception('No heading found');
    }

    return $matches[1];
}

function extract_grammar($code) {
    if (!preg_match_all('(<pre>(.*?)</pre>)s', $code, $matches)) {
        return null;
    }

    $parts = [];
    foreach ($matches[1] as $match) {
        if (!preg_match('/^\s*<i>.*:.*<\/i>/', $match)) {
            continue;
        }
        $parts[] = '  ' . trim($match);
    }

    $rawGrammar = implode("\n\n", $parts);
    return "<pre>\n$rawGrammar\n</pre>";
}
