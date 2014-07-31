#Traits

##General

PHP's class model allows single inheritance only ([§§](14-classes.md#general)) with contracts
being enforced separately via interfaces ([§§](15-interfaces.md#general)). A *trait* can provide
both implementation and contracts. Specifically, a class can inherit
from a base class while getting implementation from one or more traits.
At the same time, that class can implement contracts from one or more
interfaces as well as from one or more traits. The use of a trait by a
class does not involve any inheritance hierarchy, so unrelated classes
can use the same trait. In summary, a trait is a set of methods and/or
state information that can be reused.

Traits are designed to support classes; a trait cannot be instantiated
directly.

The members of a trait each have visibility ([§§](14-classes.md#general)), which applies once
they are used by a given class. The class that uses a trait can change
the visibility of any of that trait's members, by either widening or
narrowing that visibility. For example, a private trait member can be
made public in the using class, and a public trait member can be made
private in that class.

Once implementation comes from both a base class and one or more traits,
name conflicts can occur. However, trait usage provides a means of
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

##Trait Declarations

**Syntax**

<pre>
  <i>trait-declaration:</i>
    trait   <i>name</i>   {   <i>trait-use-clauses<sub>opt</sub>   trait-member-declarations<sub>opt</sub></i>   }

  <i>trait-use-clauses:</i>
    <i>trait-use-clause</i>
    <i>trait-use-clauses   trait-use-clause</i>

  <i>trait-use-clause:</i>
    use   <i>trait-name-list   trait-use-terminator</i>

  <i>trait-name-list:</i>
    <i>qualified-name</i>
    <i>trait-name-list</i>   ,   <i>qualified-name</i>

  <i>trait-use-terminator:</i>
    ;
    {   <i>trait-select-and-alias-clauses<sub>opt</sub></i>   }

  <i>trait-select-and-alias-clauses:</i>
    <i>trait-select-and-alias-clause</i>
    <i>trait-select-and-alias-clauses   trait-select-and-alias-clause</i>

  <i>trait-select-and-alias-clause:</i>
    <i>trait-select-insteadof-clause</i>
    <i>trait-alias-as-clause</i>

  <i>trait-select-insteadof-clause:</i>
    <i>name</i>   insteadof   <i>name</i>

  trait-alias-as-clause:
    <i>name</i>   as   <i>visibility-modifier<sub>opt</sub>   name</i>
    <i>name</i>   as   <i>visibility-modifier   name<sub>opt</sub></i>
</pre>

*name* is defined in [§§](09-lexical-structure.md#names); *visibility-modifier* is defined in
[§§](14-classes.md#properties); and *trait-member-declarations* is defined in [§§](#trait-members).

**Constraints**

The *name*s in *trait-name-list* must designate trait names, excluding
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

A *trait-declaration* defines a named set of members, which are made
available to any class that uses that trait.

Trait names are case-insensitive.

A *trait-declaration* may also use other traits. This is done via one or
more *trait-use-clause*s, each of which contains a comma-separated list
of trait names. A *trait-use-clause* ends in a semicolon or a
brace-delimited set of *trait-select-insteadof-clause*s and
*trait-alias-as-clause*s.

A *trait-select-insteadof-clause* allows name clashes to be avoided.
Specifically, the left-hand *name* designates which name to be used from
of a pair of names. That is, `T1::compute insteadof T2`; indicates that
calls to method compute, for example, should be satisfied by a method of
that name in trait `T1` rather than `T2`.

A *trait-alias-as-clause* allows a (possibly qualified) name to be
assigned a simple alias name. Specifically, the left-hand *name* in
*trait-alias-as-clause* designates a name made available by
*trait-use-clauses* ~~ that is to be aliased, and the right-hand *name*
is the alias.

If *trait-alias-as-clause* contains a visibility-modifier, that controls
the visibility of the alias, if a right-hand name is provided;
otherwise, it controls the visibility of the left-hand name.

**Examples**

```
trait T1 { public function compute( ... ) { ... } }
trait T2 { public function compute( ... ) { ... } }
trait T1 { public function sort( ... ) { ... } }
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

##Trait Members

**Syntax**

<pre>
  <i>trait-member-declarations:</i>
    <i>trait-member-declaration</i>
    <i>trait-member-declarations   trait-member-declaration</i>

  <i>trait-member-declaration:</i>
    <i>property-declaration</i>
    <i>method-declaration</i>
    <i>constructor-declaration</i>
    <i>destructor-declaration</i>
</pre>

*property-declaration* is defined in [§§](14-classes.md#properties); *method-declaration* is
defined in [§§](14-classes.md#methods); *constructor-declaration* is defined in [§§](09-lexical-structure.md#names); and
*destructor-declaration* is defined in [§§](14-classes.md#destructors).

**Semantics**

The members of a trait are those specified by its
*trait-member-declaration*s, and the members from any other traits it
uses.

A trait may contain the following members:

-   Properties – the variables made available to the class in which the
    trait is used ([§§](14-classes.md#properties)).
-   Methods – the computations and actions that can be performed by the
    class in which the trait is used ([§§](14-classes.md#methods), [§§](14-classes.md#methods-with-special-semantics)).
-   Constructor – the actions required to initialize an instance of the
    class in which the trait is used ([§§](14-classes.md#constructors))
-   Destructor – the actions to be performed when an instance of the
    class in which the trait is used is no longer needed ([§§](14-classes.md#destructors)).

If a member has no explicit visibility, `public` is assumed.

**Examples**

```
trait T
{
  private $prop1 = 1000;
  protected static $prop2;
  var $prop3;
  public function compute( ... ) { ... }
  public static function getData( ... ) { ... }
}
```


