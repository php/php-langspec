<?php error_reporting(E_ALL);

require __DIR__ . '/util.php';
require __DIR__ . '/grammar_util.php';

/*
 * Render grammars (after GRAMMAR blocks)
 */

// Collect all defined names (for referencing)
$names = [];
foreach (spec_files() as $fileName => $path) {
    $code = file_get_contents($path);
    $defs = Grammar\get_all_defs($code);
    foreach ($defs as $def) {
        if (isset($names[$def->name])) {
            throw new Exception("Duplicate definition for $def->name");
        }
        $names[$def->name] = $fileName;
    }
}

// Render grammars
foreach (spec_files() as $fileName => $path) {
    $code = $origCode = file_get_contents($path);
    $code = preg_replace_callback(
        '/(<!--\s*GRAMMAR(.*?)-->)\s+<pre>.*?<\/pre>/s',
        function($matches) use($names, $fileName) {
            $defs = Grammar\parse_grammar($matches[2]);
            $rendered = Grammar\render_grammar($defs, $names, $fileName);
            return $matches[1] . "\n\n" . $rendered;
        },
        $code
    );
    if ($code !== $origCode) {
        file_put_contents($path, $code);
    }
}

/*
 * Generate summary grammar chapter
 */

// Pretend that all definitions are inside 19-grammar.md now
$names = array_fill_keys(array_keys($names), '19-grammar.md');

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
$output .= extract_grammar($lexical, $names);

$output .= "\n\n##Syntactic Grammar";

$skipFiles = ['05-types.md', '09-lexical-structure.md', '19-grammar.md'];
foreach (spec_files($skipFiles) as $fileName => $path) {
    $code = file_get_contents($path);
    $grammar = extract_grammar($code, $names);
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

function extract_grammar($code, $names) {
    $defs = Grammar\get_all_defs($code);
    if (empty($defs)) {
        return null;
    }
    return Grammar\render_grammar($defs, $names, '19-grammar.md');
}
