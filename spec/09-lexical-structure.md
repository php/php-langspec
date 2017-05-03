# Lexical Structure

## Scripts

A [script](04-basic-concepts.md#program-structure) is an ordered sequence of characters. Typically, a
script has a one-to-one correspondence with a file in a file system, but
this correspondence is not required.

Conceptually speaking, a script is translated using the following steps:

1.  Transformation, which converts a script from a particular character
    repertoire and encoding scheme into a sequence of 8-bit characters.

2.  Lexical analysis, which translates a stream of input characters into
    a stream of tokens.

3.  Syntactic analysis, which translates the stream of tokens into
    executable code.

Conforming implementations must accept scripts encoded with the UTF-8
encoding form (as defined by the Unicode standard), and transform them
into a sequence of characters. Implementations can choose to accept and
transform additional character encoding schemes.

## Grammars

This specification shows the syntax of the PHP programming language
using two grammars. The *lexical grammar* defines how source
characters are combined to form white space, comments, and tokens. The
*syntactic grammar* defines how the resulting tokens are combined to
form PHP programs.

The grammars are presented using *grammar productions*, with each one
defining a non-terminal symbol and the possible expansions of that
non-terminal symbol into sequences of non-terminal or terminal symbols.
In productions, non-terminal symbols are shown in slanted type *like
this*, and terminal symbols are shown in a fixed-width font `like this`.

The first line of a grammar production is the name of the non-terminal
symbol being defined, followed by one colon for a syntactic grammar
production, and two colons for a lexical grammar production. Each
successive indented line contains a possible expansion of the
non-terminal given as a sequence of non-terminal or terminal symbols.
For example, the production:

<!-- GRAMMAR
single-line-comment-example::
  '//' input-characters?
  '#' input-characters?
-->

<pre>
<i id="grammar-single-line-comment-example">single-line-comment-example::</i>
   //   <i><a href="#grammar-input-characters">input-characters</a></i><sub>opt</sub>
   #   <i><a href="#grammar-input-characters">input-characters</a></i><sub>opt</sub>
</pre>

defines the lexical grammar production *single-line-comment-example* as being
the terminals `//` or `#`, followed by an optional *input-characters*. Each
expansion is listed on a separate line.

Although alternatives are usually listed on separate lines, when there
is a large number, the shorthand phrase “one of” may precede a list of
expansions given on a single line. For example,

<!-- GRAMMAR
hexadecimal-digit-example:: one of
  '0' '1' '2' '3' '4' '5' '6' '7' '8' '9'
  'a' 'b' 'c' 'd' 'e' 'f'
  'A' 'B' 'C' 'D' 'E' 'F'
-->

<pre>
<i id="grammar-hexadecimal-digit-example">hexadecimal-digit-example:: one of</i>
   0   1   2   3   4   5   6   7   8   9
   a   b   c   d   e   f
   A   B   C   D   E   F
</pre>

## Lexical analysis

### General

The production *input-file* is the root of the lexical structure for a
script. Each script must conform to this production.

**Syntax**

<!-- GRAMMAR
input-file::
  input-element
  input-file input-element

input-element::
  comment
  white-space
  token
-->

<pre>
<i id="grammar-input-file">input-file::</i>
   <i><a href="#grammar-input-element">input-element</a></i>
   <i><a href="#grammar-input-file">input-file</a></i>   <i><a href="#grammar-input-element">input-element</a></i>

<i id="grammar-input-element">input-element::</i>
   <i><a href="#grammar-comment">comment</a></i>
   <i><a href="#grammar-white-space">white-space</a></i>
   <i><a href="#grammar-token">token</a></i>
</pre>

**Semantics**

The basic elements of a script are comments, white space, and tokens.

The lexical processing of a script involves the reduction of that script
into a sequence of [tokens](#tokens) that becomes the input to the
syntactic analysis. Tokens can be separated by [white space](#white-space) and
delimited [comments](#comments).

Lexical processing always results in the creation of the longest
possible lexical element. (For example, `$a+++++$b` must be parsed as
`$a++ ++ +$b`, which syntactically is invalid).

### Comments

Two forms of comments are supported: *delimited comments* and
*single-line comments*.

**Syntax**

<!-- GRAMMAR
comment::
  single-line-comment
  delimited-comment

single-line-comment::
  '//' input-characters?
  '#' input-characters?

input-characters::
  input-character
  input-characters input-character

input-character::
  "Any source character except" new-line

new-line::
  "Carriage-return character (U+000D)"
  "Line-feed character (U+000A)"
  "Carriage-return character (U+000D) followed by line-feed character (U+000A)"

delimited-comment::
  '/*' "No characters or any source character sequence except */" '*/'
-->

<pre>
<i id="grammar-comment">comment::</i>
   <i><a href="#grammar-single-line-comment">single-line-comment</a></i>
   <i><a href="#grammar-delimited-comment">delimited-comment</a></i>

<i id="grammar-single-line-comment">single-line-comment::</i>
   //   <i><a href="#grammar-input-characters">input-characters</a></i><sub>opt</sub>
   #   <i><a href="#grammar-input-characters">input-characters</a></i><sub>opt</sub>

<i id="grammar-input-characters">input-characters::</i>
   <i><a href="#grammar-input-character">input-character</a></i>
   <i><a href="#grammar-input-characters">input-characters</a></i>   <i><a href="#grammar-input-character">input-character</a></i>

<i id="grammar-input-character">input-character::</i>
   Any source character except   <i><a href="#grammar-new-line">new-line</a></i>

<i id="grammar-new-line">new-line::</i>
   Carriage-return character (U+000D)
   Line-feed character (U+000A)
   Carriage-return character (U+000D) followed by line-feed character (U+000A)

<i id="grammar-delimited-comment">delimited-comment::</i>
   /*   No characters or any source character sequence except */   */
</pre>

**Semantics**

Except within a string literal or a comment, the characters `/*` start a
delimited comment, which ends with the characters `*/`. Except within a
string literal or a comment, the characters `//` or `#` start a single-line
comment, which ends with a new line. That new line is not part of the
comment. However, if the single-line comment is the last source element
in an embedded script, the trailing new line can be omitted. (Note: this
allows for uses like `<?php ... // ... ?>`).

A delimited comment can occur in any place in a script in which [white
space](#white-space) can occur. (For example;
`/*...*/$c/*...*/=/*...*/567/*...*/;/*...*/` is parsed as `$c=567;`, and
`$k = $i+++/*...*/++$j;` is parsed as `$k = $i+++ ++$j;`).

**Implementation Notes**

During tokenizing, an implementation can treat a delimited comment as
though it was white space.

### White Space

White space consists of an arbitrary combination of one or more
new-line, space and horizontal tab characters.

**Syntax**

<!-- GRAMMAR
white-space::
  white-space-character
  white-space white-space-character

white-space-character::
  new-line
  "Space character (U+0020)"
  "Horizontal-tab character (U+0009)"
-->

<pre>
<i id="grammar-white-space">white-space::</i>
   <i><a href="#grammar-white-space-character">white-space-character</a></i>
   <i><a href="#grammar-white-space">white-space</a></i>   <i><a href="#grammar-white-space-character">white-space-character</a></i>

<i id="grammar-white-space-character">white-space-character::</i>
   <i><a href="#grammar-new-line">new-line</a></i>
   Space character (U+0020)
   Horizontal-tab character (U+0009)
</pre>

**Semantics**

The space and horizontal tab characters are considered *horizontal
white-space characters*.

### Tokens

#### General

There are several kinds of source *tokens*:

**Syntax**

<!-- GRAMMAR
token::
  variable-name
  name
  keyword
  integer-literal
  floating-literal
  string-literal
  operator-or-punctuator
-->

<pre>
<i id="grammar-token">token::</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>
   <i><a href="#grammar-name">name</a></i>
   <i><a href="#grammar-keyword">keyword</a></i>
   <i><a href="#grammar-integer-literal">integer-literal</a></i>
   <i><a href="#grammar-floating-literal">floating-literal</a></i>
   <i><a href="#grammar-string-literal">string-literal</a></i>
   <i><a href="#grammar-operator-or-punctuator">operator-or-punctuator</a></i>
</pre>

#### Names

**Syntax**

<!-- GRAMMAR
variable-name::
  '$' name

namespace-name::
  name
  namespace-name '\' name

namespace-name-as-a-prefix::
  '\'
  '\'? namespace-name '\'
  'namespace' '\'
  'namespace' '\' namespace-name '\'

qualified-name::
  namespace-name-as-a-prefix? name

name::
  name-nondigit
  name name-nondigit
  name digit

name-nondigit::
  nondigit
  "one of the characters U+0080–U+00ff"

nondigit:: one of
  '_'
  'a' 'b' 'c' 'd' 'e' 'f' 'g' 'h' 'i' 'j' 'k' 'l' 'm'
  'n' 'o' 'p' 'q' 'r' 's' 't' 'u' 'v' 'w' 'x' 'y' 'z'
  'A' 'B' 'C' 'D' 'E' 'F' 'G' 'H' 'I' 'J' 'K' 'L' 'M'
  'N' 'O' 'P' 'Q' 'R' 'S' 'T' 'U' 'V' 'W' 'X' 'Y' 'Z'
-->

<pre>
<i id="grammar-variable-name">variable-name::</i>
   $   <i><a href="#grammar-name">name</a></i>

<i id="grammar-namespace-name">namespace-name::</i>
   <i><a href="#grammar-name">name</a></i>
   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \   <i><a href="#grammar-name">name</a></i>

<i id="grammar-namespace-name-as-a-prefix">namespace-name-as-a-prefix::</i>
   \
   \<sub>opt</sub>   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \
   namespace   \
   namespace   \   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \

<i id="grammar-qualified-name">qualified-name::</i>
   <i><a href="#grammar-namespace-name-as-a-prefix">namespace-name-as-a-prefix</a></i><sub>opt</sub>   <i><a href="#grammar-name">name</a></i>

<i id="grammar-name">name::</i>
   <i><a href="#grammar-name-nondigit">name-nondigit</a></i>
   <i><a href="#grammar-name">name</a></i>   <i><a href="#grammar-name-nondigit">name-nondigit</a></i>
   <i><a href="#grammar-name">name</a></i>   <i><a href="#grammar-digit">digit</a></i>

<i id="grammar-name-nondigit">name-nondigit::</i>
   <i><a href="#grammar-nondigit">nondigit</a></i>
   one of the characters U+0080–U+00ff

<i id="grammar-nondigit">nondigit:: one of</i>
   _
   a   b   c   d   e   f   g   h   i   j   k   l   m
   n   o   p   q   r   s   t   u   v   w   x   y   z
   A   B   C   D   E   F   G   H   I   J   K   L   M
   N   O   P   Q   R   S   T   U   V   W   X   Y   Z
</pre>

**Semantics**

Names are used to identify the following: [constants](06-constants.md#general),
[variables](07-variables.md#general), [labels](11-statements.md#labeled-statements),
[functions](13-functions.md#function-definitions), [classes](14-classes.md#class-declarations),
[class members](14-classes.md#class-members), [interfaces](15-interfaces.md#interface-declarations),
[traits](16-traits.md#general), [namespaces](18-namespaces.md#general),
and names in [heredoc](#heredoc-string-literals) and [nowdoc comments](#nowdoc-string-literals).

A *name* begins with an underscore (_), *name-nondigit*, or extended
name character in the range U+0080–-U+00ff. Subsequent characters can
also include *digits*. A *variable name* is a name with a leading
dollar ($).

Unless stated otherwise ([functions](13-functions.md#function-definitions),
[classes](14-classes.md#class-declarations), [methods](14-classes.md#methods),
[interfaces](15-interfaces.md#interface-declarations), [traits](16-traits.md#trait-declarations),
[namespaces](18-namespaces.md#defining-namespaces)), names are case-sensitive, and every character in a name is significant.

Names beginning with two underscores (__) are reserved by the PHP language and should not be defined by the user code.

The following names cannot be used as the names of classes, interfaces, or traits: `bool`, `FALSE`, `float`, `int`, `NULL`, `string`, `TRUE`, `iterable`, and `void`.

The following names are reserved for future use and should not be used as the names of classes, interfaces, or traits: `mixed`, `numeric`, `object`, and `resource`.

With the exception of `class`, all [keywords](#keywords) can be used as names for the members of a class, interface, or trait. However, `class` can be used as the name of a property or method.

Variable names and function names (when used in a function-call context)
need not be defined as source tokens; they can also be created at
runtime using [simple variable expressions](10-expressions.md#simple-variable). (For
example, given `$a = "Total"; $b = 3; $c = $b + 5;`, `${$a.$b.$c} = TRUE;`
is equivalent to `$Total38 = TRUE;`, and `${$a.$b.$c}()` is
equivalent to `Total38()`).

**Examples**

```PHP
const MAX_VALUE = 100;
function getData() { /*...*/ }
class Point { /*...*/ }
interface ICollection { /*...*/ }
```

**Implementation Notes**

An implementation is discouraged from placing arbitrary restrictions on
name lengths.

#### Keywords

A *keyword* is a name-like sequence of characters that is reserved, and
cannot be used as a name.

**Syntax**

<!-- GRAMMAR
keyword:: one of
  'abstract' 'and' 'array' 'as' 'break' 'callable' 'case' 'catch' 'class' 'clone'
  'const' 'continue' 'declare' 'default' 'die' 'do' 'echo' 'else' 'elseif' 'empty'
  'enddeclare' 'endfor' 'endforeach' 'endif' 'endswitch' 'endwhile' 'eval' 'exit'
  'extends' 'final' 'finally' 'for' 'foreach' 'function' 'global'
  'goto' 'if' 'implements' 'include' 'include_once' 'instanceof'
  'insteadof' 'interface' 'isset' 'list' 'namespace' 'new' 'or' 'print' 'private'
  'protected' 'public' 'require' 'require_once' 'return' 'static' 'switch'
  'throw' 'trait' 'try' 'unset' 'use' 'var' 'while' 'xor' 'yield' 'yield from'
-->

<pre>
<i id="grammar-keyword">keyword:: one of</i>
   abstract   and   array   as   break   callable   case   catch   class   clone
   const   continue   declare   default   die   do   echo   else   elseif   empty
   enddeclare   endfor   endforeach   endif   endswitch   endwhile   eval   exit
   extends   final   finally   for   foreach   function   global
   goto   if   implements   include   include_once   instanceof
   insteadof   interface   isset   list   namespace   new   or   print   private
   protected   public   require   require_once   return   static   switch
   throw   trait   try   unset   use   var   while   xor   yield   yield from
</pre>

**Semantics**

Keywords are not case-sensitive.

Note carefully that `yield from` is a single token that contains whitespace. However, [comments](#comments) are not permitted in that whitespace.

Also, all [*magic constants*](06-constants.md#context-dependent-constants) are also treated as keywords.

#### Literals

The source code representation of a value is called a *literal*.

##### Integer Literals

**Syntax**

<!-- GRAMMAR
integer-literal::
  decimal-literal
  octal-literal
  hexadecimal-literal
  binary-literal

decimal-literal::
  nonzero-digit
  decimal-literal digit

octal-literal::
  '0'
  octal-literal octal-digit

hexadecimal-literal::
  hexadecimal-prefix hexadecimal-digit
  hexadecimal-literal hexadecimal-digit

hexadecimal-prefix:: one of
  '0x' '0X'

binary-literal::
  binary-prefix binary-digit
  binary-literal binary-digit

binary-prefix:: one of
  '0b' '0B'

digit:: one of
  '0' '1' '2' '3' '4' '5' '6' '7' '8' '9'

nonzero-digit:: one of
  '1' '2' '3' '4' '5' '6' '7' '8' '9'

octal-digit:: one of
  '0' '1' '2' '3' '4' '5' '6' '7'

hexadecimal-digit:: one of
  '0' '1' '2' '3' '4' '5' '6' '7' '8' '9'
  'a' 'b' 'c' 'd' 'e' 'f'
  'A' 'B' 'C' 'D' 'E' 'F'

binary-digit:: one of
  '0' '1'
-->

<pre>
<i id="grammar-integer-literal">integer-literal::</i>
   <i><a href="#grammar-decimal-literal">decimal-literal</a></i>
   <i><a href="#grammar-octal-literal">octal-literal</a></i>
   <i><a href="#grammar-hexadecimal-literal">hexadecimal-literal</a></i>
   <i><a href="#grammar-binary-literal">binary-literal</a></i>

<i id="grammar-decimal-literal">decimal-literal::</i>
   <i><a href="#grammar-nonzero-digit">nonzero-digit</a></i>
   <i><a href="#grammar-decimal-literal">decimal-literal</a></i>   <i><a href="#grammar-digit">digit</a></i>

<i id="grammar-octal-literal">octal-literal::</i>
   0
   <i><a href="#grammar-octal-literal">octal-literal</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<i id="grammar-hexadecimal-literal">hexadecimal-literal::</i>
   <i><a href="#grammar-hexadecimal-prefix">hexadecimal-prefix</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>
   <i><a href="#grammar-hexadecimal-literal">hexadecimal-literal</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>

<i id="grammar-hexadecimal-prefix">hexadecimal-prefix:: one of</i>
   0x   0X

<i id="grammar-binary-literal">binary-literal::</i>
   <i><a href="#grammar-binary-prefix">binary-prefix</a></i>   <i><a href="#grammar-binary-digit">binary-digit</a></i>
   <i><a href="#grammar-binary-literal">binary-literal</a></i>   <i><a href="#grammar-binary-digit">binary-digit</a></i>

<i id="grammar-binary-prefix">binary-prefix:: one of</i>
   0b   0B

<i id="grammar-digit">digit:: one of</i>
   0   1   2   3   4   5   6   7   8   9

<i id="grammar-nonzero-digit">nonzero-digit:: one of</i>
   1   2   3   4   5   6   7   8   9

<i id="grammar-octal-digit">octal-digit:: one of</i>
   0   1   2   3   4   5   6   7

<i id="grammar-hexadecimal-digit">hexadecimal-digit:: one of</i>
   0   1   2   3   4   5   6   7   8   9
   a   b   c   d   e   f
   A   B   C   D   E   F

<i id="grammar-binary-digit">binary-digit:: one of</i>
   0   1
</pre>

**Semantics**

The value of a decimal integer literal is computed using base 10; that
of an octal integer literal, base 8; that of a hexadecimal integer
literal, base 16; and that of a binary integer literal, base 2.

If the value represented by *integer-literal* can fit in type int,
that would be the type of the resulting value; otherwise, the type would be float,
as described below.

Since negative numbers are represented in PHP as a negation of a positive
number, the smallest negative value (-2147483648 for 32 bits and -9223372036854775808 for 64 bits)
can not be represented as a decimal integer literal. If the non-negative
value is too large to represent as an `int`, it becomes `float`, which is
then negated.

Literals written using hexadecimal, octal, or binary notations are
considered to have non-negative values.

An integer literal is always a constant expression.

**Examples**

```PHP
$count = 10;      // decimal 10

0b101010 >> 4;    // binary 101010 and decimal 4

0XAF << 023;      // hexadecimal AF and octal 23
```

On an implementation using 32-bit int representation

```
2147483648 -> 2147483648 (too big for int, so is a float)

-2147483648 -> -2147483648 (too big for int, so is a float, negated)

-2147483647 - 1 -> -2147483648 fits in int

0x80000000 -> 2147483648 (too big for int, so is a float)
```

##### Floating-Point Literals

**Syntax**

<!-- GRAMMAR
floating-literal::
  fractional-literal exponent-part?
  digit-sequence exponent-part

fractional-literal::
  digit-sequence? '.' digit-sequence
  digit-sequence '.'

exponent-part::
  'e' sign? digit-sequence
  'E' sign? digit-sequence

sign:: one of
  '+' '-'

digit-sequence::
  digit
  digit-sequence digit
-->

<pre>
<i id="grammar-floating-literal">floating-literal::</i>
   <i><a href="#grammar-fractional-literal">fractional-literal</a></i>   <i><a href="#grammar-exponent-part">exponent-part</a></i><sub>opt</sub>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>   <i><a href="#grammar-exponent-part">exponent-part</a></i>

<i id="grammar-fractional-literal">fractional-literal::</i>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i><sub>opt</sub>   .   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>   .

<i id="grammar-exponent-part">exponent-part::</i>
   e   <i><a href="#grammar-sign">sign</a></i><sub>opt</sub>   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>
   E   <i><a href="#grammar-sign">sign</a></i><sub>opt</sub>   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>

<i id="grammar-sign">sign:: one of</i>
   +   -

<i id="grammar-digit-sequence">digit-sequence::</i>
   <i><a href="#grammar-digit">digit</a></i>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>   <i><a href="#grammar-digit">digit</a></i>
</pre>

**Constraints**

The value of a floating-point literal must be representable by its type.

**Semantics**

The type of a *floating-literal* is `float`.

The constants [`INF`](06-constants.md#core-predefined-constants) and
[`NAN`](06-constants.md#core-predefined-constants) provide access to the
floating-point values for infinity and Not-a-Number, respectively.

A floating point literal is always a constant expression.

**Examples**

```PHP
$values = array(1.23, 3e12, 543.678E-23);
```

##### String Literals

**Syntax**

<!-- GRAMMAR
string-literal::
  single-quoted-string-literal
  double-quoted-string-literal
  heredoc-string-literal
  nowdoc-string-literal
-->

<pre>
<i id="grammar-string-literal">string-literal::</i>
   <i><a href="#grammar-single-quoted-string-literal">single-quoted-string-literal</a></i>
   <i><a href="#grammar-double-quoted-string-literal">double-quoted-string-literal</a></i>
   <i><a href="#grammar-heredoc-string-literal">heredoc-string-literal</a></i>
   <i><a href="#grammar-nowdoc-string-literal">nowdoc-string-literal</a></i>
</pre>

**Semantics**

A string literal is a sequence of zero or more characters delimited in
some fashion. The delimiters are not part of the literal's content.

The type of a string literal is `string`.

###### Single-Quoted String Literals

**Syntax**

<!-- GRAMMAR
single-quoted-string-literal::
  b-prefix? '''' sq-char-sequence? ''''

sq-char-sequence::
  sq-char
  sq-char-sequence sq-char

sq-char::
  sq-escape-sequence
  '\'? "any member of the source character set except single-quote (') or backslash (\)"

sq-escape-sequence:: one of
  '\''' '\\'

b-prefix:: one of
  'b' 'B'
-->

<pre>
<i id="grammar-single-quoted-string-literal">single-quoted-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   '   <i><a href="#grammar-sq-char-sequence">sq-char-sequence</a></i><sub>opt</sub>   '

<i id="grammar-sq-char-sequence">sq-char-sequence::</i>
   <i><a href="#grammar-sq-char">sq-char</a></i>
   <i><a href="#grammar-sq-char-sequence">sq-char-sequence</a></i>   <i><a href="#grammar-sq-char">sq-char</a></i>

<i id="grammar-sq-char">sq-char::</i>
   <i><a href="#grammar-sq-escape-sequence">sq-escape-sequence</a></i>
   \<sub>opt</sub>   any member of the source character set except single-quote (') or backslash (\)

<i id="grammar-sq-escape-sequence">sq-escape-sequence:: one of</i>
   \'   \\

<i id="grammar-b-prefix">b-prefix:: one of</i>
   b   B
</pre>

**Semantics**

A single-quoted string literal is a string literal delimited by
single-quotes (`'`, U+0027). The literal can contain any source character except
single-quote (`'`) and backslash (`\\`), which can only be represented by
their corresponding escape sequence.

The optional *b-prefix* is reserved for future use in dealing with
so-called *binary strings*. For now, a *single-quoted-string-literal*
with a *b-prefix* is equivalent to one without.

A single-quoted string literal is always a constant expression.

**Examples**

```
'This text is taken verbatim'

'Can embed a single quote (\') and a backslash (\\) like this'
```

###### Double-Quoted String Literals

**Syntax**

<!-- GRAMMAR
double-quoted-string-literal::
  b-prefix? '"' dq-char-sequence? '"'

dq-char-sequence::
  dq-char
  dq-char-sequence dq-char

dq-char::
  dq-escape-sequence
  "any member of the source character set except double-quote ("") or backslash (\)"
  '\' "any member of the source character set except ""\$efnrtvxX or" octal-digit

dq-escape-sequence::
  dq-simple-escape-sequence
  dq-octal-escape-sequence
  dq-hexadecimal-escape-sequence
  dq-unicode-escape-sequence

dq-simple-escape-sequence:: one of
  '\"' '\\' '\$' '\e' '\f' '\n' '\r' '\t' '\v'

dq-octal-escape-sequence::
  '\' octal-digit
  '\' octal-digit octal-digit
  '\' octal-digit octal-digit octal-digit

dq-hexadecimal-escape-sequence::
  '\x' hexadecimal-digit hexadecimal-digit?
  '\X' hexadecimal-digit hexadecimal-digit?

dq-unicode-escape-sequence::
  '\u{' codepoint-digits '}'

codepoint-digits::
   hexadecimal-digit
   hexadecimal-digit codepoint-digits
-->

<pre>
<i id="grammar-double-quoted-string-literal">double-quoted-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   &quot;   <i><a href="#grammar-dq-char-sequence">dq-char-sequence</a></i><sub>opt</sub>   &quot;

<i id="grammar-dq-char-sequence">dq-char-sequence::</i>
   <i><a href="#grammar-dq-char">dq-char</a></i>
   <i><a href="#grammar-dq-char-sequence">dq-char-sequence</a></i>   <i><a href="#grammar-dq-char">dq-char</a></i>

<i id="grammar-dq-char">dq-char::</i>
   <i><a href="#grammar-dq-escape-sequence">dq-escape-sequence</a></i>
   any member of the source character set except double-quote (&quot;) or backslash (\)
   \   any member of the source character set except &quot;\$efnrtvxX or   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<i id="grammar-dq-escape-sequence">dq-escape-sequence::</i>
   <i><a href="#grammar-dq-simple-escape-sequence">dq-simple-escape-sequence</a></i>
   <i><a href="#grammar-dq-octal-escape-sequence">dq-octal-escape-sequence</a></i>
   <i><a href="#grammar-dq-hexadecimal-escape-sequence">dq-hexadecimal-escape-sequence</a></i>
   <i><a href="#grammar-dq-unicode-escape-sequence">dq-unicode-escape-sequence</a></i>

<i id="grammar-dq-simple-escape-sequence">dq-simple-escape-sequence:: one of</i>
   \&quot;   \\   \$   \e   \f   \n   \r   \t   \v

<i id="grammar-dq-octal-escape-sequence">dq-octal-escape-sequence::</i>
   \   <i><a href="#grammar-octal-digit">octal-digit</a></i>
   \   <i><a href="#grammar-octal-digit">octal-digit</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>
   \   <i><a href="#grammar-octal-digit">octal-digit</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<i id="grammar-dq-hexadecimal-escape-sequence">dq-hexadecimal-escape-sequence::</i>
   \x   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i><sub>opt</sub>
   \X   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i><sub>opt</sub>

<i id="grammar-dq-unicode-escape-sequence">dq-unicode-escape-sequence::</i>
   \u{   <i><a href="#grammar-codepoint-digits">codepoint-digits</a></i>   }

<i id="grammar-codepoint-digits">codepoint-digits::</i>
   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>
   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>   <i><a href="#grammar-codepoint-digits">codepoint-digits</a></i>
</pre>

**Semantics**

A double-quoted string literal is a string literal delimited by
double-quotes (`"`, U+0022). The literal can contain any source character except
double-quote (`"`) and backslash (`\\`), which can only be represented by
their corresponding escape sequence. Certain other (and sometimes
non-printable) characters can also be expressed as escape sequences.

The optional *b-prefix* is reserved for future use in dealing with
so-called *binary strings*. For now, a *double-quoted-string-literal*
with a *b-prefix* is equivalent to one without.

An escape sequence represents a single-character encoding, as described
in the table below:

Escape sequence | Character name | Unicode character
--------------- | --------------| ------
\$  | Dollar sign | U+0024
\"  | Double quote | U+0022
\\  | Backslash | U+005C
\e  | Escape | U+001B
\f  | Form feed | U+000C
\n  | New line | U+000A
\r  | Carriage Return | U+000D
\t  | Horizontal Tab | U+0009
\v  | Vertical Tab | U+000B
\ooo |  1–3-digit octal digit value ooo
\xhh or \Xhh  | 1–2-digit hexadecimal digit value hh
\u{xxxxxx} | UTF-8 encoding of Unicode codepoint U+xxxxxx | U+xxxxxx

Within a double-quoted string literal, except when recognized as the
start of an escape sequence, a backslash (\\) is retained verbatim.

Within a double-quoted string literal a dollar ($) character not
escaped by a backslash (\\) is handled using a variable substitution rules
described below.

The `\u{xxxxxx}` escape sequence produces the UTF-8 encoding of the Unicode
codepoint with the hexadecimal number specified within the curly braces.
Implementations MUST NOT allow Unicode codepoints beyond U+10FFFF as this is
outside the range UTF-8 can encode (see
[RFC 3629](http://tools.ietf.org/html/rfc3629#section-3)). If a codepoint
larger than U+10FFFF is specified, implementations MUST error.
Implementations MUST pass through `\u` verbatim and not interpret it as an
escape sequence if it is not followed by an opening `{`, but if it is,
implementations MUST produce an error if there is no terminating `}` or the
contents are not a valid codepoint. Implementations MUST support leading zeroes,
but MUST NOT support leading or trailing whitespace for the codepoint between
the opening and terminating braces. Implementations MUST allow Unicode
codepoints that are not Unicode scalar values, such as high and low surrogates.

A Unicode escape sequence cannot be created by variable substitution. For example, given `$v = "41"`,
`"\u{$v}"` results in `"\u41"`, a string of length 4, while `"\u{0$v}"` and `"\u{{$v}}"` contain
ill-formed Unicode escape sequences.

**Variable substitution**

The variable substitution accepts the following syntax:

<!-- GRAMMAR
string-variable::
  variable-name offset-or-property?
  '${' expression '}'

offset-or-property::
  offset-in-string
  property-in-string

offset-in-string::
  '[' name ']'
  '[' variable-name ']'
  '[' integer-literal ']'

property-in-string::
  '->' name
-->

<pre>
<i id="grammar-string-variable">string-variable::</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>   <i><a href="#grammar-offset-or-property">offset-or-property</a></i><sub>opt</sub>
   ${   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   }

<i id="grammar-offset-or-property">offset-or-property::</i>
   <i><a href="#grammar-offset-in-string">offset-in-string</a></i>
   <i><a href="#grammar-property-in-string">property-in-string</a></i>

<i id="grammar-offset-in-string">offset-in-string::</i>
   [   <i><a href="#grammar-name">name</a></i>   ]
   [   <i><a href="#grammar-variable-name">variable-name</a></i>   ]
   [   <i><a href="#grammar-integer-literal">integer-literal</a></i>   ]

<i id="grammar-property-in-string">property-in-string::</i>
   -&gt;   <i><a href="#grammar-name">name</a></i>
</pre>

*expression* works the same way as in [simple variable expressions](10-expressions.md#simple-variable).

After the variable defined by the syntax above is evaluated, its value is converted
to string according to the rules of [string conversion](08-conversions.md#converting-to-string-type)
and is substituted into the string in place of the variable substitution expression.

Subscript or property access defined by *offset-in-string* and *property-in-string*
is resolved according to the rules of the [subscript operator](10-expressions.md#subscript-operator)
and [member access operator](10-expressions.md#member-access-operator) respectively.
The exception is that *name* inside *offset-in-string* is interpreted as a string literal even if it is not
quoted.

If the character sequence following the `$` does not parse as *name* and does not start with `{`, the `$` character
is instead interpreted verbatim and no variable substitution is performed.

Variable substitution also provides limited support for the evaluation
of expressions. This is done by enclosing an expression in a pair of
matching braces (`{ ... }`). The opening brace must be followed immediately by
a dollar (`$`) without any intervening white space, and that dollar must
begin a variable name. If this is not the case, braces are treated
verbatim. If the opening brace (`{`) is escaped it is not interpreted as a start of
the embedded expression and instead is interpreted verbatim.

The value of the expression is converted to string according to the rules of
[string conversion](08-conversions.md#converting-to-string-type) and is substituted into the string
in place of the substitution expression.

A double-quoted string literal is a constant expression if it does not
contain any variable substitution.

**Examples**

```PHP
$x = 123;
echo ">\$x.$x"."<"; // → >$x.123<
// -----------------------------------------
$colors = array("red", "white", "blue");
$index = 2;
echo "\$colors[$index] contains >$colors[$index]<\n";
  // → $colors[2] contains >blue<
// -----------------------------------------
class C {
    public $p1 = 2;
}
$myC = new C();
echo "\$myC->p1 = >$myC->p1<\n";  // → $myC->p1 = >2<
```

###### Heredoc String Literals

**Syntax**

<!-- GRAMMAR
heredoc-string-literal::
  b-prefix? '<<<' hd-start-identifier new-line hd-body? hd-end-identifier ';'? new-line

hd-start-identifier::
  name
  '"' name '"'

hd-end-identifier::
  name

hd-body::
  hd-char-sequence? new-line

hd-char-sequence::
  hd-char
  hd-char-sequence hd-char

hd-char::
  hd-escape-sequence
  "any member of the source character set except backslash (\)"
  "\ any member of the source character set except \$efnrtvxX or" octal-digit

hd-escape-sequence::
  hd-simple-escape-sequence
  dq-octal-escape-sequence
  dq-hexadecimal-escape-sequence
  dq-unicode-escape-sequence

hd-simple-escape-sequence:: one of
  '\\' '\$' '\e' '\f' '\n' '\r' '\t' '\v'
-->

<pre>
<i id="grammar-heredoc-string-literal">heredoc-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   &lt;&lt;&lt;   <i><a href="#grammar-hd-start-identifier">hd-start-identifier</a></i>   <i><a href="#grammar-new-line">new-line</a></i>   <i><a href="#grammar-hd-body">hd-body</a></i><sub>opt</sub>   <i><a href="#grammar-hd-end-identifier">hd-end-identifier</a></i>   ;<sub>opt</sub>   <i><a href="#grammar-new-line">new-line</a></i>

<i id="grammar-hd-start-identifier">hd-start-identifier::</i>
   <i><a href="#grammar-name">name</a></i>
   &quot;   <i><a href="#grammar-name">name</a></i>   &quot;

<i id="grammar-hd-end-identifier">hd-end-identifier::</i>
   <i><a href="#grammar-name">name</a></i>

<i id="grammar-hd-body">hd-body::</i>
   <i><a href="#grammar-hd-char-sequence">hd-char-sequence</a></i><sub>opt</sub>   <i><a href="#grammar-new-line">new-line</a></i>

<i id="grammar-hd-char-sequence">hd-char-sequence::</i>
   <i><a href="#grammar-hd-char">hd-char</a></i>
   <i><a href="#grammar-hd-char-sequence">hd-char-sequence</a></i>   <i><a href="#grammar-hd-char">hd-char</a></i>

<i id="grammar-hd-char">hd-char::</i>
   <i><a href="#grammar-hd-escape-sequence">hd-escape-sequence</a></i>
   any member of the source character set except backslash (\)
   \ any member of the source character set except \$efnrtvxX or   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<i id="grammar-hd-escape-sequence">hd-escape-sequence::</i>
   <i><a href="#grammar-hd-simple-escape-sequence">hd-simple-escape-sequence</a></i>
   <i><a href="#grammar-dq-octal-escape-sequence">dq-octal-escape-sequence</a></i>
   <i><a href="#grammar-dq-hexadecimal-escape-sequence">dq-hexadecimal-escape-sequence</a></i>
   <i><a href="#grammar-dq-unicode-escape-sequence">dq-unicode-escape-sequence</a></i>

<i id="grammar-hd-simple-escape-sequence">hd-simple-escape-sequence:: one of</i>
   \\   \$   \e   \f   \n   \r   \t   \v
</pre>

**Constraints**

The start and end identifier names must be the same. Only horizontal white
space is permitted between `<<<` and the start identifier. No white
space is permitted between the start identifier and the new-line that
follows. No white space is permitted between the new-line and the end
identifier that follows. Except for an optional semicolon (`;`), no
characters—-not even comments or white space-—are permitted between the
end identifier and the new-line that terminates that source line.

**Semantics**

A heredoc string literal is a string literal delimited by
"`<<< name`" and "`name`". The literal can contain any source
character. Certain other (and sometimes non-printable) characters can
also be expressed as escape sequences.

A heredoc literal supports variable substitution as defined for
[double-quoted string literals](#double-quoted-string-literals).

A heredoc string literal is a constant expression if it does not contain
any variable substitution.

The optional *b-prefix* has no effect.

**Examples**

```PHP
$v = 123;
$s = <<<    ID
S'o'me "\"t e\txt; \$v = $v"
Some more text
ID;
echo ">$s<";
// → >S'o'me "\"t e  xt; $v = 123"
// Some more text<
```

###### Nowdoc String Literals

**Syntax**

<!-- GRAMMAR
nowdoc-string-literal::
  b-prefix? '<<<' '''' name '''' new-line hd-body? name ';'? new-line
-->

<pre>
<i id="grammar-nowdoc-string-literal">nowdoc-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   &lt;&lt;&lt;   '   <i><a href="#grammar-name">name</a></i>   '   <i><a href="#grammar-new-line">new-line</a></i>   <i><a href="#grammar-hd-body">hd-body</a></i><sub>opt</sub>   <i><a href="#grammar-name">name</a></i>   ;<sub>opt</sub>   <i><a href="#grammar-new-line">new-line</a></i>
</pre>

**Constraints**

The start and end identifier names must be the same.
No white space is permitted between the start identifier name and its
enclosing single quotes (`'`). See also [heredoc string literal](#heredoc-string-literals).

**Semantics**

A nowdoc string literal looks like a [heredoc string literal](#heredoc-string-literals)
except that in the former the start identifier name is
enclosed in single quotes (`'`). The two forms of string literal have the
same semantics and constraints except that a nowdoc string literal is
not subject to variable substitution (like the single-quoted string).

A nowdoc string literal is a constant expression.

The optional *b-prefix* has no effect.

**Examples**

```PHP
$v = 123;
$s = <<<    'ID'
S'o'me "\"t e\txt; \$v = $v"
Some more text
ID;
echo ">$s<\n\n";
// → >S'o'me "\"t e\txt; \$v = $v"
// Some more text<
```

#### Operators and Punctuators

**Syntax**

<!-- GRAMMAR
operator-or-punctuator:: one of
  '[' ']' '(' ')' '{' '}' '.' '->' '++' '--' '**' '*' '+' '-' '~' '!'
  '$' '/' '%' '<<' '>>' '<' '>' '<=' '>=' '==' '===' '!=' '!==' '^' '|'
  '&' '&&' '||' '?' ':' ';' '=' '**=' '*=' '/=' '%=' '+=' '-=' '.=' '<<='
  '>>=' '&=' '^=' '|=' ',' '??' '<=>' '...' '\'
-->

<pre>
<i id="grammar-operator-or-punctuator">operator-or-punctuator:: one of</i>
   [   ]   (   )   {   }   .   -&gt;   ++   --   **   *   +   -   ~   !
   $   /   %   &lt;&lt;   &gt;&gt;   &lt;   &gt;   &lt;=   &gt;=   ==   ===   !=   !==   ^   |
   &amp;   &amp;&amp;   ||   ?   :   ;   =   **=   *=   /=   %=   +=   -=   .=   &lt;&lt;=
   &gt;&gt;=   &amp;=   ^=   |=   ,   ??   &lt;=&gt;   ...   \
</pre>

**Semantics**

Operators and punctuators are symbols that have independent syntactic
and semantic significance. *Operators* are used in expressions to
describe operations involving one or more *operands*, and that yield a
resulting value, produce a side effect, or some combination thereof.
*Punctuators* are used for grouping and separating.
