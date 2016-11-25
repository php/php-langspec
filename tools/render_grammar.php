<?php error_reporting(E_ALL);

require __DIR__ . '/util.php';
require __DIR__ . '/grammar_util.php';

$skipFiles = ['19-grammar.md'];

// Collect all defined names (for referencing)
$names = [];
foreach (spec_files($skipFiles) as $fileName => $path) {
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
foreach (spec_files($skipFiles) as $fileName => $path) {
    $code = file_get_contents($path);
    $code = preg_replace_callback(
        '/(<!--\s*GRAMMAR(.*?)-->)\s+<pre>.*?<\/pre>/s',
        function($matches) use($names, $fileName) {
            $defs = Grammar\parse_grammar($matches[2]);
            $rendered = Grammar\render_grammar($defs, $names, $fileName);
            return $matches[1] . "\n\n" . $rendered;
        },
        $code
    );
    file_put_contents($path, $code);
}
