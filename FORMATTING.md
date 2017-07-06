# Formatting rules

1. The format of the PHP Language Specification is
   [Markdown](http://daringfireball.net/projects/markdown/).
2. Everything in the actual specification document must be ASCII only.
3. The only allowed extensions to original Markdown are tables and code blocks
   (indicated by three backticks).
4. Style
  * Use spaces to indent, not tabs.
  * Use the 4-space rule to indent nested lists (nested lists must be indented
    with four spaces for each indentation level).
  * For headings, use prefixed hash symbols `# Example`, not underlining it
    with `===`.
  * Use of *inline* links `[example](http://example.org)` is preferred over
    *reference* links `[example][xmpl]` unless used multiple times in a
    paragraph or section. This is to allow for easier splitting and
    reorganization of the document.
  * Do not embed external images not hosted on [php.net](http://php.net)
    infrastructure.
  * Try to stick to 80 chars wide, if possible. This is not as strict as
    in coding standard rules, but still easier to read most of the times.
    This does only apply to text, not to code examples or tables.
