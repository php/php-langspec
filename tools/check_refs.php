<?php error_reporting(E_ALL);

require __DIR__ . '/util.php';

// Collect all valid anchors
$anchors = [];
foreach (spec_files() as $fileName => $path) {
    $contents = file_get_contents($path);
    foreach (heading_info($contents) as $info) {
        $fullAnchor = $fileName . '#' . $info['anchor'];
        $anchors[$fullAnchor] = true;
    }
}

// Find unknown anchor references
foreach (spec_files() as $fileName => $path) {
    $contents = file_get_contents($path);

    if (!preg_match_all('/\]\(([^)]+)\)/', $contents, $matches)) {
        continue;
    }

    foreach ($matches[1] as $anchor) {
        if (false === strpos($anchor, '#')) {
            continue;
        }
        if (!preg_match('/^(#|\d{2})/', $anchor)) {
            continue;
        }

        if ('#' === $anchor[0]) {
            $anchor = $fileName . $anchor;
        }

        if (!isset($anchors[$anchor])) {
            echo "Unknown anchor $anchor in $fileName\n";
        }
    }
}
