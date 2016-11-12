<?php

/* Iterator of spec files, using $fileName => $path. */
function spec_files() {
    $dir = __DIR__ . '/../spec/';
    $files = scandir($dir);

    foreach ($files as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) != 'md') {
            continue;
        }
        if ($file == '00-specification-for-php.md') {
            continue;
        }

        yield $file => $dir . $file;
    }
}

/* Iterator of heading information.
 * Assoc array with title, anchor, level. */
function heading_info($code) {
    $anchors = [];
    $lines = explode("\n", $code);
    foreach ($lines as $line) {
        if (!preg_match('/^(#+)\s*(.+)/', $line, $matches)) {
            continue;
        }

        list(, $hashes, $title) = $matches;

        $anchor = strtr(strtolower($title), ' ', '-');
        $anchor = preg_replace('/[^\w-]/', '', $anchor);

        if (isset($anchors[$anchor])) {
            $anchors[$anchor]++;
            $anchor .= '-' . $anchors[$anchor];
        } else {
            $anchors[$anchor] = 0;
        }

        yield [
            'title' => $title,
            'anchor' => $anchor,
            'level' => strlen($hashes) - 1
        ];
    }
}
