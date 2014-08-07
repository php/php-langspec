#Lexical Structure

##Scripts

A script ([§§](04-basic-concepts.md#program-structure)) is an ordered sequence of characters. Typically, a
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

##Grammars

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

<pre>
  <i>single-line-comment::</i>
    // input-characters<sub>opt</sub>
    #  input-characters<sub>opt</sub>
</pre>

defines the lexical grammar production *single-line-comment* as being
the terminals `//` or `#`, followed by an optional *input-characters*. Each
expansion is listed on a separate line.

Although alternatives are usually listed on separate lines, when there
is a large number, the shorthand phrase “one of” may precede a list of
expansions given on a single line. For example,

<pre>
  <i>hexadecimal-digit: one of</i>
    0   1   2   3   4   5   6   7   8   9
    a   b   c   d   e   f
    A   B   C   D   E   F
</pre>

##Lexical analysis

##General

The production *input-file* is the root of the lexical structure for a
script. Each script must conform to this production.

**Syntax:**

<pre>
  <i>input-file::
    <i>input-element
    <i>input-file   input-element
  <i>input-element::</i>
    <i>comment</i>
    <i>white-space</i>
    <i>token</i>
</pre>

*comment* is defined in [§§](#comments); *white-space* is defined in [§§](#white-space), and
*token* is defined in [§§](#tokens).

**Semantics:**

The basic elements of a script are comments, white space, and tokens.

The lexical processing of a script involves the reduction of that script
into a sequence of tokens ([§§](#tokens)) that becomes the input to the
syntactic analysis. Tokens can be separated by white space ([§§](#white-space)) and
delimited comments ([§§](#comments)).

Lexical processing always results in the creation of the longest
possible lexical element. (For example, `$a+++++$b` must be parsed as
`$a++ ++ +$b`, which syntactically is invalid).

##Comments

Two forms of comments are supported: *delimited comments* and
*single-line comments*.

**Syntax:**

<pre>
  <i>comment::</i>
    <i>single-line-comment</i>
    <i>delimited-comment</i>
    
  <i>single-line-comment::</i>
    //   <i>input-characters<sub>opt</sub></i>
      #    <i>input-characters<sub>opt</sub></i>

  <i>input-characters::</i>
    <i>input-character</i>
    <i>input-characters   input-character</i>

  <i>input-character::</i>
    Any source character except new-line
    
  <i>new-line::</i>
    Carriage-return character (U+000D)
    Line-feed character (U+000A)
    Carriage-return character (U+000D) followed by line-feed character (U+000A)

  <i>delimited-comment::</i>
    /*   No characters or any source character sequence except /*   */
</pre>

**Semantics:**

Except within a string literal or a comment, the characters /\* start a
delimited comment, which ends with the characters \*/. Except within a
string literal or a comment, the characters // or \# start a single-line
comment, which ends with a new line. That new line is not part of the
comment. However, if the single-line comment is the last source element
in an embedded script, the trailing new line can be omitted. (Note: this
allows for uses like `<?php ... // ... ?>`).

A delimited comment can occur in any place in a script in which white
space ([§§](#white-space)) can occur. (For example;
`/*...*/$c/*...*/=/*...*/567/*...*/;/*...*/` is parsed as `$c=567;`, and
`$k = $i+++/*...*/++$j;` is parsed as `$k = $i+++ ++$j;`).

**Implementation Notes**

During tokenizing, an implementation can treat a delimited comment as
though it was white space.

###White Space

White space consists of an arbitrary combination of one or more
new-line, space, horizontal tab, vertical tab, and form-feed characters.

**Syntax:**

<pre>
  <i>white-space::</i>
    <i>white-space-character</i>
    <i>white-space   white-space-character</i>

  <i>white-space-character::</i>
    <i>new-line</i>
    Space character (U+0020)
    Horizontal-tab character (U+0009)
</pre>

*new-line* is defined in [§§](#comments).

**Semantics:**

The space and horizontal tab characters are considered *horizontal
white-space characters*.

###Tokens

####General

There are several kinds of source *token*s:

**Syntax:**

<pre>
  <i>token::</i>
    <i>variable-name</i>
    <i>name</i>
    <i>keyword</i>
    <i>literal</i>
    <i>operator-or-punctuator</i>
</pre>

*variable-name* and *name* are defined in [§§](#names); *keyword* is defined
in [§§](#keywords); *literal* is defined in [§§](#general-2); and
*operator-or-punctuator* is defined in [§§](#operators-and-punctuators).

####Names

**Syntax:**

<pre>
  <i>variable-name::</i>
    $   <i>name</i>

  <i>namespace-name::</i>
    <i>name </i>
    <i>namespace-name   \   name</i>
    
  <i>namespace-name-as-a-prefix::</i>
    \
    \<sub>opt</sub>   <i>namespace-name</i>   \
    namespace   \
    namespace   \   <i>namespace-name</i>   \
    
  <i>qualified-name::</i>
    <i>namespace-name-as-a-prefix<sub>opt</sub>   name</i>
    
  <i>name::</i>
    <i>name-nondigit</i>
    <i>name   name-nondigit</i>
    <i>name   digit</i>

  <i>name-nondigit::</i>
    <i>nondigit</i>
    one of the characters U+007f–U+00ff

  <i>nondigit::</i> one of
    _
    a   b   c   d   e   f   g   h   i   j   k   l   m
    n   o   p   q   r   s   t   u   v   w   x   y   z
    A   B   C   D   E   F   G   H   I   J   K   L   M
    N   O   P   Q   R   S   T   U   V   W   X   Y   Z
</pre>

*digit* is defined in [§§](#integer-literals)

**Semantics:**

Names are used to identify the following: constants ([§§](06-constants.md#general)), variables
([§§](07-variables.md#general)), labels ([§§](11-statements.md#labeled-statements)), functions ([§§](13-functions.md#function-definitions)), classes ([§§](14-classes.md#class-declarations)), class
members ([§§](14-classes.md#class-members)), interfaces ([§§](15-interfaces.md#interface-declarations)), traits ([§§](16-traits.md#general)), namespaces ([§§](18-namespaces.md#general)),
and names in heredoc ([§§](#heredoc-string-literals)) and nowdoc comments ([§§](#nowdoc-string-literals)).

A *name* begins with an underscore (_), *name-nondigit*, or extended
name character in the range U+007f– ** U+00ff. Subsequent characters can
also include *digit*s. A *variable name* is a name with a leading
dollar ($).

Unless stated otherwise ([§§](13-functions.md#function-definitions), [§§](14-classes.md#class-declarations), [§§](14-classes.md#methods), [§§](15-interfaces.md#interface-declarations), [§§](16-traits.md#trait-declarations), [§§](18-namespaces.md#defining-namespaces)),
names are case-sensitive, and every character in a name is significant.

Function and method names beginning with two underscores (__) are
reserved by the PHP language.

Variable names and function names (when used in a function-call context)
need not be defined as source tokens; they can also be created at
runtime using the variable name-creation operator ([§§](10-expressions.md#variable-name-creation-operator)). (For
example, given `$a = "Total"; $b = 3; $c = $b + 5;`, `${$a.$b.$c} =true;` 
is equivalent to `$Total38 = true;`, and `${$a.$b.$c}()` is
equivalent to `Total38()`).

**Examples**

```
const MAX_VALUE = 100;
function getData() { ... }
class Point { ... }
interface ICollection { ... }
```

**Implementation Notes**

An implementation is discouraged from placing arbitrary restrictions on
name length or length of significance.

####Keywords

A *keyword* is a name-like sequence of characters that is reserved, and
cannot be used as a name.

**Syntax:**

<pre>
  <i>keyword::</i> one of
    abstract   and   as   break   callable   case   catch   class   clone   
    const   continue   declare   default   do   echo   else   elseif   
    enddeclare   endfor   endforeach   endif   endswitch   endwhile
    extends   final   finally   for   foreach   function   global
    goto   if   implements   include   include_once   instanceof
    insteadof   interface   namespace   new or   print   private
    protected   public   require   require_once   return static   switch
    throw   trait   try   use   var   while   xor   yield
</pre>

**Semantics:**

Keywords are not case-sensitive.

####Literals

#####General

The source code representation of a value is called a *literal*.

**Syntax:**

<pre>
  <i>literal::
    <i>boolean-literal</i>
    <i>integer-literal</i>
    <i>floating-literal</i>
    <i>string-literal</i>
    <i>null-literal</i>
</pre>

*boolean-literal* is defined in [§§](#boolean-literals); *integer-literal* is defined
in [§§](#integer-literals); *floating-literal* is defined in [§§](#floating-point-literals);
*string-literal* is defined in [§§](#string-literals); and *null-literal* is defined
in [§§](#the-null-literal).

#####Boolean Literals

**Syntax:**

<pre>
  <i>boolean-literal::</i>
    true (written in any case combination)
    false (written in any case combination)
</pre>

**Semantics:**

The type of a *boolean-literal* is bool. The values `true` and `false`
represent the Boolean values True and False, respectively.

**Examples**

```
$done = false;
computeValues($table, true);
```

#####Integer Literals

**Syntax:**

<pre>
  <i>integer-literal::</i>
    <i>decimal-literal</i>
    <i>octal-literal</i>
    <i>hexadecimal-literal</i>
    <i>binary-literal</i>

    <i>decimal-literal::</i>
      <i>nonzero-digit</i>
      <i>decimal-literal   digit</i>

    <i>octal-literal::</i>
      0
      <i>octal-literal   octal-digit</i>

    <i>hexadecimal-literal::</i>
      <i>hexadecimal-prefix   hexadecimal-digit</i>
      <i>hexadecimal-literal   hexadecimal-digit</i>

    <i>hexadecimal-prefix:: one of</i>
      0x  0X

    <i>binary-literal::</i>
      <i>binary-prefix   binary-digit</i>
      <i>binary-literal   binary-digit</i>

    <i>binary-prefix:: one of</i>
      0b  0B

    <i>digit:: one of</i>
      0  1  2  3  4  5  6  7  8  9

    <i>nonzero-digit:: one of</i>
      1  2  3  4  5  6  7  8  9
      
    <i>octal-digit:: one of</i>
      0  1  2  3  4  5  6  7

    <i>hexadecimal-digit:: one of</i>
      0  1  2  3  4  5  6  7  8  9
            a  b  c  d  e  f
            A  B  C  D  E  F

    <i>binary-digit:: one of</i>
        0  1
</pre>

**Semantics:**

The value of a decimal integer literal is computed using base 10; that
of an octal integer literal, base 8; that of a hexadecimal integer
literal, base 16; and that of a binary integer literal, base 2.

If the value of an *integer-literal* can be represented in type int,
that is its type; otherwise, its type is float, as described below.

Using a twos-complement system, can the smallest negative value
(-2147483648 for 32 bits and -9223372036854775808 for 64 bits) be
represented as a decimal integer literal? No. Consider the
expression -5. This is made up of two tokens: a unary minus followed by
the integer literal 5. As such, **there is no such thing as a
negative-valued decimal integer literal in PHP**. Instead, there is the
non-negative value, which is then negated. However, if the non-negative
value is too large to represent as an `int`, it becomes `float`, which is
then negated. Literals written using hexadecimal, octal, or binary
notations are considered to have non-negative values.

**Examples**

```
$count = 10      // decimal 10

0b101010 >> 4    // binary 101010 and decimal 4

0XAF << 023      // hexadecimal AF and octal 23
```

On an implementation using 32-bit int representation

```
2147483648 -> 2147483648 (too big for int, so is a float)

-2147483648 -> -2147483648 (too big for int, so is a float, negated)

-2147483647 - 1 -> -2147483648 fits in int

0x80000000 -> 2147483648 (too big for int, so is a float)
```

#####Floating-Point Literals

**Syntax:**

<pre>
  <i>ﬂoating-literal::</i>
    <i>fractional-literal   exponent-part<sub>opt</sub></i>
    <i>digit-sequence   exponent-part</i>

  <i>fractional-literal::</i>
    <i>digit-sequence<sub>opt</sub></i> . <i>digit-sequence</i>
    <i>digit-sequence</i> .

  <i>exponent-part::</i>
    e  <i>sign<sub>opt</sub>   digit-sequence</i>
    E  <i>sign<sub>opt</sub>   digit-sequence</i>

  <i>sign:: one of</i>
    +  -

  <i>digit-sequence::</i>
    <i>digit</i>
    <i>digit-sequence   digit</i>
</pre>

*digit* is defined in [§§](#integer-literals).

**Constraints**

The value of a floating-point literal must be representable by its type.

**Semantics:**

The type of a *floating-literal* is `float`.

The constants `INF` (§[[6.3](06-constants.md#core-predefined-constants)](#core-predefined-constants)) and `NAN` (§[[6.3](06-constants.md#core-predefined-constants)](#core-predefined-constants)) provide access to the 
floating-point values for infinity and Not-a-Number, respectively.

**Examples**

```
$values = array(1.23, 3e12, 543.678E-23);
```

#####String Literals

**Syntax:**

<pre>
  <i>string-literal::</i>
    <i>single-quoted-string-literal</i>
    <i>double-quoted-string-literal</i>
    <i>heredoc-string-literal</i>
    <i>nowdoc-string-literal</i>
</pre>
*single-quoted-string-literal* is defined in [§§](#integer-literals);
*double-quoted-string-literal* is defined in [§§](#integer-literals);
*heredoc-string-literal* is defined in [§§](#integer-literals); and
*nowdoc-string-literal* is defined in [§§](#integer-literals).

Note: By conventional standards, calling *heredoc-string-literal*s (§)
and *nowdoc-string-literal*s ([§§](#nowdoc-string-literals)) literals is a stretch, as
each is hardly a single token.

**Semantics:**

A string literal is a sequence of zero or more characters delimited in
some fashion. The delimiters are not part of the literal's content.

The type of a string literal is string.

######Single-Quoted String Literals

**Syntax:**

<pre>
  <i>single-quoted-string-literal::</i>
    b<i><sub>opt</sub></i>  ' <i>sq-char-sequence<sub>opt</sub></i>  '

  <i>sq-char-sequence::</i>
    <i>sq-char</i>
    <i>sq-char-sequence   sq-char</i>

  <i>sq-char::</i>
    <i>sq-escape-sequence</i>
    \<i><sub>opt</sub></i>   any member of the source character set except single-quote (') or backslash (\)

  <i>sq-escape-sequence:: one of</i>
    \'  \\
</pre>
**Semantics:**

A single-quoted string literal is a string literal delimited by
single-quotes ('). The literal can contain any source character except
single-quote (') and backslash (\\), which can only be represented by
their corresponding escape sequence.

The optional `b` prefix is reserved for future use in dealing with
so-called *binary strings*. For now, a *single-quoted-string-literal*
with a `b` prefix is equivalent to one without.

A single-quoted string literal is a c-constant ([§§](06-constants.md#general)).

**Examples**

```
'This text is taken verbatim'

'Can embed a single quote (\') and a backslash (\\) like this'
```

######Double-Quoted String Literals

**Syntax:**

<pre>
  <i>double-quoted-string-literal::</i>
    b<i><sub>opt</sub></i>  " <i>dq-char-sequence<sub>opt</sub></i>  "

  <i>dq-char-sequence::</i>
    <i>dq-char</i>
    <i>dq-char-sequence   dq-char</i>

  <i>dq-char::</i>
    <i>dq-escape-sequence</i>
    any member of the source character set except double-quote (") or backslash (\)
    \  any member of the source character set except "\$efnrtvxX or
octal-digit

  <i>dq-escape-sequence::</i>
    <i>dq-simple-escape-sequence</i>
    <i>dq-octal-escape-sequence</i>
    <i>dq-hexadecimal-escape-sequence</i>

  <i>dq-simple-escape-sequence:: one of</i>
    \"   \\   \$   \e   \f   \n   \r   \t   \v

  <i>dq-octal-escape-sequence::</i>
    \   <i>octal-digit</i>
    \   <i>octal-digit   octal-digit</i>
    \   <i>octal-digit   octal-digit   octal-digit</i>

  <i>dq-hexadecimal-escape-sequence::</i>
    \x  <i>hexadecimal-digit   hexadecimal-digit<sub>opt</sub></i>
    \X  <i>hexadecimal-digit   hexadecimal-digit<sub>opt</sub></i>
</pre>

*octal-digit* and *hexadecimal-digit* are defined in [§§](#integer-literals).

**Semantics:**

A double-quoted string literal is a string literal delimited by
double-quotes ("). The literal can contain any source character except
double-quote (") and backslash (\\), which can only be represented by
their corresponding escape sequence. Certain other (and sometimes
non-printable) characters can also be expressed as escape sequences.

The optional `b` prefix is reserved for future use in dealing with
so-called *binary strings*. For now, a *double-quoted-string-literal*
with a `b` prefix is equivalent to one without.

An escape sequence represents a single-character encoding, as described
in the table below:

Escape sequence | Character name
--------------- | --------------
\$  | Dollar sign
\"  | Double quote
\\  | Backslash
\e  | Escape
\f  | Form feed
\n  | New line
\r  | Carriage Return
\t  | Horizontal Tab
\v  | Vertical Tab
\ooo |  1–3-digit octal digit value ooo
\xhh or \Xhh  | 1–2-digit hexadecimal digit value hh

Within a double-quoted string literal, except when recognized as the
start of an escape sequence, a backslash (\\) is retained verbatim.

Within a double-quoted string literal a dollar ($) character not
escaped by a backslash (\\) is handled, as follows:

-   If that dollar ($) character plus the character sequence following
    spells a longest-possible variable name:
-   For a scalar type, that variable name is replaced by the string
    representation of that variable's value, if such a variable exists. 
    This is known as *variable substitution*. If no such variable is
    currently defined, the value substituted is the empty string. (For
    the purposes of variable substitution, the string representation is
    produced as if the library function `sprintf` was used. In the case of
    a floating-point value, the conversion specifier used is `%.nG`,
    where the precision `n` is implementation-defined.
-   For a variable that designates an array, if that variable name is
    followed by characters of the form "`[index]`" without any
    intervening white space, the variable name and these following
    characters are presumed to refer to the corresponding element of
    that array, in which case, the value of that element is substituted.
    If `index` is itself a variable having scalar type, that variable's
    value is substituted. If `index` is an integer literal, it must be a
    decimal-integer literal. `index` must not be a character sequence
    that itself looks like an array subscript or a class property.
-   For a variable that designates an array, but no subscript-like
    character sequence follows that variable name, the value substituted
    is "Array".
-   For a variable that designates an instance of a class, if that
    variable name is followed by characters of the form "`->name`"
    without any intervening white space, the variable name and these
    following characters are presumed to refer to the corresponding
    property of that instance, in which case, the value of that property
    is substituted.
-   Otherwise, the dollar ($) is retained verbatim.

Variable substitution also provides limited support for the evaluation
of expressions. This is done by enclosing an expression in a pair of
matching braces ({...}). The opening brace must be followed immediately by
a dollar ($) without any intervening white space, and that dollar must
begin a variable name. If this is not the case, braces are treated
verbatim. An opening brace ({) cannot be escaped.

A double-quoted string literal is a c-constant ([§§](06-constants.md#general)) if it does not
contain any variable substitution.

**Examples**

```
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

######Heredoc String Literals

**Syntax:**

<pre>
  <i>heredoc-string-literal::</i>
    <<<  <i>hd-start-identifier   new-line   hd-char-sequence<sub>opt</sub>  new-line hd-end-identifier</i>  ;<i><sub>opt</sub>   new-line</i>

  <i>hd-start-identifier::</i>
    <i>name</i>

  <i>hd-end-identifier::</i>
    <i>name</i>

  <i>hd-char-sequence::</i>
    <i>hd-char</i>
    <i>hd-char-sequence   hd-char</i>

  <i>hd-char::</i>
    <i>hd-escape-sequence</i>
    any member of the source character set except backslash (\)
    \  any member of the source character set except \$efnrtvxX or
octal-digit

  <i>hd-escape-sequence::</i>
    <i>hd-simple-escape-sequence</i>
    <i>dq-octal-escape-sequence</i>
    <i>dq-hexadecimal-escape-sequence</i>

  <i>hd-simple-escape-sequence:: one of</i>
    \\   \$   \e   \f   \n   \r   \t   \v
</pre>

*name* is defined in [§§](#names); *new-line* is defined in [§§](#comments); and
*dq-octal-escape-sequence* and *dq-hexadecimal-escape-sequence* are
defined in [§§](#double-quoted-string-literals).

**Constraints**

The start and end identifier must be the same. Only horizontal white
space is permitted between `<<<` and the start identifier. No white
space is permitted between the start identifier and the new-line that
follows. No white space is permitted between the new-line and the end
identifier that follows. Except for an optional semicolon (`;`), no
characters—not even comments or white space—are permitted between the
end identifier and the new-line that terminates that source line.

**Semantics:**

A heredoc string literal is a string literal delimited by
"`<<< name`" and "`name`". The literal can contain any source
character. Certain other (and sometimes non-printable) characters can
also be expressed as escape sequences.

A heredoc literal supports variable substitution as defined for
double-quoted string literals ([§§](#double-quoted-string-literals)).

A heredoc string literal is a c-constant ([§§](06-constants.md#general)) if it does not contain
any variable substitution.

**Examples**

```
$v = 123;
$s = <<<    ID
S'o'me "\"t e\txt; \$v = $v"
Some more text
ID;
echo ">$s<";
→ >S'o'me "\"t e  xt; $v = 123"
Some more text<
```

######Nowdoc String Literals

**Syntax:**

<pre>
  <i>nowdoc-string-literal::</i>
    <<<  '  <i>hd-start-identifier</i>  '  <i>new-line  hd-char-sequence<sub>opt</sub>   new-line hd-end-identifier</i>  ;<i><sub>opt</sub>   new-line</i>
</pre>

*hd-start-identifier*, *hd-char-sequence*, and *hd-end-identifier* are
defined in [§§](#heredoc-string-literals); and *new-line* is defined in [§§](#comments).

**Constraints**

No white space is permitted between the start identifier and its
enclosing single quotes ('). See also [§§](#heredoc-string-literals).

**Semantics:**

A nowdoc string literal looks like a heredoc string literal
([§§](#heredoc-string-literals)) except that in the former the start identifier name is
enclosed in single quotes ('). The two forms of string literal have the
same semantics and constraints except that a nowdoc string literal is
not subject to variable substitution.

A nowdoc string literal is a c-constant ([§§](06-constants.md#general)).

**Examples**

```
$v = 123;
$s = <<<    'ID'
S'o'me "\"t e\txt; \$v = $v"
Some more text
ID;
echo ">$s<\n\n";
→ >S'o'me "\"t e\txt; \$v = $v"
Some more text<
```

#####The Null Literal

There is one null-literal value, `null`. Its spelling is case-insensitive.
(Note: Throughout this specification, the convention is to use all
uppercase).

<pre>
  <i>null-literal::</i>
    null (written in any case combination)
</pre>

A *null-literal* has the null type.

####Operators and Punctuators

**Syntax**

<pre>
  <i>operator-or-punctuator:: one of</i>
    [   ]    (   )   {    }   .   ->   ++   --   **   *   +   -   ~   !
    $   /   % <<   >>   <   >   <=   >=   ==   ===   !=   !==   ^   |
    &   &&   ||   ?   :   ; =   **=   *=   /=   %=   +=   -=   .=   <<=
    >>=   &=   ^=   |=   ,
</pre>

**Semantics:**

Operators and punctuators are symbols that have independent syntactic
and semantic significance. *Operators* are used in expressions to
describe operations involving one or more *operands*, and that yield a
resulting value, produce a side effect, or some combination thereof.
*Punctuators* are used for grouping and separating.


