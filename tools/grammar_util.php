<?php

namespace Grammar;

function parse_grammar($grammar) {
    $defTexts = explode("\n\n", trim($grammar));
    $defs = [];
    foreach ($defTexts as $defText) {
        if (!preg_match('/^([a-zA-Z0-9-]+)(::?)(\s+one\s+of)?\n(.*?)$/s', $defText, $matches)) {
            throw new Exception('Invalid definition');
        }

        $rules = array_map('Grammar\parse_rule', explode("\n", $matches[4]));
        $defs[] = new Definition(
            $matches[1], $matches[2] === '::', $matches[3] !== '', $rules
        );
    }
    return $defs;
}

function parse_rule($rule) {
    $regex = <<<'REGEX'
/(?:
    '[^']*(?:''[^']*)*'
  | "[^"]*(?:""[^"]*)*"
)(*SKIP)(*F)|\s+/x
REGEX;
    $parts = array_map('Grammar\parse_rule_part', preg_split($regex, trim($rule)));
    return new Rule($parts);
}

function parse_rule_part($part) {
    if (substr($part, -1) === '?') {
        return new Opt(parse_rule_part(substr($part, 0, -1)));
    }
    if ($part[0] === "'") {
        $contents = str_replace("''", "'", substr($part, 1, -1));
        return new Plain($contents);
    }
    if ($part[0] === '"') {
        $contents = str_replace('""', '"', substr($part, 1, -1));
        return new Plain($contents);
    }
    return new Reference($part);
}

function render_grammar($defs, $names, $currentFile) {
    $ctx = new RenderContext;
    $ctx->names = $names;
    $ctx->currentFile = $currentFile;

    $result = [];
    foreach ($defs as $def) {
        $result[] = $def->render($ctx);
    }
    return "<pre>\n" . implode("\n\n", $result) . "\n</pre>";
}

class RenderContext {
    public $names;
    public $currentFile;
}

class Definition {
    public $name, $isLexical, $isOneOf, $rules;
    public function __construct($name, $isLexical, $isOneOf, $rules) {
        $this->name = $name;
        $this->isLexical = $isLexical;
        $this->isOneOf = $isOneOf;
        $this->rules = $rules;
    }
    public function render($ctx) {
        $sep = $this->isLexical ? '::' : ':';
        $oneOf = $this->isOneOf ? ' one of' : '';
        $result = "<a name=\"grammar-$this->name\">\n<i>$this->name</i>$sep$oneOf";
        foreach ($this->rules as $rule) {
            $result .= "\n   " . $rule->render($ctx);
        }
        return $result;
    }
}
class Rule {
    public $parts;
    public function __construct($parts) {
        $this->parts = $parts;
    }
    public function render($ctx) {
        $parts = [];
        foreach ($this->parts as $part) {
            $parts[] = $part->render($ctx);
        }
        return implode('   ', $parts);
    }
}
class Reference {
    public $name;
    public function __construct($name) {
        $this->name = $name;
    }
    public function render($ctx) {
        if (!isset($ctx->names[$this->name])) {
            throw new \Exception("Reference to unknown name $this->name");
        }
        $fileName = $ctx->names[$this->name];
        $anchor = "#grammar-$this->name";
        if ($fileName != $ctx->currentFile) {
            $anchor = $fileName . $anchor;
        }
        return "<i><a href=\"$anchor\">$this->name</a></i>";
    }
}
class Plain {
    public $string;
    public function __construct($string) {
        $this->string = $string;
    }
    public function render($ctx) {
        return htmlspecialchars($this->string);
    }
}
class Opt {
    public $inner;
    public function __construct($inner) {
        $this->inner = $inner;
    }
    public function render($ctx) {
        return $this->inner->render($ctx) . '<sub>opt</sub>';
    }
}
