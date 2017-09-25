# Statements

## General

**Syntax**

<!-- GRAMMAR
statement:
  compound-statement
  named-label-statement
  expression-statement
  selection-statement
  iteration-statement
  jump-statement
  try-statement
  declare-statement
  echo-statement
  unset-statement
  const-declaration
  function-definition
  class-declaration
  interface-declaration
  trait-declaration
  namespace-definition
  namespace-use-declaration
  global-declaration
  function-static-declaration
-->

<pre>
<i id="grammar-statement">statement:</i>
   <i><a href="#grammar-compound-statement">compound-statement</a></i>
   <i><a href="#grammar-named-label-statement">named-label-statement</a></i>
   <i><a href="#grammar-expression-statement">expression-statement</a></i>
   <i><a href="#grammar-selection-statement">selection-statement</a></i>
   <i><a href="#grammar-iteration-statement">iteration-statement</a></i>
   <i><a href="#grammar-jump-statement">jump-statement</a></i>
   <i><a href="#grammar-try-statement">try-statement</a></i>
   <i><a href="#grammar-declare-statement">declare-statement</a></i>
   <i><a href="#grammar-echo-statement">echo-statement</a></i>
   <i><a href="#grammar-unset-statement">unset-statement</a></i>
   <i><a href="14-classes.md#grammar-const-declaration">const-declaration</a></i>
   <i><a href="13-functions.md#grammar-function-definition">function-definition</a></i>
   <i><a href="14-classes.md#grammar-class-declaration">class-declaration</a></i>
   <i><a href="15-interfaces.md#grammar-interface-declaration">interface-declaration</a></i>
   <i><a href="16-traits.md#grammar-trait-declaration">trait-declaration</a></i>
   <i><a href="18-namespaces.md#grammar-namespace-definition">namespace-definition</a></i>
   <i><a href="18-namespaces.md#grammar-namespace-use-declaration">namespace-use-declaration</a></i>
   <i><a href="07-variables.md#grammar-global-declaration">global-declaration</a></i>
   <i><a href="07-variables.md#grammar-function-static-declaration">function-static-declaration</a></i>
</pre>

## Compound Statements

**Syntax**

<!-- GRAMMAR
compound-statement:
  '{' statement-list? '}'

statement-list:
  statement
  statement-list statement
-->

<pre>
<i id="grammar-compound-statement">compound-statement:</i>
   {   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>   }

<i id="grammar-statement-list">statement-list:</i>
   <i><a href="#grammar-statement">statement</a></i>
   <i><a href="#grammar-statement-list">statement-list</a></i>   <i><a href="#grammar-statement">statement</a></i>
</pre>

**Semantics**

A *compound statement* allows a group of zero or more statements to be
treated syntactically as a single statement. A compound statement is
often referred to as a *block*.

**Examples**

```PHP
if (condition)
{ // braces are needed as the true path has more than one statement
  // statement-1
  // statement-2
}
else
{ // braces are optional as the false path has only one statement
  // statement-3
}
// -----------------------------------------
while (condition)
{ // the empty block is equivalent to a null statement
}
```

## Labeled Statements

**Syntax**

<!-- GRAMMAR
named-label-statement:
  name ':'
-->

<pre>
<i id="grammar-named-label-statement">named-label-statement:</i>
   <i><a href="09-lexical-structure.md#grammar-name">name</a></i>   :
</pre>

**Constraints**

Named labels must be unique within a function.

**Semantics**

