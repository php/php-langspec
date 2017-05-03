# Traits

## General

PHP's class model allows [single inheritance](14-classes.md#general) only with contracts
being enforced separately via [interfaces](15-interfaces.md#general). A *trait* can provide
both implementation and contracts. Specifically, a class can inherit
from a base class while also using code from one or more traits.
At the same time, that class can implement contracts from one or more
interfaces as well as from one or more traits. The use of a trait by a
class does not involve any inheritance hierarchy, so unrelated classes
can use the same trait. In summary, a trait is a set of methods and/or
state information that can be reused.

Traits are designed to support classes; a trait cannot be instantiated
directly.

The members of a trait each have [visibility](14-classes.md#general), which applies once
they are used by a given class. The class that uses a trait can change
the visibility of any of that trait's members, by either widening or
narrowing that visibility. For example, a private trait member can be
made public in the using class, and a public trait member can be made
private in that class.

Once implementation comes from both a base class and one or more traits,
name conflicts can occur. However, trait usage provides the means for
disambiguating such conflicts. Names gotten from a trait can also be
given aliases.

A class member with a given name overrides one with the same name in any
traits that class uses, which, in turn, overrides any such name from
base classes.

Traits can contain both instance and static members, including both
methods and properties. In the case of a trait with a static property,
each class using that trait has its own instance of that property.

Methods in a trait have full access to all members of any class in which
that trait is used.

## Trait Declarations

**Syntax**

<!-- GRAMMAR
trait-declaration:
  'trait' name '{' trait-member-declarations? '}'

trait-member-declarations:
  trait-member-declaration
  trait-member-declarations trait-member-declaration

trait-member-declaration:
  property-declaration
  method-declaration
  constructor-declaration
  destructor-declaration
  trait-use-clauses
-->

<pre>
<i id="grammar-trait-declaration">trait-declaration:</i>
   trait   <i><a href="09-lexical-structure.md#grammar-name">name</a></i>   {   <i><a href="#grammar-trait-member-declarations">trait-member-declarations</a></i><sub>opt</sub>   }

<i id="grammar-trait-member-declarations">trait-member-declarations:</i>
   <i><a href="#grammar-trait-member-declaration">trait-member-declaration</a></i>
   <i><a href="#grammar-trait-member-declarations">trait-member-declarations</a></i>   <i><a href="#grammar-trait-member-declaration">trait-member-declaration</a></i>

<i id="grammar-trait-member-declaration">trait-member-declaration:</i>
   <i><a href="14-classes.md#grammar-property-declaration">property-declaration</a></i>
   <i><a href="14-classes.md#grammar-method-declaration">method-declaration</a></i>
   <i><a href="14-classes.md#grammar-constructor-declaration">constructor-declaration</a></i>
   <i><a href="14-classes.md#grammar-destructor-declaration">destructor-declaration</a></i>
   <i><a href="#grammar-trait-use-clauses">trait-use-clauses</a></i>
</pre>

**Semantics**

A *trait-declaration* defines a named set of members, which are made
available to any class that uses that trait.

Trait names are case-insensitive.

The members of a trait are those specified by its *trait-member-declaration*
clauses, and members imported from any other traits using *trait-use-clauses*.

A trait may contain the following members:

-   [Properties](14-classes.md#properties) – the variables made available to the class in which the
    trait is used.
-   [Methods](14-classes.md#methods) – the computations and actions that can be performed by the
    class in which the trait is used.
-   [Constructor](14-classes.md#constructors) – the actions required to initialize an instance of the
    class in which the trait is used.
-   [Destructor](14-classes.md#destructors) – the actions to be performed when an instance of the
    class in which the trait is used is no longer needed.

If a member has no explicit visibility, `public` is assumed.

**Examples**

```PHP
trait T
{
  private $prop1 = 1000;
  protected static $prop2;
  var $prop3;
  public function compute( ... ) { ... }
  public static function getData( ... ) { ... }
}
```

## Trait Uses

**Syntax**

<!-- GRAMMAR
trait-use-clauses:
  trait-use-clause
  trait-use-clauses trait-use-clause

trait-use-clause:
  'use' trait-name-list trait-use-specification

trait-name-list:
  qualified-name
  trait-name-list ',' qualified-name

trait-use-specification:
  ';'
  '{' trait-select-and-alias-clauses? '}'

trait-select-and-alias-clauses:
  trait-select-and-alias-clause
  trait-select-and-alias-clauses trait-select-and-alias-clause

trait-select-and-alias-clause:
  trait-select-insteadof-clause ';'
  trait-alias-as-clause ';'

trait-select-insteadof-clause:
  name 'insteadof' name

trait-alias-as-clause:
  name 'as' visibility-modifier? name
  name 'as' visibility-modifier name?
-->

<pre>
<i id="grammar-trait-use-clauses">trait-use-clauses:</i>
   <i><a href="#grammar-trait-use-clause">trait-use-clause</a></i>
   <i><a href="#grammar-trait-use-clauses">trait-use-clauses</a></i>   <i><a href="#grammar-trait-use-clause">trait-use-clause</a></i>

<i id="grammar-trait-use-clause">trait-use-clause:</i>
   use   <i><a href="#grammar-trait-name-list">trait-name-list</a></i>   <i><a href="#grammar-trait-use-specification">trait-use-specification</a></i>

<i id="grammar-trait-name-list">trait-name-list:</i>
   <i><a href="09-lexical-structure.md#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-trait-name-list">trait-name-list</a></i>   ,   <i><a href="09-lexical-structure.md#grammar-qualified-name">qualified-name</a></i>

<i id="grammar-trait-use-specification">trait-use-specification:</i>
   ;
   {   <i><a href="#grammar-trait-select-and-alias-clauses">trait-select-and-alias-clauses</a></i><sub>opt</sub>   }

<i id="grammar-trait-select-and-alias-clauses">trait-select-and-alias-clauses:</i>
   <i><a href="#grammar-trait-select-and-alias-clause">trait-select-and-alias-clause</a></i>
   <i><a href="#grammar-trait-select-and-alias-clauses">trait-select-and-alias-clauses</a></i>   <i><a href="#grammar-trait-select-and-alias-clause">trait-select-and-alias-clause</a></i>

<i id="grammar-trait-select-and-alias-clause">trait-select-and-alias-clause:</i>
   <i><a href="#grammar-trait-select-insteadof-clause">trait-select-insteadof-clause</a></i>   ;
   <i><a href="#grammar-trait-alias-as-clause">trait-alias-as-clause</a></i>   ;

<i id="grammar-trait-select-insteadof-clause">trait-select-insteadof-clause:</i>
   <i><a href="09-lexical-structure.md#grammar-name">name</a></i>   insteadof   <i><a href="09-lexical-structure.md#grammar-name">name</a></i>

<i id="grammar-trait-alias-as-clause">trait-alias-as-clause:</i>
   <i><a href="09-lexical-structure.md#grammar-name">name</a></i>   as   <i><a href="14-classes.md#grammar-visibility-modifier">visibility-modifier</a></i><sub>opt</sub>   <i><a href="09-lexical-structure.md#grammar-name">name</a></i>
   <i><a href="09-lexical-structure.md#grammar-name">name</a></i>   as   <i><a href="14-classes.md#grammar-visibility-modifier">visibility-modifier</a></i>   <i><a href="09-lexical-structure.md#grammar-name">name</a></i><sub>opt</sub>
</pre>

**Constraints**

The *name* items in *trait-name-list* must designate trait names, excluding
the name of the trait being declared.

The left-hand *name* in *trait-select-insteadof-clause* must
unambiguously designate a member of a trait made available by
*trait-use-clauses*. The right-hand *name* in
*trait-select-insteadof-clause* must unambiguously designate a trait
made available by *trait-use-clauses*.

The left-hand *name* in *trait-alias-as-clause* must unambiguously
designate a member of a trait made available by *trait-use-clauses*.
The right-hand *name* in *trait-alias-as-clause* must be a new,
unqualified name.

**Semantics**

*trait-use-clauses* can be used as part of *trait-member-declarations*
or *class-member-declarations* to import members of a trait into a
different trait or a class. This is done via one or more *trait-use-clause*
items, each of which contains a comma-separated list of trait names.
A *trait-use-clause* list ends in a semicolon or a brace-delimited set of
*trait-select-insteadof-clause* and *trait-alias-as-clause* statements.

A *trait-select-insteadof-clause* allows to avoid name clashes.
Specifically, the left-hand *name* designates which name to be used from
of a pair of names. That is, `T1::compute insteadof T2`; indicates that
calls to method compute, for example, should be satisfied by a method of
that name in trait `T1` rather than `T2`.

A *trait-alias-as-clause* allows a (possibly qualified) name to be
assigned a simple alias name. Specifically, the left-hand *name* in
*trait-alias-as-clause* designates a name made available by
*trait-use-clauses* - that is to be aliased, and the right-hand *name*
is the alias.

If *trait-alias-as-clause* contains a visibility-modifier,
if a right-hand name is provided, the modifier controls the visibility of the alias,
otherwise, it controls the visibility of the left-hand name.

**Examples**

```PHP
trait T1 { public function compute( ... ) { ... } }
trait T2 { public function compute( ... ) { ... } }
trait T3 { public function sort( ... ) { ... } }
trait T4
{
  use T3;
  use T1, T2
  {
    T1::compute insteadof T2; // disambiguate between two computes
    T3::sort as private sorter; // make alias with adjusted visibility
  }
}
```


