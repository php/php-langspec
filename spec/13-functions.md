#Functions

##General

When a function is called, information may be passed to it by the caller
via an *argument list*, which contains one or more *argument
expressions*, or more simply, *arguments*. These correspond by position
to the *parameters* in a *parameter list* in the called function's
definition ([§§](#function-definitions)).

An *unconditionally defined function* is a function whose definition is
at the top level of a script. A *conditionally defined function* is a
function whose definition occurs inside a compound statement (which is
inside a function definition); that is, it is a *nested function*. There
is no limit on the depth of levels of function nesting. Consider the
case of an *outer function*, and an *inner function* defined within it.
Until the outer function is called at least once, its inner function
cannot exist. Even if the outer function is called, if its runtime logic
bypasses the definition of the inner function, that inner function still
does not exist.

Any function containing `yield` ([§§](10-expressions.md#yield-operator)) is a *generator function*.

**Examples**

```
ucf1(); // can call ucf1 before its definition is seen
function ucf1() { ... }
ucf1(); // can call ucf1 after its definition is seen
cf1(); // Error; call to non-existent function
$flag = TRUE;
if ($flag) { function cf1() { ... } } // cf1 now exists
if ($flag) { cf1(); } // can call cf1 now
// -----------------------------------------
function ucf2() { function cf2() { ... } }
cf2(); // Error; call to non-existent function
ucf2(); // now cf2 exists
cf2(); // so we can call it
```

##Function Calls

A function is called via the function-call operator `()` ([§§](10-expressions.md#function-call-operator)).

##Function Definitions

**Syntax**

<pre>
  <i>function-definition:</i>
    <i>function-definition-header   compound-statement</i>

  <i>function-definition-header:</i>
    function  &<sub>opt</sub>   <i>name</i>  (  <i>parameter-declaration-list<sub>opt</sub></i>  )

  <i>parameter-declaration-list:</i>
    <i>parameter-declaration</i>
    <i>parameter-declaration-list</i>  ,  <i>parameter-declaration</i>

  <i>parameter-declaration:</i>
    <i>type-hint<sub>opt</sub></i>  &<sub>opt</sub>   <i>variable-name   default-argument-specifier<sub>opt</sub></i>

  <i>type-hint:</i>
    array
    callable
    <i>qualified-name</i>

  <i>default-argument-specifier:</i>
    =  <i>const-expression</i>
</pre>

*const-expression* is defined in [§§](10-expressions.md#constant-expressions). *qualified-name* is defined in
[§§](09-lexical-structure.md#names).

**Constraints**

Each parameter name in a *function-definition* must be distinct.

A conditionally defined function ([§§](#general)) must exist before any calls are
made to that function.

*parameter-declaration* must not contain `&` if *type-hint* is `array` or
`callable`.

**Semantics**

A *function-definition* defines a function called *name*. Function names
are **not** case-sensitive. A function can be defined with zero or more
parameters, each of which is specified in its own
*parameter-declaration* in a *parameter-declaration-list*. Each
parameter has a name, *variable-name*, and optionally, a
*default-argument-specifier*. An `&` in *parameter-declaration* indicates
that parameter is passed byRef ([§§](04-basic-concepts.md#assignment)) rather than by value. An `&`
before *name* indicates that the value returned from this function is to
be returned byRef. Function-value returning is described in [§§](11-statements.md#the-return-statement).

When the function is called, if there exists a parameter for which there
is a corresponding argument, the argument is assigned to the parameter 
variable using value assignment, while for passing-byRef, the argument is 
assigned to the parameter variable using byRef assignment ([§§](04-basic-concepts.md#assignment), [§§](04-basic-concepts.md#argument-passing)). If that parameter has no corresponding argument, but the parameter has a 
default argument value, for passing-by-value or passing-byRef, the default 
value is assigned to the parameter variable using value assignment. 
Otherwise, if the parameter has no corresponding argument and the parameter 
does not have a default value, the parameter variable is non-existent and no corresponding VSlot ([§§](04-basic-concepts.md#the-memory-model)) exists.  After all possible parameters have been 
assigned initial values or aliased to arguments, the body of the function, 
*compound-statement*, is executed. This execution may terminate normally 
(§[[4.3](04-basic-concepts.md#program-termination)](#program-termination), [§§](11-statements.md#the-return-statement)) or abnormally (§[[4.3](04-basic-concepts.md#program-termination)](#program-termination)).

Each parameter is a variable local to the parent function, and is a
modifiable lvalue.

A *function-definition* may exist at the top level of a script, inside
any *compound-statement*, in which case, the function is conditionally
defined ([§§](#general)), or inside a *method-declaration* ([§§](14-classes.md#methods)).

By default, a parameter will accept an argument of any type. However, by
specifying a *type-hint*, the types of argument accepted can be
restricted. By specifying `array`, only an argument designating an array
type is accepted. By specifying `callable`, only an argument designating a
function is accepted. By specifying *qualified-name*, only an instance
of a class having that type, or being derived from that type, are
accepted, or only an instance of a class that implements that interface
type directly or indirectly is accepted.

##Variable Functions

If a variable name is followed by the function-call operator `()`
([§§](10-expressions.md#function-call-operator)), and the value of that variable is a string containing the
name of a function currently defined and visible, that function will be
executed.

The library function `is_callable` (§xx) reports whether the contents of
a variable can be called as a function.

##Anonymous Functions

An *anonymous function*, also known as a *closure*, is a function
defined with no name. As such, it must be defined in the context of an
expression whose value is used immediately to call that function, or
that is saved in a variable for later execution. An anonymous function
is defined via the anonymous function-creation operator ([§§](10-expressions.md#anonymous-function-creation)).

For both `__FUNCTION__` and `__METHOD__` ([§§](06-constants.md#context-dependent-constants)), an anonymous
function's name is `{closure}`. All anonymous functions created in the
same scope have the same name.