A named label can be used as the target of a [`goto` statement](#the-goto-statement).
The presence of a label does not by itself alter the flow of execution.

## Expression Statements

**Syntax**

<!-- GRAMMAR
expression-statement:
  expression? ';'
-->

<pre>
<i id="grammar-expression-statement">expression-statement:</i>
   <i><a href="10-expressions.md#grammar-expression">expression</a></i><sub>opt</sub>   ;
</pre>

**Semantics**

If present, *expression* is evaluated for its side effects, if any, and
any resulting value is discarded. If *expression* is omitted, the
statement is a *null statement*, which has no effect on execution.

**Examples**

```PHP
$i = 10;  // $i is assigned the value 10; result (10) is discarded
++$i; // $i is incremented; result (11) is discarded
$i++; // $i is incremented; result (11) is discarded
DoIt(); // function DoIt is called; result (return value) is discarded
// -----------------------------------------
$i;   // no side effects, result is discarded. Vacuous but permitted
123;  // likewise for this one and the two statements following
34.5 * 12.6 + 11.987;
TRUE;
// -----------------------------------------
function findValue($table, $value)  // where $table is 2x3 array
{
  for ($row = 0; $row <= 1; ++$row)
  {
    for ($colm = 0; $colm <= 2; ++$colm)
    {
      if ($table[$row][$colm] == $value)
      {
        // ...
        goto done;
      }
    }
  }
  // ...
done:
  ;     // null statement needed as a label must precede a statement
}
```

## Selection Statements

### General

**Syntax**

<!-- GRAMMAR
selection-statement:
  if-statement
  switch-statement
-->

<pre>
<i id="grammar-selection-statement">selection-statement:</i>
   <i><a href="#grammar-if-statement">if-statement</a></i>
   <i><a href="#grammar-switch-statement">switch-statement</a></i>
</pre>

**Semantics**

Based on the value of a controlling expression, a selection statement
selects among a set of statements.

### The `if` Statement

**Syntax**

<!-- GRAMMAR
if-statement:
  'if' '(' expression ')' statement elseif-clauses-1? else-clause-1?
  'if' '(' expression ')' ':' statement-list elseif-clauses-2? else-clause-2? 'endif' ';'

elseif-clauses-1:
  elseif-clause-1
  elseif-clauses-1 elseif-clause-1

elseif-clause-1:
  'elseif' '(' expression ')' statement

else-clause-1:
  'else' statement

elseif-clauses-2:
  elseif-clause-2
  elseif-clauses-2 elseif-clause-2

elseif-clause-2:
  'elseif' '(' expression ')' ':' statement-list

else-clause-2:
  'else' ':' statement-list
-->

<pre>
<i id="grammar-if-statement">if-statement:</i>
   if   (   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   )   <i><a href="#grammar-statement">statement</a></i>   <i><a href="#grammar-elseif-clauses-1">elseif-clauses-1</a></i><sub>opt</sub>   <i><a href="#grammar-else-clause-1">else-clause-1</a></i><sub>opt</sub>
   if   (   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   <i><a href="#grammar-elseif-clauses-2">elseif-clauses-2</a></i><sub>opt</sub>   <i><a href="#grammar-else-clause-2">else-clause-2</a></i><sub>opt</sub>   endif   ;

<i id="grammar-elseif-clauses-1">elseif-clauses-1:</i>
   <i><a href="#grammar-elseif-clause-1">elseif-clause-1</a></i>
   <i><a href="#grammar-elseif-clauses-1">elseif-clauses-1</a></i>   <i><a href="#grammar-elseif-clause-1">elseif-clause-1</a></i>

<i id="grammar-elseif-clause-1">elseif-clause-1:</i>
   elseif   (   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   )   <i><a href="#grammar-statement">statement</a></i>

<i id="grammar-else-clause-1">else-clause-1:</i>
   else   <i><a href="#grammar-statement">statement</a></i>

<i id="grammar-elseif-clauses-2">elseif-clauses-2:</i>
   <i><a href="#grammar-elseif-clause-2">elseif-clause-2</a></i>
   <i><a href="#grammar-elseif-clauses-2">elseif-clauses-2</a></i>   <i><a href="#grammar-elseif-clause-2">elseif-clause-2</a></i>

<i id="grammar-elseif-clause-2">elseif-clause-2:</i>
   elseif   (   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>

<i id="grammar-else-clause-2">else-clause-2:</i>
   else   :   <i><a href="#grammar-statement-list">statement-list</a></i>
</pre>

**Semantics**

The two forms of the `if` statement are equivalent; they simply provide
alternate styles.

The result of the controlling expression *expression* will be [converted to type `bool`](08-conversions.md#converting-to-boolean-type)
if it does not have this type.

If *expression* is `TRUE`, the *statement* that follows immediately is
executed. Otherwise, if an `elseif` clause is present its *expression* is evaluated
in turn, and if it is `TRUE`, the *statement* immediately following the `elseif` is executed.
This repeats for every `elseif` clause in turn. If none of those tests `TRUE`, if an
`else` clause is present the *statement* immediately following the `else` is
executed.

An `else` clause is associated with the lexically nearest preceding `if` or
`elseif` that is permitted by the syntax.

**Examples**
```PHP
if ($count > 0)
{
  ...
  ...
  ...
}
// -----------------------------------------
goto label1;
echo "Unreachable code\n";

if ($a)
{
label1:
  ...
}
else
{
  ...
}
// -----------------------------------------
if (1)
  ...
  if (0)
    ...
else  // this else does NOT go with the outer if
  ...

if (1)
{
  ...
  if (0)
    ...
}
else  // this else does go with the outer if
    ...
```

### The `switch` Statement

**Syntax**

<!-- GRAMMAR
switch-statement:
  'switch' '(' expression ')' '{' case-statements? '}'
  'switch' '(' expression ')' ':' case-statements? 'endswitch;'

case-statements:
  case-statement case-statements?
  default-statement case-statements?

case-statement:
  'case' expression case-default-label-terminator statement-list?

default-statement:
  'default' case-default-label-terminator statement-list?

case-default-label-terminator:
  ':'
  ';'
-->

<pre>
<i id="grammar-switch-statement">switch-statement:</i>
   switch   (   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   )   {   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>   }
   switch   (   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>   endswitch;

<i id="grammar-case-statements">case-statements:</i>
   <i><a href="#grammar-case-statement">case-statement</a></i>   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>
   <i><a href="#grammar-default-statement">default-statement</a></i>   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>

<i id="grammar-case-statement">case-statement:</i>
   case   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   <i><a href="#grammar-case-default-label-terminator">case-default-label-terminator</a></i>   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>

<i id="grammar-default-statement">default-statement:</i>
   default   <i><a href="#grammar-case-default-label-terminator">case-default-label-terminator</a></i>   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>

<i id="grammar-case-default-label-terminator">case-default-label-terminator:</i>
   :
   ;
</pre>

**Constraints**

There must be at most one default label.

**Semantics**

The two forms of the `switch` statement are equivalent; they simply
provide alternate styles.

Based on the value of its *expression*, a `switch` statement transfers
control to a [case label](#labeled-statements), to a [default label](#labeled-statements), if one
exists; or to the statement immediately following the end of the `switch`
statement. A case or default label is only reachable directly within its
closest enclosing `switch` statement.

On entry to the `switch` statement, the controlling expression is
evaluated and then compared with the value of the case label *expression*
values, in lexical order, using the same semantics as `==`.
If one matches, control transfers to the
statement following the corresponding case label. If there is no match,
then if there is a default label, control transfers to the statement
following that; otherwise, control transfers to the statement
immediately following the end of the `switch` statement. If a `switch`
contains more than one case label whose values compare equal to the
controlling expression, the first in lexical order is considered the
match.

An arbitrary number of statements can be associated with any case or
default label. In the absence of a [`break` statement](#the-break-statement) at the end
of a set of such statements, the execution continues into any following
statements, ignoring the associated labels. If all cases and the default end in `break`
and there are no duplicate-valued case labels, the order of case and
default labels is insignificant.

Case-label values can be runtime expressions, and the types of sibling
case-label values need not be the same.

Switches may be nested, in which case, each `switch` has its own set of
`switch` clauses.

**Examples**

```PHP
$v = 10;
switch ($v)
{
default:
  echo "default case: \$v is $v\n";
  break;    // break ends "group" of default statements
case 20:
  echo "case 20\n";
  break;    // break ends "group" of case 20 statements
case 10:
  echo "case 10\n"; // no break, so execution continues to the next label's "group"
case 30:
  echo "case 30\n"; // no break, but then none is really needed either
}
// -----------------------------------------
$v = 30;
switch ($v)
{
case 30.0:  // <===== this case matches with 30
  echo "case 30.0\n";
  break;
default:
  echo "default case: \$v is $v\n";
  break;
case 30:    // <===== rather than this case matching with 30
  echo "case 30\n";
  break;
}
// -----------------------------------------
switch ($v)
{
case 10 + $b: // non-constant expression
  // ...
case $v < $a:   // non-constant expression
  // ...
// ...
}
```

## Iteration Statements

### General

**Syntax**

<!-- GRAMMAR
iteration-statement:
  while-statement
  do-statement
  for-statement
  foreach-statement
-->

<pre>
<i id="grammar-iteration-statement">iteration-statement:</i>
   <i><a href="#grammar-while-statement">while-statement</a></i>
   <i><a href="#grammar-do-statement">do-statement</a></i>
   <i><a href="#grammar-for-statement">for-statement</a></i>
   <i><a href="#grammar-foreach-statement">foreach-statement</a></i>
</pre>

## The `while` Statement

**Syntax**

<!-- GRAMMAR
while-statement:
  'while' '(' expression ')' statement
  'while' '(' expression ')' ':' statement-list 'endwhile' ';'
-->

<pre>
<i id="grammar-while-statement">while-statement:</i>
   while   (   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   )   <i><a href="#grammar-statement">statement</a></i>
   while   (   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   endwhile   ;
</pre>

**Semantics**

The two forms of the `while` statement are equivalent; they simply provide
alternate styles.

The result of the controlling expression *expression* is [converted to type `bool`](08-conversions.md#converting-to-boolean-type)
if it does not have this type.

If *expression* tests `TRUE`, the *statement* that follows immediately is
executed, and the process is repeated. If *expression* tests `FALSE`,
control transfers to the point immediately following the end of the
`while` statement. The loop body is executed zero or more
times.

**Examples**

```PHP
$i = 1;
while ($i <= 10):
  echo "$i\t".($i * $i)."\n"; // output a table of squares
  ++$i;
endwhile;
// -----------------------------------------
while (TRUE)
{
  // ...
  if ($done)
    break;  // break out of the while loop
  // ...
}
```

## The `do` Statement

**Syntax**

<!-- GRAMMAR
do-statement:
  'do' statement 'while' '(' expression ')' ';'
-->

<pre>
<i id="grammar-do-statement">do-statement:</i>
   do   <i><a href="#grammar-statement">statement</a></i>   while   (   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   )   ;
</pre>

(Note: There is no alternate syntax).

**Constraints**

The controlling expression *expression* must have type `bool` or be
implicitly convertible to that type.

**Semantics**

First, *statement* is executed and then *expression* is evaluated.

The result of the controlling expression *expression* is [converted to type `bool`](08-conversions.md#converting-to-boolean-type)
if it does not have this type.

If the value tests `TRUE`, the process is repeated. If *expression* tests `FALSE`,
control transfers to the point immediately following the end of the `do`
statement. The loop body, *statement*, is executed one or more times.

**Examples**

```PHP
$i = 1;
do
{
  echo "$i\t".($i * $i)."\n"; // output a table of squares
  ++$i;
}
while ($i <= 10);
```

## The `for` Statement

**Syntax**

<!-- GRAMMAR
for-statement:
  'for' '(' for-initializer? ';' for-control? ';' for-end-of-loop? ')' statement
  'for' '(' for-initializer? ';' for-control? ';' for-end-of-loop? ')' ':' statement-list 'endfor' ';'

for-initializer:
  for-expression-group

for-control:
  for-expression-group

for-end-of-loop:
  for-expression-group

for-expression-group:
  expression
  for-expression-group ',' expression
-->

<pre>
<i id="grammar-for-statement">for-statement:</i>
   for   (   <i><a href="#grammar-for-initializer">for-initializer</a></i><sub>opt</sub>   ;   <i><a href="#grammar-for-control">for-control</a></i><sub>opt</sub>   ;   <i><a href="#grammar-for-end-of-loop">for-end-of-loop</a></i><sub>opt</sub>   )   <i><a href="#grammar-statement">statement</a></i>
   for   (   <i><a href="#grammar-for-initializer">for-initializer</a></i><sub>opt</sub>   ;   <i><a href="#grammar-for-control">for-control</a></i><sub>opt</sub>   ;   <i><a href="#grammar-for-end-of-loop">for-end-of-loop</a></i><sub>opt</sub>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   endfor   ;

<i id="grammar-for-initializer">for-initializer:</i>
   <i><a href="#grammar-for-expression-group">for-expression-group</a></i>

<i id="grammar-for-control">for-control:</i>
   <i><a href="#grammar-for-expression-group">for-expression-group</a></i>

<i id="grammar-for-end-of-loop">for-end-of-loop:</i>
   <i><a href="#grammar-for-expression-group">for-expression-group</a></i>

<i id="grammar-for-expression-group">for-expression-group:</i>
   <i><a href="10-expressions.md#grammar-expression">expression</a></i>
   <i><a href="#grammar-for-expression-group">for-expression-group</a></i>   ,   <i><a href="10-expressions.md#grammar-expression">expression</a></i>
</pre>

Note: Unlike C/C++, PHP does not support a comma operator, per se.
However, the syntax for the `for` statement has been extended from that of
C/C++ to achieve the same results in this context.

**Semantics**

The two forms of the `for` statement are equivalent; they simply provide
alternate styles.

The group of expressions in *for-initializer* is evaluated once,
left-to-right, for their side effects. Then the group of expressions in
*for-control* is evaluated left-to-right (with all but the right-most
one for their side effects only), with the right-most expression's value
being [converted to type `bool`](08-conversions.md#converting-to-boolean-type).
If the result is `TRUE`, *statement* is executed, and the group
of expressions in *for-end-of-loop* is evaluated left-to-right, for
their side effects only. Then the process is repeated starting with
*for-control*. Once the right-most expression in *for-control* is
`FALSE`, control transfers to the point immediately following the end of
the `for` statement. The loop body, *statement*, is executed zero or more
times.

If *for-initializer* is omitted, no action is taken at the start of the
loop processing. If *for-control* is omitted, this is treated as if
*for-control* was an expression with the value `TRUE`. If
*for-end-of-loop* is omitted, no action is taken at the end of each
iteration.

**Examples**

```PHP
for ($i = 1; $i <= 10; ++$i)
{
  echo "$i\t".($i * $i)."\n"; // output a table of squares
}
// -----------------------------------------
// omit 1st and 3rd expressions

$i = 1;
for (; $i <= 10;):
  echo "$i\t".($i * $i)."\n"; // output a table of squares
  ++$i;
endfor;
// -----------------------------------------
// omit all 3 expressions

$i = 1;
for (;;)
{
  if ($i > 10)
    break;
  echo "$i\t".($i * $i)."\n"; // output a table of squares
  ++$i;
}
// -----------------------------------------
//  use groups of expressions

for ($a = 100, $i = 1; ++$i, $i <= 10; ++$i, $a -= 10)
{
  echo "$i\t$a\n";
}
```

## The `foreach` Statement

**Syntax**

<!-- GRAMMAR
foreach-statement:
  'foreach' '(' foreach-collection-name 'as' foreach-key? foreach-value ')' 'statement'
  'foreach' '(' foreach-collection-name 'as' foreach-key? foreach-value ')' ':' statement-list 'endforeach' ';'

foreach-collection-name:
  expression

foreach-key:
  expression '=>'

foreach-value:
  '&'? expression
  list-intrinsic
-->

<pre>
<i id="grammar-foreach-statement">foreach-statement:</i>
   foreach   (   <i><a href="#grammar-foreach-collection-name">foreach-collection-name</a></i>   as   <i><a href="#grammar-foreach-key">foreach-key</a></i><sub>opt</sub>   <i><a href="#grammar-foreach-value">foreach-value</a></i>   )   statement
   foreach   (   <i><a href="#grammar-foreach-collection-name">foreach-collection-name</a></i>   as   <i><a href="#grammar-foreach-key">foreach-key</a></i><sub>opt</sub>   <i><a href="#grammar-foreach-value">foreach-value</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   endforeach   ;

<i id="grammar-foreach-collection-name">foreach-collection-name:</i>
   <i><a href="10-expressions.md#grammar-expression">expression</a></i>

<i id="grammar-foreach-key">foreach-key:</i>
   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   =&gt;

<i id="grammar-foreach-value">foreach-value:</i>
   &amp;<sub>opt</sub>   <i><a href="10-expressions.md#grammar-expression">expression</a></i>
   <i><a href="10-expressions.md#grammar-list-intrinsic">list-intrinsic</a></i>
</pre>

**Constraints**

The result of the expression *foreach-collection-name* must be a
collection, i.e. either array or object implementing [Traversable](http://php.net/Traversable).

*expression* in *foreach-value* and *foreach-key* should designate a variable.

**Semantics**

The two forms of the `foreach` statement are equivalent; they simply
provide alternate styles.

The *foreach* statement iterates over the set of elements in the
collection designated by *foreach-collection-name*, starting at the
beginning, executing *statement* each iteration. On each iteration, if
the `&` is present in *foreach-value*, the variable designated by the
corresponding *expression* is made an alias to the current element. If
the `&` is omitted, the value of the current element is assigned to the
corresponding variable. The loop body, *statement*, is executed zero or
more times. After the loop terminates, the variable designated by *expression*
in *foreach-value* has the same value as it had after the final iteration, if any.

If *foreach-key* is present, the variable designated by its *expression*
is assigned the current element's key value.

In the *list-intrinsic* case, a value that is an array is split into
individual elements.

**Examples**

```PHP
$colors = array("red", "white", "blue");
foreach ($colors as $color):
    // ...
endforeach;
// -----------------------------------------
foreach ($colors as $key => $color)
{
    // ...
}
// -----------------------------------------
// Modify the local copy of an element's value

foreach ($colors as $color)
{
  $color = "black";
}
// -----------------------------------------
// Modify the the actual element itself

foreach ($colors as &$color)  // note the &
{
  $color = "black";
}
```

## Jump Statements

### General

**Syntax**

<!-- GRAMMAR
jump-statement:
  goto-statement
  continue-statement
  break-statement
  return-statement
  throw-statement
-->

<pre>
<i id="grammar-jump-statement">jump-statement:</i>
   <i><a href="#grammar-goto-statement">goto-statement</a></i>
   <i><a href="#grammar-continue-statement">continue-statement</a></i>
   <i><a href="#grammar-break-statement">break-statement</a></i>
   <i><a href="#grammar-return-statement">return-statement</a></i>
   <i><a href="#grammar-throw-statement">throw-statement</a></i>
</pre>

### The `goto` Statement

**Syntax**

<!-- GRAMMAR
goto-statement:
  'goto' name ';'
-->

<pre>
<i id="grammar-goto-statement">goto-statement:</i>
   goto   <i><a href="09-lexical-structure.md#grammar-name">name</a></i>   ;
</pre>

**Constraints**

The name in a `goto` statement must be that of a [named label](#labeled-statements) located
somewhere in the current script. Control must not be transferred into or
out of a function, or into an [iteration statement](#iteration-statements) or a [`switch`
statement](#the-switch-statement).

A `goto` statement must not attempt to transfer control out of a
[finally-block](#the-try-statement).

**Semantics**

A `goto` statement transfers control unconditionally to the [named label](#labeled-statements).

A `goto` statement may break out of a construct that is fully contained
within a [finally-block](#the-try-statement).

**Examples**

```PHP
function findValue($table, $v)  // where $table is 2x3 array
{
  for ($row = 0; $row <= 1; ++$row)
  {
    for ($colm = 0; $colm <= 2; ++$colm)
    {
      if ($table[$row][$colm] == $v)
      {
        echo "$v was found at row $row, column $colm\n";
        goto done; // not quite the same as break 2!
      }
    }
  }
  echo "$v was not found\n";
done:
  ; // note that a label must always precede a statement
}
```

### The `continue` Statement

**Syntax**

<!-- GRAMMAR
continue-statement:
  'continue' breakout-level? ';'

breakout-level:
  integer-literal
  ( integer-literal )
-->

<pre>
<i id="grammar-continue-statement">continue-statement:</i>
   continue   <i><a href="#grammar-breakout-level">breakout-level</a></i><sub>opt</sub>   ;

<i id="grammar-breakout-level">breakout-level:</i>
   <i><a href="09-lexical-structure.md#grammar-integer-literal">integer-literal</a></i>
   (   <i><a href="09-lexical-structure.md#grammar-integer-literal">integer-literal</a></i>   )
</pre>

**Constraints**

The breakout level must be greater than zero, and it must not exceed the level of
actual enclosing iteration and/or `switch` statements.

A `continue` statement must not attempt to break out of a [finally-block](#the-try-statement).

**Semantics**

A `continue` statement terminates the execution of the innermost enclosing
[iteration](#iteration-statements) or [`switch`](#the-switch-statement) statement.
*breakout-level* specifies which of these statements is targeted, with innermost being assigned
number `1` and containing statements having levels increasing by 1.

A `continue` statement terminates the execution of one or more enclosing
[iteration](#iteration-statements) or [`switch`](#the-switch-statement) statements,
up to the specified level. If the statement at the *breakout-level* is an iteration statement,
the next iteration (if any) of the next innermost enclosing iteration or switch statement is started.
If that statement is a `for` statement and it has a *for-end-of-loop*, its
end-of-loop expression group for the current iteration is evaluated first. If
*breakout-level* is omitted, a level of 1 is assumed.

A `continue` statement may break out of a construct that is fully
contained within a finally-block.

**Examples**

```PHP
for ($i = 1; $i <= 5; ++$i)
{
  if (($i % 2) == 0)
    continue;
  echo "$i is odd\n";
}
```

### The `break` Statement

**Syntax**

<!-- GRAMMAR
break-statement:
  'break' breakout-level? ';'
-->

<pre>
<i id="grammar-break-statement">break-statement:</i>
   break   <i><a href="#grammar-breakout-level">breakout-level</a></i><sub>opt</sub>   ;
</pre>

**Constraints**

The breakout level must be greater than zero, and it must not exceed the level of
actual enclosing iteration and/or `switch` statements.

A `break` statement must not attempt to break out of a [finally-block](#the-try-statement).

**Semantics**

A `break` statement terminates the execution of one or more enclosing
[iteration](#iteration-statements) or []`switch`](#the-switch-statement) statements. The number of levels
broken out is specified by *breakout-level*. If *breakout-level* is
omitted, a level of 1 is assumed.

A `break` statement may break out of a construct that is fully contained
within a finally-block.

**Examples**

```PHP
$i = 1;
for (;;)
{
  if ($i > 10)
    break;
  // ...
  ++$i;
}
// -----------------------------------------
for ($row = 0; $row <= 1; ++$row)
{
  for ($colm = 0; $colm <= 2; ++$colm)
  {
    if (some-condition-set)
    {
      break 2;
    }
    // ...
  }
}
// -----------------------------------------
for ($i = 10; $i <= 40; $i +=10)
{
        switch($i)
        {
        case 10: /* ... */; break;    // breaks to the end of the switch
        case 20: /* ... */; break 2;  // breaks to the end of the for
        case 30: /* ... */; break;    // breaks to the end of the switch
        }
}
```

### The `return` Statement

**Syntax**

<!-- GRAMMAR
return-statement:
  'return' expression? ';'
-->

<pre>
<i id="grammar-return-statement">return-statement:</i>
   return   <i><a href="10-expressions.md#grammar-expression">expression</a></i><sub>opt</sub>   ;
</pre>

**Semantics**

A `return` statement from within a function terminates the execution of
that function normally, and depending on how the [function was defined](13-functions.md#function-calls),
it returns the value of *expression* to the function's caller
by value or byRef. If *expression* is omitted the value `NULL` is used.

If execution flows into the closing brace (`}`) of a function, `return
NULL;` is implied.

Explicit `return` statements with *expression* given are not permitted within a
function with a `void` [return type](13-functions.md#return-typing) and cause
a fatal error.

A function may have any number of `return` statements, whose returned
values may have different types.

If an undefined variable is returned byRef, that variable becomes
defined, with a value of `NULL`.

A `return` statement is permitted in a [try-block](#the-try-statement)
and a [catch-block](#the-try-statement) and in [finally-block](#the-try-statement).

Using a `return` statement inside a finally-block will override any other
`return` statement or thrown exception from the try-block and all its
catch-blocks. Code execution in the parent stack will continue as if
the exception was never thrown.

If an uncaught exception exists when a finally-block is executed, if
that finally-block executes a `return` statement, the uncaught exception
is discarded.

A `return` statement may occur in a script outside any function. In an
[included file](10-expressions.md#script-inclusion-operators),
such statement terminates processing of that script file and
returns control to the including file. If *expression* is present, that
is the value returned; otherwise, the value `NULL` is returned. If
execution flows to the end of the script, `return 1;` is implied. However,
if execution flows to the end of the top level of a script, `return 0;` is
implied. Likewise, if *expression* is omitted at the top level. (See also
[`exit`](10-expressions.md#exitdie)).

Returning from a constructor or destructor behaves just like returning
from a function.

A `return` statement inside a [generator function](10-expressions.md#yield-operator) causes the generator to
terminate.

A generator function can contain a statement of the form `return` *expression* `;`. The value this returns
can be fetched using the method `Generator::getReturn`, which can only be called once the generator
has finishing yielding values. The value cannot be returned byRef.

Return statements can also be used in the body of anonymous functions.

`return` also terminates the execution of source code given to the intrinsic
[`eval`](10-expressions.md#eval).

**Examples**

```PHP
function f() { return 100; }  // f explicitly returns a value
function g() { return; }   // g explicitly returns an implicit NULL
function h() { }      // h implicitly returns NULL
// -----------------------------------------
// j returns one of three dissimilarly-typed values
function j($x)
{
  if ($x > 0)
  {
    return "Positive";
  }
  else if ($x < 0)
  {
    return -1;
  }
  // for zero, implied return NULL
}
function &compute() { ...; return $value; } // returns $value byRef
// -----------------------------------------
class Point
{
  private static $pointCount = 0;
  public static function getPointCount()
  {
    return self::$pointCount;
  }
  ...
}
```

**Implementation Notes**

Although *expression* is a [full expression](10-expressions.md#general), and there is a
[sequence point](10-expressions.md#general) at the end of that expression,
a side effect need not be executed if it can be determined that
no other program code relies on its having happened. (For example, in
the cases of `return $a++;` and `return ++$a;`, it is obvious what value
must be returned in each case, but if `$a` is a variable local to the
enclosing function, `$a` need not actually be incremented.

### The `throw` Statement

**Syntax**

<!-- GRAMMAR
throw-statement:
  'throw' expression ';'
-->

<pre>
<i id="grammar-throw-statement">throw-statement:</i>
   throw   <i><a href="10-expressions.md#grammar-expression">expression</a></i>   ;
</pre>

**Constraints**

The type of *expression* must be [Exception](17-exception-handling.md#class-exception) or a subclass of that
class.

*expression* must be such that an alias to it can be created.

**Semantics**

A `throw` statement throws an exception immediately and unconditionally.
Control never reaches the statement immediately following the throw. See
[exception handling](17-exception-handling.md#general) and [try-statement](#the-try-statement)
for more details of throwing and catching exceptions, and how uncaught exceptions are dealt with.

Rather than handle an exception, a catch-block may (re-)throw the same
exception that it caught, or it can throw an exception of a different
type.

**Examples**

```PHP
throw new Exception;
throw new Exception("Some message", 123);
class MyException extends Exception { ... }
throw new MyException;
```

## The `try` Statement

**Syntax**

<!-- GRAMMAR
try-statement:
  'try' compound-statement catch-clauses
  'try' compound-statement finally-clause
  'try' compound-statement catch-clauses finally-clause

catch-clauses:
  catch-clause
  catch-clauses catch-clause

catch-clause:
  'catch' '(' qualified-name variable-name ')' compound-statement

finally-clause:
  'finally' compound-statement
-->

<pre>
<i id="grammar-try-statement">try-statement:</i>
   try   <i><a href="#grammar-compound-statement">compound-statement</a></i>   <i><a href="#grammar-catch-clauses">catch-clauses</a></i>
   try   <i><a href="#grammar-compound-statement">compound-statement</a></i>   <i><a href="#grammar-finally-clause">finally-clause</a></i>
   try   <i><a href="#grammar-compound-statement">compound-statement</a></i>   <i><a href="#grammar-catch-clauses">catch-clauses</a></i>   <i><a href="#grammar-finally-clause">finally-clause</a></i>

<i id="grammar-catch-clauses">catch-clauses:</i>
   <i><a href="#grammar-catch-clause">catch-clause</a></i>
   <i><a href="#grammar-catch-clauses">catch-clauses</a></i>   <i><a href="#grammar-catch-clause">catch-clause</a></i>

<i id="grammar-catch-clause">catch-clause:</i>
   catch   (   <i><a href="09-lexical-structure.md#grammar-qualified-name">qualified-name</a></i>   <i><a href="09-lexical-structure.md#grammar-variable-name">variable-name</a></i>   )   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<i id="grammar-finally-clause">finally-clause:</i>
   finally   <i><a href="#grammar-compound-statement">compound-statement</a></i>
</pre>

**Constraints**

In a *catch-clause*, *parameter-declaration-list* must contain only one
parameter, and its type must be [`Exception`](17-exception-handling.md#class-exception) or a type derived from
that class, and that parameter must not be passed byRef.

**Semantics**

In a *catch-clause*, *variable-name* designates an *exception variable*
passed in by value. This variable corresponds to a local variable with a
scope that extends over the catch-block. During execution of the
catch-block, the exception variable represents the exception currently
being handled.

Once an exception is thrown, the Engine searches for the nearest
catch-block that can handle the exception. The process begins at the
current function level with a search for a try-block that lexically
encloses the throw point. All catch-blocks associated with that
try-block are considered in lexical order. If no catch-block is found
that can handle the run-time type of the exception, the function that
called the current function is searched for a lexically enclosing
try-block that encloses the call to the current function. This process
continues until a catch-block is found that can handle the current
exception.

The matching is done by considering the class specified by *qualified-name*
and comparing it to the type of the exception. If the exception is an
[instance of](10-expressions.md#instanceof-operator) this class then the clause matches.

If a matching catch-block is located, the Engine prepares to transfer
control to the first statement of that catch-block. However, before
execution of that catch-block can start, the Engine first executes, in
order, any finally-blocks associated with try-blocks nested more deeply
than the one that caught the exception.

If no matching catch-block is found, the exception is uncaught and the behavior is
implementation-defined.

**Examples**

```PHP
function getTextLines($filename)
{
  $infile = fopen($filename, 'r');
  if ($infile == FALSE) { /* deal with an file-open failure */ }
  try
  {
    while ($textLine = fgets($infile))  // while not EOF
    {
      yield $textLine;  // leave line terminator attached
    }
  }
  finally
  {
    fclose($infile);
  }
}
// -----------------------------------------
class DeviceException extends Exception { ... }
class DiskException extends DeviceException { ... }
class RemovableDiskException extends DiskException { ... }
class FloppyDiskException extends RemovableDiskException { ... }

try
{
  process(); // call a function that might generate a disk-related exception
}
catch (FloppyDiskException $fde) { ... }
catch (RemovableDiskException $rde) { ... }
catch (DiskException $de) { ... }
catch (DeviceException $dve) { ... }
finally { ... }
```

## The `declare` Statement

**Syntax**

<!-- GRAMMAR
declare-statement:
  'declare' '(' declare-directive ')' statement
  'declare' '(' declare-directive ')' ':' statement-list 'enddeclare' ';'
  'declare' '(' declare-directive ')' ';'

declare-directive:
  'ticks' '=' literal
  'encoding' '=' literal
  'strict_types' '=' literal
-->

<pre>
<i id="grammar-declare-statement">declare-statement:</i>
   declare   (   <i><a href="#grammar-declare-directive">declare-directive</a></i>   )   <i><a href="#grammar-statement">statement</a></i>
   declare   (   <i><a href="#grammar-declare-directive">declare-directive</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   enddeclare   ;
   declare   (   <i><a href="#grammar-declare-directive">declare-directive</a></i>   )   ;

<i id="grammar-declare-directive">declare-directive:</i>
   ticks   =   <i><a href="10-expressions.md#grammar-literal">literal</a></i>
   encoding   =   <i><a href="10-expressions.md#grammar-literal">literal</a></i>
   strict_types   =   <i><a href="10-expressions.md#grammar-literal">literal</a></i>
</pre>

**Constraints**

The literal for *ticks* must designate a value that is, or can be converted, to an
integer having a non-negative value.

The literal for *encoding* must designate a string whose value names an
8-bit-[character
encoding](http://en.wikipedia.org/wiki/Character_encoding).

Except for white space, a *declare-statement* in a script that specifies
*character-encoding* must be the first thing in that script.

The literal for *strict_types* should be either `0` or `1`. Only the statement-less
form can be used for *strict_types* declare. The *strict_types* declare should be the first statement
in the script, excepting other declare statements.

**Semantics**

The first two forms of the `declare` statement are equivalent; they simply
provide alternate styles.

The `declare` statement sets an *execution directive* for its *statement*
body, or for the `;`-form, for the remainder of the script or until the
statement is overridden by another *declare-statement*, whichever comes
first.

*ticks*: as the parser is executing, certain statements are considered
*tickable*. For every *tick-count* ticks, an event occurs, which can be
serviced by the function previously registered by the library function
[`register_tick_function`](http://php.net/manual/function.register-tick-function.php).
Tick event monitoring can be disabled by calling the library function
[`unregister_tick_function`](http://php.net/manual/function.unregister-tick-function.php).
This facility allows a profiling mechanism to be developed.

*encoding*: character encoding can be specified on a script-by-script basis using
the encoding directive. The joint ISO and IEC standard [ISO/IEC
8859 standard series](http://en.wikipedia.org/wiki/ISO/IEC_8859)
specifies a number of 8-bit-[character
encodings](http://en.wikipedia.org/wiki/Character_encoding) whose names
can be used with this directive.
This directive applies only to the file it appears in, and does not affect the included files.

*strict_types*: if set to `1`, scalar type checking for function calls will be
checked using [strict mode](13-functions.md#type-check-modes). If set to `0`, the coercive mode (default) is used.
This directive applies only to the file it appears in, and does not affect the included files.

**Examples**

```PHP
declare(ticks = 1) { ... }
declare(encoding = 'ISO-8859-1'); // Latin-1 Western European
declare(encoding = 'ISO-8859-5'); // Latin/Cyrillic
```

## The `echo` statement

**Syntax**

<!-- GRAMMAR
echo-statement:
  'echo' expression-list ';'

expression-list:
  expression
  expression-list ',' expression
-->

<pre>
<i id="grammar-echo-statement">echo-statement:</i>
   echo   <i><a href="#grammar-expression-list">expression-list</a></i>   ;

<i id="grammar-expression-list">expression-list:</i>
   <i><a href="10-expressions.md#grammar-expression">expression</a></i>
   <i><a href="#grammar-expression-list">expression-list</a></i>   ,   <i><a href="10-expressions.md#grammar-expression">expression</a></i>
</pre>

**Constraints**

The *expression* value must be
[convertable to a string](08-conversions.md#converting-to-string-type).
In particular, it should not be an array and if it is an object, it must implement
a [`__toString` method](14-classes.md#method-__tostring).

**Semantics**

After converting each of its *expression*s' values to strings, if
necessary, `echo` concatenates them in order given, and writes the
resulting string to [`STDOUT`](06-constants.md#core-predefined-constants). Unlike [`print`](10-expressions.md#print), it does
not produce a result.

See also: [double quoted strings](09-lexical-structure.md#double-quoted-string-literals) and
[heredoc documents](09-lexical-structure.md#heredoc-string-literals), [conversion to string](08-conversions.md#converting-to-string-type).

**Examples**

```PHP
$v1 = TRUE;
$v2 = 123;
echo  '>>' . $v1 . '|' . $v2 . "<<\n";    // outputs ">>1|123<<"
echo  '>>' , $v1 , '|' , $v2 , "<<\n";    // outputs ">>1|123<<"
echo ('>>' . $v1 . '|' . $v2 . "<<\n");   // outputs ">>1|123<<"
$v3 = "qqq{$v2}zzz";
echo "$v3\n";
```

## The `unset` statement

**Syntax**

<!-- GRAMMAR
unset-statement:
  'unset' '(' variable-list ')' ';'
-->

<pre>
<i id="grammar-unset-statement">unset-statement:</i>
   unset   (   <i><a href="10-expressions.md#grammar-variable-list">variable-list</a></i>   )   ;
</pre>

**Semantics**

This statement [unsets](07-variables.md#general) the variables designated by each
*variable* in *variable-list*. No value is returned. An
attempt to unset a non-existent variable (such as a non-existent element
in an array) is ignored.

When called from inside a function, this statement behaves, as follows:

-   For a variable declared `global` in that function, `unset` removes the
    alias to that variable from the scope of the current call to that
    function. The global variable remains set.
    (To unset the global variable, use unset on the corresponding
    [`$GLOBALS`](07-variables.md#predefined-variables) array entry.
-   For a variable passed byRef to that function, `unset` removes the
    alias to that variable from the scope of the current call to that
    function. Once the function returns, the passed-in argument variable
    is still set.
-   For a variable declared static in that function, `unset` removes the
    alias to that variable from the scope of the current call to that
    function. In subsequent calls to that function, the static variable
    is still set and retains its value from call to call.

Any visible instance property may be unset, in which case, the property
is removed from that instance.

If this statement is used with an expression that designates a [dynamic
property](14-classes.md#dynamic-members), then if the class of that property has an [`__unset`
method](14-classes.md#method-__unset), that method is called.

**Examples**

```PHP
unset($v);
unset($v1, $v2, $v3);
unset($x->m); // if m is a dynamic property, $x->__unset("m") is called
```
