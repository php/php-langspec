#Namespaces

##General

A problem encountered when managing large projects is that of avoiding
the use of the same name in the same scope for different purposes. This
is especially problematic in a language that supports modular design and
component libraries.

A *namespace* is a container for a set of (typically related)
definitions of classes, interfaces, traits, functions, and constants.
Namespaces serve two purposes:

-   They help avoid name collisions.
-   They allow certain long names to be accessed via shorter, more
    convenient and readable, names.

A namespace may have *sub-namespaces*, where a sub-namespace name shares
a common prefix with another namespace. For example, the namespace
`Graphics` might have sub-namespaces `Graphics\D2` and `Graphics\D3`, for
two- and three-dimensional facilities, respectively. Apart from their
common prefix, a namespace and its sub-namespaces have no special
relationship. The namespace whose prefix is part of a sub-namespace need
not actually exist for the sub-namespace to exist. That is, `NS1\Sub` can
exist without `NS1`.

In the absence of any namespace definition, the names of subsequent
classes, interfaces, traits, functions, and constants are in the
*default namespace*, which has no name, per se.

The namespaces PHP, php, and sub-namespaces beginning with those
prefixes are reserved for use by PHP.

##Name Lookup

When an existing name is used in source code, the Engine must determine
how that name is found with respect to namespace lookup. For this
purpose, names can have one of the three following forms:

-   Unqualified name: Such names are just simple names without any
    prefix, as in the class name `Point` in the following expression:
    `$p = new Point(3,5)`. If the current namespace is `NS1`, the name
    `Point` resolves to `NS1\Point`. If the current namespace is the
    default namespace ([§§](#general)), the name `Point` resolves to `Point`. In the
    case of an unqualified function or constant name, if that name does
    not exist in the current namespace, a global function or constant by
    that name is used.
-   Qualified name: Such names have a prefix consisting of a namespace
    name and/or one or more levels of sub-namespace names, and,
    possibly, a class, interface, trait, function, or constant name.
    Such names are relative. For example, `D2\Point` could be used to
    refer to the class Point in the sub-namespace `D2` of the current
    namespace. One special case of this is when the first component of
    the name is the keyword `namespace`. This means "the current
    namespace".
-   Fully qualified name: Such names begin with a backslash (`\`) and are
    followed optionally by a namespace name and one or more levels of
    sub-namespace names, and, finally, a class, interface, trait,
    function, or constant name. Such names are absolute. For example,
    `\Graphics\D2\Point` could be used to refer unambiguously to the
    class `Point` in namespace `Graphics`, sub-namespace `D2`.
   
The names of the standard types (such as `Exception`), constants (such as
`PHP_INT_MAX`), and library functions (such as `is_null`) are defined outside
any namespace. To refer unambiguously to such names, one can prefix them
with a backslash (`\`), as in `\Exception`, `\PHP_INT_MAX`, and `\is_null`.

##Defining Namespaces

**Syntax**

<pre>
  <i>namespace-definition:</i>
    namespace  <i>namespace-name</i>  ;
    namespace  <i>namespace-name<sub>opt</sub>   compound-statement</i>
</pre>

*namespace-name* is defined in [§§](09-lexical-structure.md#names), and *compound-statement* is
defined in [§§](11-statements.md#compound-statements).

**Constraints**

Except for white space and an optional *declare-statement* ([§§](11-statements.md#the-declare-statement)), the
first occurrence of a *namespace-definition* in a script must be the
first thing in that script.

All occurrence of a *namespace-definition* in a script must have the
*compound-statement* form or must not have that form; the two forms
cannot be mixed.

When a script contains source code that is not inside a namespace, and
source code that is inside one or namespaces, the namespaced code must
use the *compound-statement* form of *namespace-definition*.

*compound-statement* must not contain a *namespace-definition*.

**Semantics**

Although a namespace may contain any PHP source code, the fact that that
code is contained in a namespace affects only the declaration and name
resolution of classes, interfaces, traits, functions, and constants.

Namespace and sub-namespace names are case-insensitive.

The pre-defined constant `__NAMESPACE__` ([§§](06-constants.md#context-dependent-constants)) contains the name of
the current namespace.

When the same namespace is defined in multiple scripts, and those
scripts are combined into the same program, the namespace is considered
the merger of its individual contributions.

The scope of the non-*compound-statement* form of *namespace-definition*
runs until the end of the script, or until the lexically next
*namespace-definition*, whichever comes first. The scope of the
*compound-statement* form is the *compound-statement*.

**Examples**

Script1.php:
```
namespace NS1;
...       // __NAMESPACE__ is "NS1"
namespace NS3\Sub1;
...       // __NAMESPACE__ is "NS3\Sub1"
```

Script2.php:
```
namespace NS1
{
...       // __NAMESPACE__ is "NS1"
}
namespace
{
...       // __NAMESPACE__ is ""
}
namespace NS3\Sub1;
{
...       // __NAMESPACE__ is "NS3\Sub1"
}
```

##Namespace Use Declarations**

**Syntax**

<pre>
  <i>namespace-use-declaration:</i>
    use  <i>namespace-use-clauses</i>  ;

  <i>namespace-use-clauses:</i>
    <i>namespace-use-clause</i>
    <i>namespace-use-clauses</i>  ,  <i>namespace-use-clause</i>

  <i>namespace-use-clause:</i>
    <i>qualified-name   namespace-aliasing-clause<sub>opt</sub></i>

  <i>namespace-aliasing-clause:</i>
    as  <i>name</i>
</pre>

*qualified-name* and *name* are defined in [§§](09-lexical-structure.md#names).

**Constraints**

A *namespace-use-declaration* must not occur except at the pseudo main
level or directly in the context of a *namespace-definition* (18.3).

If the same *qualified-name* is imported multiple times in the same
scope, each occurrence must have a different alias.

**Semantics**

*qualified-name* is always interpreted as referring to a class,
interface, or trait by that name. *namespace-use-clauses* can only
create aliases for classes, interfaces, or traits; it is not possible to
use them to create aliases to functions or constants.

A *namespace-use-declaration* *imports*—that is, makes available—one or
more names into a scope, optionally giving them each an alias. Each of
those names may designate a namespace, a sub-namespace, a class, an
interface, or a trait. If a namespace-alias-clause is present, its
*name* is the alias for *qualified-name*. Otherwise, the right-most name
in *qualified-name* is the implied alias for *qualified-name*.

**Examples**

```
namespace NS1
{
  const CON1 = 100;
  function f() { ... }
  class C { ... }
  interface I { ... }
  trait T { ... }
}

namespace NS2
{
  use \NS1\C, \NS1\I, \NS1\T;
  class D extends C implements I
  {
    use T;
  }
  $v = \NS1\CON1; // explicit namespace still needed for constants
  \NS1\f();   // explicit namespace still needed for functions

  use \NS1\C as C2; // C2 is an alias for the class name \NS1\C
  $c2 = new C2;
}
```

Notice that the *qualified-name* is absolut and not relative as in normal context. Following an example to outline the behaviour:

```
namespace b
{
  class B
  {
    function foo(){ echo "goodbye"; } 
  }
}

namespace a\b
{
  class B
  {
    function foo(){ echo "hello"; } 
  }
}

namespace a
{
  $b = new b\B();
  $b->foo(); //hello
  use b\B as C;
  $b = new C();
  $b->foo(); //goodbye
}
```
