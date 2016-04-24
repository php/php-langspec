#Variables

##General

A *variable* is a named area of data storage that contains a PHP value. A variable is represented by a [VSlot](04-basic-concepts.md#general). A variable is created by [assigning a value](04-basic-concepts.md#assignment) to it.
A variable is destroyed by *unsetting* it, either by an explicit call to the intrinsic [`unset`](10-expressions.md#unset), or by the Engine. The intrinsic [`isset`](10-expressions.md#isset) tests if a given variable exists and is not set to `NULL`. A variable that somehow becomes defined, but is not initialized starts out with the value `NULL`.

Variables have [names](09-lexical-structure.md#names). Distinct variables may have
the same name provided they are in different [scopes](04-basic-concepts.md#scope).

A [constant](06-constants.md#general) is a variable that, once initialized, its value cannot
be changed.

Based on the context in which it is declared, a variable has a [scope](04-basic-concepts.md#scope) and a [storage duration](04-basic-concepts.md#storage-duration).

A *superglobal* variable is a global variable that is accessible in all scopes without
the need for a [*global-declaration*](#global-variables).

The following kinds of variable may exist in a script:

-   [Constant](#constants).
-   [Local variable](#local-variables).
-   [Array element](#array-elements).
-   [Function static](#function-statics).
-   [Global variable](#global-variables).
-   [Instance property](#instance-properties).
-   [Static class property](#static-properties).
-   [Class and interface constant](#class-and-interface-constants).

##Kinds of Variables

###Constants

**Syntax**

See [constants section](06-constants.md#general).

**Constraints**

Outside of a class or interface, a c-constant can be defined only at the
top level of a script.

**Semantics**

See [constants](06-constants.md#general) and [class constants](14-classes.md#constants).

A constant defined outside of a class or interface is a [superglobal](#general). A constant has static [storage duration](04-basic-concepts.md#storage-duration)
and is a non-modifiable lvalue.

**Examples**

```PHP
const MAX_HEIGHT = 10.5;        // define two c-constants
const UPPER_LIMIT = MAX_HEIGHT;
define('COEFFICIENT_1', 2.345); // define two d-constants
define('FAILURE', TRUE);
```

###Local Variables

**Syntax**

See Semantics below.

**Semantics**

Except for a parameter, a local variable is never defined explicitly;
instead, it is created when it is first assigned a value. A local
variable can be assigned to as a parameter in the parameter list of a
[function definition](13-functions.md#function-definitions) or inside any [compound statement](11-statements.md#compound-statements). It
has function [scope](04-basic-concepts.md#scope) and automatic [storage duration](04-basic-concepts.md#storage-duration). A local
variable is a modifiable lvalue.

**Examples**

```PHP
function doit($p1)  // assigned the value TRUE when called
{
  $count = 10;
    ...
  if ($p1)
  {
    $message = "Can't open master file.";
    ...
  }
  ...
}
doit(TRUE);
// -----------------------------------------
function f()
{
  $lv = 1;
  echo "\$lv = $lv\n";
  ++$lv;
}
for ($i = 1; $i <= 3; ++$i)
  f();
```

Unlike the [function static equivalent](#function-statics), function `f` outputs
"`$lv = 1`" each time.

See the recursive function example in [storage duration section](04-basic-concepts.md#storage-duration).

###Array Elements

**Syntax**

[Arrays](12-arrays.md#arrays) are created via the [array-creation operator](10-expressions.md#array-creation-operator) or
the intrinsic [`array`](10-expressions.md#array). At the same time, one or more elements
may be created for that array. New elements are inserted into an
existing array via the [simple-assignment operator](10-expressions.md#simple-assignment) in
conjunction with the subscript [operator `[]`](10-expressions.md#subscript-operator). Elements can be
removed by calling the [`unset` intrinsic](10-expressions.md#unset).

**Semantics**

The [scope](04-basic-concepts.md#scope) of an array element is the same as the scope of that
array's name. An array element has allocated [storage duration](04-basic-concepts.md#storage-duration).

**Examples**

```PHP
$colors = ["red", "white", "blue"]; // create array with 3 elements
$colors[] = "green";                // insert a new element
```

###Function Statics

**Syntax**

<pre>
  <i>function-static-declaration:</i>
    static <i>static-variable-name-list</i>  ;

  <i>static-variable-name-list:</i>
    <i>static-variable-declaration</i>
	<i>static-variable-name-list</i>  ,  <i>static-variable-declaration</i>

  <i>static-variable-declaration:</i>
	<i>variable-name</i> <i>function-static-initializer<sub>opt</sub></i>

  <i>function-static-initializer:</i>
    = <i>constant-expression</i>
</pre>

**Defined elsewhere**

* [*variable-name*](09-lexical-structure.md#names)
* [*constant-expression*](10-expressions.md#constant-expressions)

**Constraints**

A function static must be defined inside a function.

**Semantics**

A function static may be defined inside any [compound statement](11-statements.md#compound-statements).
It is a modifiable lvalue.

A function static has function [scope](04-basic-concepts.md#scope) and static [storage duration](04-basic-concepts.md#storage-duration).

The value of a function static is retained across calls to its parent
function. Each time the function containing a function static
declaration is called, that execution is dealing with an [alias](04-basic-concepts.md#general)
to that static variable. If that alias is passed to the [`unset` intrinsic](10-expressions.md#unset),
only that alias is destroyed. The next time that function is called, a new alias is created.

**Examples**

```PHP
function f()
{
  static $fs = 1;
  echo "\$fs = $fs\n";
  ++$fs;
}
for ($i = 1; $i <= 3; ++$i)
  f();
```

Unlike the [local variable equivalent](#local-variables), function `f` outputs "`$fs
= 1`", "`$fs = 2`", and "`$fs = 3`", as `$fs` retains its value across
calls.

###Global Variables

**Syntax**

<pre>
  <i>global-declaration:</i>
    global <i>variable-name-list</i> ;

  <i>variable-name-list:</i>
    <i>global-variable</i>
    <i>variable-name-list</i>  ,  <i>global-variable</i>

  <i>global-variable:</i>
    <i>variable-name</i>
	<i>variable-name-creation-expression</i>
</pre>

**Defined elsewhere**

* [*expression*](10-expressions.md#general-6)
* [*variable-name*](09-lexical-structure.md#names)
* [*variable-name-creation-expression*](10-expressions.md#variable-name-creation-operator)

**Constraints**

Each *variable-name-creation-expression* must designate a simple variable name, i.e. it can not include array elements,
property accesses, etc. that are not inside braced expression.

**Semantics**

A global variable is never defined explicitly; instead, it is created
when it is first assigned a value. That may be done at the top level of
a script, or from within a block in which that variable has been
declared (*imported*, that is) using the `global` keyword.

One of the [predefined variables](#predefined-variables),
[`$GLOBALS`](http://php.net/manual/reserved.variables.globals.php) is
a [superglobal](#general) array whose elements' key/value pairs contain the
name and value, respectively, of each global variable currently defined.
As such, a global variable `gv` can be initialized with the value `v`,
and possibly be created, using the following form of assignment:

`$GLOBALS['gv'] = v`

As `$GLOBALS` is a superglobal, `gv` need not first be the subject of a
*global-declaration*.

A global variable has global [scope](04-basic-concepts.md#scope) and static
[storage duration](04-basic-concepts.md#storage-duration). A global variable is a modifiable lvalue.

When a global value is imported into a function, each time the function
is called, that execution is dealing with an [alias](04-basic-concepts.md#general) to that
global variable. If that alias is passed to the [`unset` intrinsic](10-expressions.md#unset),
only that alias is destroyed. The next time that function
is called, a new alias is created with the current value of the global variable.

**Examples**

```PHP
$colors = array("red", "white", "blue");
$GLOBALS['done'] = FALSE;
// -----------------------------------------
$min = 10; $max = 100; $average = NULL;
global $min, $max;         // allowed, but serves no purpose
function compute($p)
{
  global $min, $max;
  global $average;
  $average = ($max + $min)/2;

  if ($p)
  {
    global $result;
    $result = 3.456;  // initializes a global, creating it, if necessary
  }
}
compute(TRUE);
echo "\$average = $average\n";  // $average = 55
echo "\$result = $result\n";  // $result = 3.456
// -----------------------------------------
$g = 100;
function f()
{
  $v = 'g';
  global $$v;          // import global $g
  ...
}
```

###Instance Properties

These are described in [class instance properties section](14-classes.md#properties).
They have class [scope](04-basic-concepts.md#scope) of the defining class and
allocated [storage duration](04-basic-concepts.md#storage-duration).
Access to the instance properties is governed by [visibility rules](14-classes.md#general).

###Static Properties

These are described in [class static properties section](14-classes.md#properties).
They have class [scope](04-basic-concepts.md#scope) of the defining class
and static [storage duration](04-basic-concepts.md#storage-duration).
Access to the static properties is governed by [visibility rules](14-classes.md#general).

###Class and Interface Constants

These are described in [class constants section](14-classes.md#constants) and [interface constants section](15-interfaces.md#constants). They have class [scope](04-basic-concepts.md#scope) of the defining class or interface
 and static [storage duration](04-basic-concepts.md#storage-duration).

##Predefined Variables

The following global variables are available to all scripts:

Variable Name |   Description
-------------   |    -----------
`$argc` | `int`; The number of command-line arguments passed to the script. This is at least 1. (See `$argv` below). This may not be available in non-command-line builds of the Engine.
`$argv` | `array`; An array of `$argc` elements containing the command-line arguments passed to the script as strings. Each element has an `int` key with the keys being numbered sequentially starting at zero through `$argc-1`. `$argv[0]` is the name of the script. It is implementation-defined as to how white space on command lines is handled, whether letter casing is preserved, which characters constitute quotes, or how `$argv[0]`'s string is formatted. As to how command-line arguments are defined, is unspecified. This may not be available in non-command-line builds of the Engine.
`$_COOKIE` |  `array`; The variables passed to the current script via HTTP Cookies.
`$_ENV` | `array`; An array in which the environment variable names are element keys, and the environment variable value strings are element values. As to how an environment variable is defined, is unspecified.
`$_FILES` | `array`; The items uploaded to the current script via the HTTP POST method.
`$_GET` | `array`; The variables passed to the current script via the URL parameters.
`$GLOBALS` |  `array`; A [superglobal](#general) array containing the names of all variables that are currently defined in the global scope of the script. The variable names are the element keys, and the variable values are the element values.
`$_POST` |  `array`; The variables passed to the current script via the HTTP POST method.
`$_REQUEST` | `array`; By default contains the contents of `$_COOKIE`, `$_GET`, and `$_POST`. The exact contents may depend on the Engine settings.
`$_SERVER` |  `array`; Server and execution environment information, such as headers, paths, and script locations. The entries in this array are taken from the Engine environment, e.g. the webserver.
`$_SESSION` | `array`; The session variables available to the current script. This global is defined only if a [session](http://php.net/manual/en/book.session.php) is active.

All `$_*` variables above are superglobals. The exact set of the variables available may depend on the implementation, the Engine build and the environment.
