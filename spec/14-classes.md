#Classes

##General

A class is a type that may contain zero or more explicitly declared
*members*, which can be any combination of *class constants* ([§§](#constants));
data members, called *properties* ([§§](#properties)); and function members, called
*methods* ([§§](#methods)). (The ability to add properties and methods to an
instance at runtime is described in [§§](#dynamic-members)). An object (often called an
*instance*) of a class type is created (i.e., *instantiated*) via the
new operator ([§§](10-expressions.md#the-new-operator)).

PHP supports inheritance ([§§](#class-declarations)), a means by which a *derived class* can
*extend* and specialize a single *base class*. However, unlike numerous
other languages, classes in PHP are **not** all derived from a common
ancestor. An *abstract* class ([§§](#class-declarations)) is a base type intended for
derivation, but which cannot be instantiated directly. A *concrete*
class is a class that is not abstract. A *final* class ([§§](#class-declarations)) is one
from which other classes cannot be derived.

A class may *implement* one or more *interfaces* ([§§](#class-declarations), [§§](15-interfaces.md#general)), each of
which defines a contract.

A class can *use* one or more traits ([§§](16-traits.md#general)), which allows a class to
have some of the benefits of multiple inheritance.

A *constructor* ([§§](#constructors)) is a special method that is used to initialize
an instance immediately after it has been created. A *destructor*
([§§](#destructors)) is a special method that is used to free resources when an
instance is no longer needed. Other special methods exist; they are
described in ([§§](#methods-with-special-semantics)).

The members of a class each have a default or explicitly declared
*visibility*, which determines what source code can access them. A
member with `private` visibility may be accessed only from within its own
class. A member with `protected` visibility may be accessed only from
within its own class and from classes derived from that class. Access to
a member with `public` visibility is unrestricted.

The *signature* of a method is a combination of the parent class name,
that method's name, and its parameter list, including type hints and
indication for arguments passed using byRef, and whether the resulting
value is returned byRef.

Methods and properties from a base class can be *overridden* in a
derived class by redeclaring them with the same signature defined in the
base class.

When an instance is allocated, new returns a handle that points to that
object. As such, assignment of a handle does not copy the object itself.
(See [§§](04-basic-concepts.md#cloning-objects) for a discussion of shallow and deep copying).

##Class Declarations

**Syntax**

<pre>
  <i>class-declaration:</i>
    <i>class-modifier<sub>opt</sub></i>  class  <i>name   class-base   clause<sub>opt</sub>  class-interface-clause<sub>opt</sub></i>   {   <i>trait-use-clauses<sub>opt</sub>   class-member-declarations<sub>opt</sub></i> }

  <i>class-modifier:</i>
    abstract
    final

  <i>class-base-clause:</i>
    extends  <i>qualified-name</i>

  <i>class-interface-clause:</i>
    implements  <i>qualified-name</i>
    <i>class-interface-clause</i>  ,  <i>qualified-name</i>
</pre>

*qualified-name* is defined in [§§](09-lexical-structure.md#names). *class-member-declarations* is
defined in [§§](#class-members). *trait-use-clauses* ~~ is defined in [§§](16-traits.md#trait-declarations)

**Constraints**

A class must not be derived directly or indirectly from itself.

A *class-declaration* containing any *class-member-declarations* that
have the modifier `abstract` must itself have an `abstract`
*class-modifier*.

*class-base-clause* must not name a final class.

*qualified-name* in *class-base-clause* must name a class type, and must
not be `parent`, `self`, or `static`.

A concrete class must implement each of the methods from all the
interfaces ([§§](15-interfaces.md#general)) specified in *class-interface-clause*.

For each interface method, the corresponding implementing method must be compatible with the interface method, including the following:
- If the interface method is defined as [retuning byRef](13-functions.md#function-definitions), the implementing method should also return byRef.
- If the interface method is variadic, the implementing method must also be variadic (see also below).
- The number of required (i.e. having no defaults) arguments of the implementing methods can not be more than the number of required arguments of the interface method (adding non-optional arguments is not allowed).
- The overall number of arguments for the implementing method should be at least the number of the arguments of the interface method (removing arguments is not allowed).
- Each argument of the implementing method must be compatible with corresponding argument of the prototype method. 

Compatible arguments are defined as follows:
- Parameter names do not matter.
- If the argument is optional (has default) in the interface, it should be optional in the implementation. However, implementation can provide a different default value.
- byRef argument requires byRef implementation, and non-byRef argument can not have byRef implementation.
- For no argument type, only declaration with no type is compatible.
- For typed argument, only argument with the same type is compatible.
- For variadic arguments, the definition of the variadic (last) argument should be compatible as per above. The implementation can define additional optional arguments before the variadic argument, but these arguments should be compatible with the variadic argument on the interface method.

*qualified-name* in *class-interface-clause* must name an interface
type.

**Semantics**

A *class-declaration* defines a class type by the name *name*. Class
names are case-insensitive.

The `abstract` modifier declares a class usable only as a base class; the
class cannot be instantiated directly. An abstract class may contain one
or more abstract members, but it is not required to do so. When a
concrete class is derived from an abstract class, the concrete class
must include an implementation for each of the abstract members it
inherits.

The `final` modifier prevents a class from being used as a base class.

The optional *class-base-clause* specifies the one base class from which
the class being defined is derived. In such a case, the derived class
inherits all the members from the base class.

The optional *class-interface-clause* specifies the one or more
interfaces that are implemented by the class being defined.

A class can use one or more traits via a *trait-use-clauses*; see [§§](16-traits.md#general)
and [§§](16-traits.md#trait-declarations).

**Examples**

```PHP
abstract class Vehicle 
{
  public abstract function getMaxSpeed();
  ...
}
abstract class Aircraft extends Vehicle 
{
  public abstract function getMaxAltitude();
  ...
}
class PassengerJet extends Aircraft 
{
  public function getMaxSpeed()
  {
    // implement method
  }
  public function getMaxAltitude()
  {
    // implement method
  }
  ...
}
$pj = new PassengerJet(...);
echo "\$pj's maximum speed: " . $pj->getMaxSpeed() . "\n";
echo "\$pj's maximum altitude: " . $pj->getMaxAltitude() . "\n";
// -----------------------------------------
final class MathLibrary 
{
  private function MathLibrary() {} // disallows instantiation
  public static function sin() { ... }
  // ...
}
$v = MathLibrary::sin(2.34);
// -----------------------------------------
interface MyCollection 
{
        function put($item);
        function get();
}
class MyList implements MyCollection 
{
  public function put($item)
  {
    // implement method
  }
  public function get()
  {
    // implement method
  }
  ...
}
```

##Class Members

**Syntax**

<pre>
  <i>class-member-declarations:</i>
    <i>class-member-declaration</i>
    <i>class-member-declarations   class-member-declaration</i>

   <i>class-member-declaration:</i>
     <i>const-declaration</i>
     <i>property-declaration</i>
     <i>method-declaration</i>
     <i>constructor-declaration</i>
     <i>destructor-declaration</i>
</pre>

*const-declaration* is defined in [§§](#constants); *property-declaration* is
defined in [§§](#properties); *method-declaration* is defined in [§§](#methods);
*constructor-declaration* is defined in [§§](09-lexical-structure.md#names); and
*destructor-declaration* is defined in [§§](#destructors).

**Semantics**

The members of a class are those specified by its
*class-member-declarations*, and the members inherited from its base
class. (A class may also contain dynamic members, as described in [§§](#dynamic-members).
However, as these have no compile-time names, they can only be accessed
via method calls).

A class may contain the following members:

-   Constants – the constant values associated with the class ([§§](#constants)).
-   Properties – the variables of the class ([§§](#properties)).
-   Methods – the computations and actions that can be performed by the
    class ([§§](#methods), [§§](#methods-with-special-semantics)).
-   Constructor – the actions required to initialize an instance of the
    class ([§§](#constructors)).
-   Destructor – the actions to be performed when an instance of the
    class is no longer needed ([§§](#destructors)).

A number of names are reserved for methods with special semantics, which
user-defined versions must follow. These are described in ([§§](#methods-with-special-semantics)).

Methods and properties can either be *static* or *instance* members. A
static member is declared using `static`. An instance member is one that
is not static. The name of a static method or property can never be used
on its own; it must always be used as the right-hand operand of the
scope resolution operator ([§§](10-expressions.md#scope-resolution-operator)). The name of an instance method or
property can never be used on its own; it must always be used as the
right-hand operand of the member selection operator ([§§](10-expressions.md#member-selection-operator)).

Each instance of a class contains its own, unique set of instance
properties of that class. An instance member is accessed via the
`->` operator ([§§](10-expressions.md#member-selection-operator)). In contrast, a static property designates
exactly one VSlot for its class, which does not belong to any instance,
per se. A static property exists whether or not any instances of that
class exist. A static member is accessed via the `::` operator ([§§](10-expressions.md#scope-resolution-operator)).

When any instance method operates on a given instance of a class, within
that method that object can be accessed via `$this` ([§§](10-expressions.md#general-1)). As a
static method does not operate on a specific instance, it has no `$this`.

**Examples**

```PHP
class Point 
{
  private static $pointCount = 0;     // static property

  private $x;             // instance property
  private $y;             // instance property

  public static function getPointCount()    // static method
  {
    return self::$pointCount;     // access static property
  }
  public function move($x, $y)        // instance method
  {
    $this->x = $x;
    $this->y = $y;
  }
  public function __construct($x = 0, $y = 0) // instance method
  {
    $this->x = $x;          // access instance property
    $this->y = $y;          // access instance property
    ++self::$pointCount;    // access static property
  }
  public function __destruct()      // instance method
  {
    --self::$pointCount;        // access static property
    ...
  }
  ...
}
echo "Point count = " . Point::getPointCount() . "\n";
$cName = 'Point';
echo "Point count = " . $cName::getPointCount() . "\n";
```

##Dynamic Members

Ordinarily, all of the instance properties and methods of a class are
declared explicitly in that class's definition. However, other
members—*dynamic properties* and, under certain circumstances, *dynamic
methods*—can be added to a particular instance of a class or to the
class as a whole at runtime. A dynamic property can also be removed from
an instance at runtime. In the case of dynamic properties, if a class
makes provision to do so by defining a series of special methods, it can
deal with the allocation and management of storage for those properties,
by storing them in another object or in a database, for example. (The
default behavior is for the Engine to allocate a VSlot for each one).
This is called *class-specific dynamic allocation*. Otherwise, the
Engine takes care of the storage in some unspecified manner. Dynamic
method handling is only possible when ** class-specific dynamic
allocation is used.

Consider the following scenario, which involves dynamic properties:

```PHP
class Point { ... } // has no public property "color", but has made
                    // provision to support dynamic properties.
$p = new Point(10, 15);
$p->color = "red"; // create/set the dynamic property "color"
$v = $p->color;    // get the dynamic property "color"
isset($p->color);  // test if the dynamic property "color" exists
unset($p->color);  // remove the dynamic property "color"
```

For the ** class-specific dynamic allocation scenario, when a property
name that is not currently visible (because it is hidden or it does not
exist) is used in a modifiable lvalue context (as with the assignment of
"red"), the Engine generates a call to the instance method `__set`
([§§](#method-__set)). This method treats that name as designating a dynamic
property of the instance being operated on, and sets its value to "red",
creating the property, if necessary. Similarly, in a non-lvalue context,
(as with the assignment of color to $v), the Engine generates a call to
the instance method `__get` ([§§](#method-__get)), which treats that name as
designating a dynamic property of the instance being operated on, and
gets its value. In the case of the call to the intrinsic `isset`
([§§](10-expressions.md#isset)), this generates a call to the instance method `__isset`
([§§](#method-__isset)), while a call to the intrinsic `unset` ([§§](10-expressions.md#unset)) generates a
call to the instance method `__unset` ([§§](#method-__unset)). By defining these
four special methods, the implementer of a class can control how dynamic
properties are handled. For the non-class-specific dynamic allocation
scenario, the process is like that above except that no special `__*`
methods are called.

In the case of a dynamic method, no method is really added to the
instance or the class. However, the illusion of doing that is achieved
by allowing a call to an instance or static method, but one which is not
declared in that instance's class, to be accepted, intercepted by a
method called `__call` ([§§](#method-__call)) or `__callStatic` ([§§](#method-__callstatic)), and
dealt with under program control.

Consider the following code fragment, in which class Widget has neither
an instance method called `iMethod` nor a static method called `sMethod`,
but that class has made provision to deal with dynamic methods:

```PHP
$obj = new Widget;
$obj->iMethod(10, TRUE, "abc");
Widget::sMethod(NULL, 1.234);
```

The call to `iMethod` is treated as if it were

```PHP
$obj->__call('iMethod', array(10, TRUE, "abc"))
```

and the call to `sMethod` is treated as if it were

```PHP
Widget::__callStatic('sMethod', array(NULL, 1.234))
```

##Constants

**Syntax**

<pre>
  <i>const-declaration:</i>
    const  <i>name</i>  =  <i>constant-expression</i>   ;
</pre>

*name* is defined in ([§§](09-lexical-structure.md#names)). *constant-expression* is defined in
([§§](10-expressions.md#constant-expressions)).

**Constraints:**

A *const-declaration* must only appear at the top level of a script, be
a *class constant* (inside a *class-definition*; [§§](#class-members)) or be an
*interface constant* (inside an *interface-definition;* [§§](15-interfaces.md#interface-members)).

A *const-declaration* must not redefine an existing c-constant ([§§](06-constants.md#general)).

A class constant must not have an explicit visibility specifier ([§§](#general)).

A class constant must not have an explicit `static` specifier.

**Semantics:**

A *const-declaration* defines a c-constant.

All class constants have public visibility.

All constants are implicitly `static`.

**Examples:**

```PHP
const MIN_VAL = 20;
const LOWER = MIN_VAL;
// -----------------------------------------
class Automobile
{
  const DEFAULT_COLOR = "white";
  ...
}
$col = Automobile::DEFAULT_COLOR;
```

##Properties

**Syntax**

<pre>
  <i>property-declaration:</i>
    <i>property-modifier   name   property-initializer<sub>opt</sub></i>  ;

  <i>property-modifier:</i>
    var
    <i>visibility-modifier   static-modifier<sub>opt</sub></i>
    <i>static-modifier   visibility-modifier<sub>opt</sub></i>

  <i>visibility-modifier:</i>
    public
    protected
    private

  <i>static-modifier:</i>
    static

  <i>property-initializer:</i>
    =  <i>constant-expression</i>
</pre>


*name* is described in [§§](09-lexical-structure.md#names) and *constant-expression* is described
in [§§](10-expressions.md#constant-expressions).

**Semantics**

A *property-declaration* defines an instance or static property.

The visibility modifiers are described in [§§](#general). If
*visibility-modifier* is omitted, public is assumed. The var modifier
implies public visibility. The `static` modifier is described in [§§](#class-members).

The *property-initializer*s for instance properties are applied prior to
the class's constructor being called.

An instance property that is visible may be unset ([§§](10-expressions.md#unset)), in which
case, the property is actually removed from that instance.

**Examples**

```PHP
class Point 
{
  private static $pointCount = 0; // static property with initializer
  
  private $x; // instance property
  private $y; // instance property
  ...

}
```

##Methods

**Syntax**

<pre>
  method-declaration:
    <i>method-modifiers<sub>opt</sub>   function-definition</i>
    <i>method-modifiers   function-definition-header</i>  ;

  <i>method-modifiers:</i>
    <i>method-modifier</i>
    <i>method-modifiers   method-modifier</i>

  <i>method-modifier:</i>
    <i>visibility-modifier</i>
    <i>static-modifier</i>
    abstract
    final
</pre>

*visibility-modifier* is described in [§§](#general); *static-modifier* is
described in [§§](#class-members); and *function-definition* and
*function-definition-header* are defined in [§§](13-functions.md#function-definitions).

**Constraints**

When defining a concrete class that inherits from an abstract class, the
definition of each abstract method inherited by the derived class must
have the same or a
less-restricted [visibility](http://php.net/manual/language.oop5.visibility.php)
than in the corresponding abstract declaration. Furthermore, the
signature of a method definition must match that of its abstract
declaration.

The *method-modifiers* preceding a *function-definition* must not contain
the `abstract` modifier.

The *method-modifiers* preceding a *function-definition-header* must
contain the `abstract` modifier.

A method must not have the same modifier specified more than once. A
method must not have more than one *visibility-modifier*. A method must
not have both the modifiers `abstract` and `private`, or `abstract` and `final`.

**Semantics**

A *method-declaration* defines an instance or static method. A method is
a function that is defined inside a class. However, the presence of
`abstract` indicates an abstract method, in which case, no implementation
is provided. The absence of `abstract` indicates a concrete method, in
which case, an implementation is provided.

Method names are case-insensitive.

The presence of `final` indicates the method cannot be overridden in a
derived class.

If *visibility-modifier* is omitted, `public` is assumed.

**Examples**

See [§§](#class-members) for examples of instance and static methods. See [§§](#class-declarations) for
examples of abstract methods and their subsequent definitions.

##Constructors

**Syntax**

<pre>
  <i>constructor-definition:</i>
    <i>visibility-modifier</i>  function &<sub>opt</sub>   __construct  (  <i>parameter-declaration-list<sub>opt</sub></i>  )  <i>compound-statement</i>
    <i>visibility-modifier</i>  function &<sub>opt</sub>    <i>name</i>  (  <i>parameter-declaration-list<sub>opt</sub></i>  )  <i>compound-statement </i>    <b>[Deprecated form]</b>

</pre>

*visibility-modifier* is described in [§§](#general);
*parameter-declaration-list* is described in [§§](13-functions.md#function-definitions); and
*compound-statement* is described in [§§](11-statements.md#compound-statements). *name* is described in
[§§](09-lexical-structure.md#names).

**Constraints**

An overriding constructor in a derived class must have the same or a
less-restricted [visibility](http://php.net/manual/language.oop5.visibility.php)
than that being overridden in the base class.

*name* must be the same as that in the *class-declaration* ([§§](#class-declarations)) that
contains this *constructor-definition*.

**Semantics**

A constructor is a specially named instance method ([§§](#methods)) that is used
to initialize an instance immediately after it has been created. Any
instance properties not explicitly initialized by a constructor take on
the value `NULL`. Like a method, a constructor can return a result by
value or byRef. (Unlike a method, a constructor cannot be abstract or
static).

If *visibility-modifier* is omitted, `public` is assumed. A `private`
constructor inhibits the creation of an instance of the class type.

Constructors can be overridden in a derived class by redeclaring them.
However, an overriding constructor need not have the same signature as
defined in the base class.

Constructors are called by *object-creation-expression*s ([§§](10-expressions.md#the-new-operator))
and from within other constructors.

If classes in a derived-class hierarchy have constructors, it is the
responsibility of the constructor at each level to call the constructor
in its base-class explicitly, using the notation
`parent::__construct(...)`. If a constructor calls its base-class
constructor, it should do so as the first statement in
*compound-statement*, so the object hierarchy is built from the
bottom-up. A constructor should not call its base-class constructor more
than once. A call to a base-class constructor searches for the nearest
constructor in the class hierarchy. Not every level of the hierarchy
need have a constructor.

Prior to the addition of the `__construct` form of constructor, a
class's constructor was called the same as its class name. For example,
class `Point`'s constructor was called `Point`. Although this old-style form
is supported, its use is deprecated. In any event, both
`parent::__construct(...)` and `parent::name(...)` (where `name` is the name
of the parent class type) will find an old- or a new-style constructor
in the base class, if one exists. If both forms exist, the new-style one
is used. The same is true of an *object-creation-expression* when
searching for a base-class constructor.

**Examples**

```PHP
class Point 
{
  private static $pointCount = 0;
  private $x;
  private $y;
  public function __construct($x = 0, $y = 0)
  {
    $this->x = $x;
    $this->y = $y;
    ++self::$pointCount;
  }
  public function __destruct()
  {
    --self::$pointCount;
    ...
  }
  ...
}
// -----------------------------------------
class MyRangeException extends Exception 
{
  public function __construct($message, ...)
  {
    parent::__construct($message);
    ...
  }
  ...
}
```

##Destructors

**Syntax**

<pre>
  <i>destructor-definition:</i>
    <i>visibility-modifier</i>  function  &<sub>opt</sub>  __destruct  ( ) <i>compound-statement</i>
</pre>

*visibility-modifier* is described in [§§](#general) and *compound-statement* is
described in [§§](11-statements.md#compound-statements).

**Constraints**

An overriding destructor in a derived class must have the same or a
less-restricted [visibility](http://php.net/manual/language.oop5.visibility.php)
than that being overridden in the base class.

**Semantics**

A destructor is a special-named instance method ([§§](#methods)) that is used to
free resources when an instance is no longer needed. The destructors for
instances of all classes are called automatically once there are no
handles pointing to those instances or in some unspecified order during
program shutdown. Like a method, a destructor can return a result by
value or byRef. (Unlike a method, a destructor cannot be abstract or
static).

If *visibility-modifier* is omitted, `public` is assumed.

Destructors can be overridden in a derived class by redeclaring them.

Destructors are called by the Engine or from within other destructors.

If classes in a derived-class hierarchy have destructors, it is the
responsibility of the destructor at each level to call the destructor in
the base-class explicitly, using the notation `parent::__destruct()`. If
a destructor calls its base-class destructor, it should do so as the
last statement in *compound-statement*, so the object hierarchy is
destructed from the top-down. A destructor should not call its
base-class destructor more than once. A call to a base-class destructor
searches for the nearest destructor in the class hierarchy. Not every
level of the hierarchy need have a destructor. A `private` destructor
inhibits destructor calls from derived classes.

Any dynamic properties
([§](http://docs.oracle.com/javase/specs/jls/se7/html/jls-15.html#jls-15.12)14.4,
[§](http://docs.oracle.com/javase/specs/jls/se7/html/jls-15.html#jls-15.12)14.10.8)
having an object type, and whose parent instances exist when the program
terminates will have their destructors (if any) called as part of the
cleanup of the parent instances, even if the parent class type has no
destructor defined.

**Examples**

See [§§](#constructors) for an example of a constructor and destructor.

##Methods with Special Semantics

###General

If a class contains a definition for a method having one of the
following names, that method must have the prescribed visibility,
signature, and semantics:

Method Name | Description | Reference
------------|-------------|----------
`__call` | Calls a dynamic method in the context of an instance-method call | [§§](#method-__call)
`__callStatic` | Calls a dynamic method in the context of a static-method call | [§§](#method-__callstatic)
`__clone` | Typically used to make a deep copy ([§§](#)) of an object | [§§](#method-__clone)
`__construct` | A constructor |   [§§](#constructors)
`__destruct` | A destructor | [§§](#destructors)
`__get` | Retrieves the value of a given dynamic property | [§§](#method-__get)
`__invoke` | Called when a script calls an object as a function | [§§](#method-__invoke)
`__isset` | Reports if a given dynamic property exists |  [§§](#method-__isset)
`__set` | Sets the value of a given dynamic property |  [§§](#method-__set) 
`__set_state` | Called when a class is exported by `var_export` (§xx) | [§§](#method-__set_state)
`__sleep` | Executed before serialization ([§§](#serialization)) of an instance of this class | [§§](#method-__sleep)
`__toString` | Returns a string representation of the instance on which it is called |  [§§](#method-__tostring)
`__unset` | Removes a given dynamic property |  [§§](#method-__unset)
`__wakeup` | Executed after unserialization ([§§](#serialization)) of an instance of this class | [§§](#method-__wakeup)

###Method `__call`

**Syntax**

<pre>
  public  function  __call  (  <i>$name</i>  ,  <i>$arguments</i>  )  <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Constraints**

The argument corresponding to `$name` must have type `string`, and that
corresponding to `$arguments` must have type `array`.

The arguments passed to this method must not be passed byRef.

**Semantics**

This instance method is called to invoke the dynamic method ([§§](#dynamic-members))
designated by `$name` using the arguments specified by the elements of
the array designated by `$arguments`. It can return any value deemed
appropriate.

Typically, `__call` is called implicitly, when the `->` operator
([§§](10-expressions.md#member-selection-operator)) is used to call an instance method that is not visible. Now
while `__call` can be called explicitly, the two scenarios do not
necessarily produce the same result. Consider the expression `p->m(...)`,
where `p` is an instance and `m` is an instance-method name. If `m` is the
name of a visible method, `p->m(...)` does not result in `__call`'s being
called. Instead, the visible method is used. On the other hand, the
expression `p->__call('m',array(...))` always calls the named dynamic
method, ignoring the fact that a visible method having the same name
might exist. If `m` is not the name of a visible method, the two
expressions are equivalent; that is; when handling `p->m(...)`, if no
visible method by that name is found, a dynamic method is assumed, and
`__call` is called. (Note: While it would be unusual to create
deliberately a dynamic method with the same name as a visible one, the
visible method might be added later. This name "duplication" is
convenient when adding a dynamic method to a class without having to
worry about a name clash with any method names that class inherits).

While a method-name source token has a prescribed syntax, there are no
restrictions on the spelling of the dynamic method name designated by
*$name*. Any source character is allowed here.

**Examples**

```PHP
class Widget
{
  public function __call($name, $arguments)
  {
    // using the method name and argument list, redirect/process
    // the method call, as desired.
  }
  ...
}
$obj = new Widget;
$obj->iMethod(10, TRUE, "abc"); // $obj->__call('iMethod', array(...))
```

###Method `__callStatic`

**Syntax**

<pre>
  public  static  function  __callStatic  (  <i>$name</i>  ,  <i>$arguments</i>  )   <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Constraints**

The argument corresponding to `$name` must have type `string`, and that
corresponding to `$arguments` must have type `array`.

The arguments passed to this method must not be passed byRef.

**Semantics**

This static method is called to invoke the dynamic method ([§§](#dynamic-members))
designated by `$name` using the arguments specified by the elements of
the array designated by `$arguments`. It can return any value deemed
appropriate.

Typically, `__callStatic` is called implicitly, when the `::` operator
([§§](10-expressions.md#scope-resolution-operator)) is used to call a static method that is not visible. Now while
`__callStatic` can be called explicitly, the two scenarios do not
necessarily produce the same result. Consider the expression `C::m(...)`,
where `C` is a class and `m` is a static-method name. If `m` is the name of a
visible method, `C::m(...)` does not result in `__callStatic`'s being
called. Instead, the visible method is used. On the other hand, the
expression `C::__callStatic('m',array(...))` always calls the named
dynamic method, ignoring the fact that a static visible method having
the same name might exist. If m is not the name of a visible method, the
two expressions are equivalent; that is; when handling `C::m(...)`, if no
visible method by that name is found, a dynamic method is assumed, and
`__callStatic` is called. (Note: While it would be unusual to create
deliberately a static dynamic method with the same name as a static
visible one, the visible method might be added later. This name
"duplication" is convenient when adding a dynamic method to a class
without having to worry about a name clash with any method names that
class inherits).

While a method-name source token has a prescribed syntax, there are no
restrictions on the spelling of the dynamic method name designated by
`$name`. Any source character is allowed here.

**Examples**

```PHP
class Widget
{
    public static function __callStatic($name, $arguments)
    {
      // using the method name and argument list, redirect/process\
      // the method call, as desired.
    }
    ...
}

Widget::sMethod(NULL, 1.234); // Widget::__callStatic('sMethod', array(...))
```

###Method `__clone`

**Syntax**

<pre>
  public  function  __clone  (  )  <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Semantics**

This instance method is called by the `clone` operator ([§§](10-expressions.md#the-clone-operator)),
(typically) to make a deep copy ([§§](#)) of the current class component of the instance on which it is
called. (Method `__clone` cannot be called directly by the program).

Consider a class `Employee`, from which is derived a class `Manager`. Let us
assume that both classes contain properties that are objects. To make a
copy of a `Manager` object, its `__clone` method is called to do whatever
is necessary to copy the properties for the `Manager` class. That method
should, in turn, call the `__clone` method of its parent class,
`Employee`, so that the properties of that class can also be copied (and
so on, up the derived-class hierarchy).

To clone an object, the `clone` operator makes a shallow copy ([§§](#)) of the object on which it is called.
Then, if the class of the instance being cloned has a method called
`__clone`, that method is automatically called to make a deep copy.
Method `__clone` cannot be called directly from outside a class; it can
only be called by name from within a derived class, using the notation
`self::__clone()`. This method can return a value; however, if it does
so and control returns directly to the point of invocation via the `clone`
operator, that value will be ignored. The value returned to a
`self::__clone()` call can, however, be retrieved.

While cloning creates a new object, it does so without using a
constructor, in which case, code may need to be added to the `__clone`
method to emulate what happens in a corresponding constructor. (See the
`Point` example below).

An implementation of `__clone` should factor in the possibility of an
instance having dynamic properties ([§§](#dynamic-members)).

**Examples**

```PHP
class Employee
{
  ...
  public function __clone() 
  {
    // do what it takes here to make a copy of Employee object properties
  }
}
class Manager extends Employee
{
  ...
  public function __clone() 
  {
    parent::__clone(); // request cloning of the Employee properties

    // do what it takes here to make a copy of Manager object properties
  }
  ...
}
// -----------------------------------------
class Point 
{
  private static $pointCount = 0;
  public function __construct($x = 0, $y = 0) 
  {
    ...
    ++self::$pointCount;
  }
  public function __clone() 
  {
    ++self::$pointCount; // emulate the constructor
  }
  ...
}
$p1 = new Point;  // created using the constructor
$p2 = clone $p1;  // created by cloning
```

###Method `__get`

**Syntax**

<pre>
  public  function  &<sub>opt</sub>  __get  (  <i>$name</i>  )   <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Constraints**

The argument passed to this method must have type `string` and be passed
by value.

**Semantics**

This instance method gets the value of the dynamic property ([§§](#dynamic-members))
designated by `$name`. If no such dynamic property currently exists,
`NULL` is returned.

Typically, `__get` is called implicitly, when the `->` operator ([§§](10-expressions.md#member-selection-operator))
is used in a non-lvalue context and the named property is not visible.
Now while `__get` can be called explicitly, the two scenarios do not
necessarily produce the same result. Consider the expression
`$v = $p->m`, where `p` is an instance and `m` is a property name. If `m` is
the name of a visible property, `p->m` does not result in `__get`'s being
called. Instead, the visible property is used. On the other hand, the
expression `p->__get('m')` always gets the value of the named dynamic
property, ignoring the fact that a visible property having the same name
might exist. If `m` is not the name of a visible property, the two
expressions are equivalent; that is; when handling `p->m` in a non-lvalue
context, if no visible property by that name is found, a dynamic
property is assumed, and `__get` is called.

Consider the expression `$v = $p->m = 5`, where `m` is a dynamic
property. While `__set` ([§§](#method-__set)) is called to assign the value 5 to
that property, `__get` is not called to retrieve the result after that
assignment is complete.

If the dynamic property is an array, `__get` should return byRef, so
subscripting can be done correctly on the result.

**Examples**

```PHP
class Point 
{
    private $dynamicProperties = array();
    private $x;
    private $y;
    public function __get($name)
    {
        if (array_key_exists($name, $this->dynamicProperties))
        {
            return $this->dynamicProperties[$name];
        }

        // no-such-property error handling goes here
        return NULL;
    }
  ...
}
```

**Implementation Notes**

Consider the following class, which does **not** contain a property
called prop:

```PHP
class C
{
  public function __get($name)
  {
    return $this->$name;    // must not recurse
  }
  ...
}
$c = new C;
$x = $c->prop;
```


As no property (dynamic or otherwise) by the name prop exists in the
class and a `__get` method is defined, this looks look a recursive
situation. However, the implementation must not allow that. The same
applies to seemingly self-referential implementations of `__set`
([§§](#method-__set)), `__isset` ([§§](#method-__isset)), and `__unset` ([§§](#method-__unset)).

###Method `__invoke`

**Syntax**

<pre>
public  function  __invoke  ( <i>parameter-declaration-list<sub>opt</sub></i>  )  <i>compound-statement</i>
</pre>

*parameter-declaration-list* is defined in [§§](13-functions.md#function-definitions); *compound-statement*
is described in [§§](11-statements.md#compound-statements).

**Semantics**

This instance method allows an instance to be used with function-call
notation. An instance whose class provides this method will return `TRUE`
when passed to `is_callable` (§xx); otherwise, `FALSE` is returned.

When an instance is called as a function, the argument list used is made
available to `__invoke`, whose return value becomes the value of the
initial function call.

**Examples**

```PHP
class C
{
  public function __invoke($p)
  {
    ...
    return ...;
  }
  ...
}
$c = new C;
is_callable($c) // returns TRUE
$r = $c(123);   // becomes $r = $c->__invoke(123);
```

###Method `__isset`

**Syntax**

<pre>
public  function  __isset  (  <i>$name</i>  )  <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Constraints**

The argument passed to this method must have type `string` and be passed
by value.

**Semantics**

If the dynamic property ([§§](#dynamic-members)) designated by `$name` exists, this
instance method returns `TRUE`; otherwise, `FALSE` is returned.

Typically, `__isset` is called implicitly, when the intrinsic `isset`
([§§](10-expressions.md#isset)) is called with an argument that designates a property that
is not visible. (It can also be called by the intrinsic empty
([§§](10-expressions.md#empty))). Now while `__isset` can be called explicitly, the two
scenarios do not necessarily produce the same result. Consider the
expression `isset($p->m)`, where `p` is an instance and `m` is a property
name. If `m` is the name of a visible property, `__isset` is not called.
Instead, the visible property is used. On the other hand, the expression
`p->__isset('m')` always tests for the named dynamic property, ignoring
the fact that a visible property having the same name might exist. If `m`
is not the name of a visible property, the two expressions are
equivalent; that is; when handling `p->m` in a non-lvalue context, if no
visible property by that name is found, a dynamic property is assumed.

**Examples**

```PHP
class Point 
{
    private $dynamicProperties = array();
    private $x;
    private $y;
    public function __isset($name)
    {
        return isset($this->dynamicProperties[$name]);
    }
  ...
}
```

**Implementation Notes**

See the Implementation Notes for `__get` ([§§](#method-__get)).

###Method `__set`

**Syntax**

<pre>
public  function  __set  (  <i>$name</i>  ,  <i>$value</i>  )  <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Constraints**

The arguments passed to this method must not be passed byRef.

The argument corresponding to `$name` must have type `string`.

**Semantics**

This instance method sets the value of the dynamic property ([§§](#dynamic-members))
designated by `$name` to `$value`. If no such dynamic property
currently exists, it is created. No value is returned.

Typically, `__set` is called implicitly, when the `->` operator ([§§](10-expressions.md#member-selection-operator))
is used in a modifiable lvalue context and the named property is not
visible. Now while `__set` can be called explicitly, the two scenarios
do not necessarily produce the same result. Consider the expression
`p->m = 5`, where `p` is an instance and `m` is a property name. If `m` is the
name of a visible property, `p->m` does not result in `__set`'s being
called. Instead, the visible property is used. On the other hand, the
expression `p->__set('m',5)` always sets the value of the named dynamic
property, ignoring the fact that a visible property having the same name
might exist. If `m` is not the name of a visible property, the two
expressions are equivalent; that is; when handling `p->m`, if no visible
property by that name is found, a dynamic property is assumed, and
`__set` is called. (Note: While it would be unusual to create
deliberately a dynamic property with the same name as a visible one, the
visible property might be added later. This name "duplication" is
convenient when adding a dynamic property to a class without having to
worry about a name clash with any property names that class inherits).

The parameter `$value` can have any type including an object type, and
that type could have a destructor. Any dynamic properties of such types,
whose parent instances exist when the program terminates will have their
destructors called as part of the cleanup of the parent instances, even
if the parent class type has no destructor defined.

While a property-name source token has a prescribed syntax, there are no
restrictions on the spelling of the dynamic property name designated by
`$name`. Any source character is allowed here.

**Examples**

```PHP
class Point 
{
    private $dynamicProperties = array();
    private $x;
    private $y;
    public function __set($name, $value)
    {
        $this->dynamicProperties[$name] = $value;
    }
  ...
}
// -----------------------------------------
class X
{
    public function __destruct() { ... }
}
$p = new Point(5, 9);
$p->thing = new X;  // set dynamic property "thing" to instance with destructor
...
// at the end of the program, p->thing's destructor is called
```

**Implementation Notes**

See the Implementation Notes for `__get` ([§§](#method-__get)).

###Method `__set_state`

**Syntax**

<pre>
static public  function  __set_state  ( array  <i>$properties</i>  )  <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Constraints**

`$properties` must contain a key/value pair for each instance property
in the class and all its direct and indirect base classes, where each
key is the name of a property in that class.

**Semantics**

This function supports the library function `var_export` (§xx) when it is
given an instance of this class type. `var_export` takes a variable and
produces a string representation of that variable as valid PHP code
suitable for use with the intrinsic `eval` ([§§](10-expressions.md#eval)).

For an object, the string returned by `var_export` has the following
general format:

`classname::__set_state(array('prop1' => value, ..., 'propN'
=> value , ))`

where the property names `prop1` through `propN` do not include a
leading dollar (`$`). This string contains a call to the `__set_state`
method even if no such method is defined for this class or in any of its
base classes, in which case, a subsequent call to `eval` using this string
will fail. To allow the string to be used with eval, the method
`__set_state` must be defined, and it must create a new instance of the
class type, initialize its instance properties using the key/value pairs
in `$properties`, and it must return that new object.

If a derived class does not define a `__set_state` method, a call to it
will look for such a method in the base class hierarchy, and that method
will return an instance of the appropriate base class, not of the class
on which it was invoked. This is probably not what the programmer
expected. If a derived class defines a `__set_state` method, but any
base class has instance properties that are not visible within that
method, that method must invoke parent's `__set_state` as well, but
that can require support from a base class. See the second example
below.

**Examples**

```PHP
class Point 
{
  private $x;
  private $y;
  static public function __set_state(array $properties)
  {
    $p = new Point;
    $p->x = $properties['x'];
    $p->y = $properties['y'];
    return $p;
  }
  ...
}
$p = new Point(3, 5);
$v = var_export($p, TRUE);  // returns string representation of $p
```
The string produced looks something like the following:

```PHP
"Point::__set_state(array(
   'x' => 3,
   'y' => 5,
))" 
eval('$z = ' . $v . ";"); // execute the string putting the result in $z
echo "Point \$z is $z\n"; // Point $z is (3,5)
// -----------------------------------------
class B // base class of D
{
  private $bprop;
  public function __construct($p)
  {
    $this->bprop = $p;
  }
  static public function __set_state(array $properties)
  {
    $b = new static($properties['bprop']);  // note the static
    return $b;
    // Because of the "new static", the return statement
    //   returns a B when called in a B context, and
    //   returns a D when called in a D context
  }
}
class D extends B
{
  private $dprop = 123;
  public function __construct($bp, $dp = NULL)
  {
    $this->dprop = $dp;
    parent::__construct($bp);
  }
  static public function __set_state(array $properties)
  {
    $d = parent::__set_state($properties); // expects back a D, NOT a B
    $d->dprop = $properties['dprop'];
    return $d;
  }
}
$b = new B(10);
$v = var_export($b, TRUE);
eval('$z = ' . $v . ";");
$d = new D(20, 30);
$v = var_export($d, TRUE);
eval('$z = ' . $v . ";");
```

###Method `__sleep`

**Syntax**

<pre>
public  function  __sleep  ( ) <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Semantics**

The instance methods `__sleep` and `__wakeup` ([§§](#method-__wakeup)) support
serialization ([§§](#serialization)).

If a class has a `__sleep` method, the library function `serialize` (§xx)
calls that method to find out which visible instance properties it
should serialize. (In the absence of a `__sleep` or `serialize` method,
all such properties are serialized, including any dynamic properties
([§§](#dynamic-members))). This information is returned by `__sleep` as an array of zero
or more elements, where each element's value is distinct and is the name
of a visible instance property. These properties' values are serialized
in the order in which the elements are inserted in the array. If
`__sleep` does not return a value explicitly, `NULL` is returned, and that
value is serialized.

Besides creating the array of property names, `__sleep` can do whatever
else might be needed before serialization occurs.

Consider a `Point` class that not only contains x- and y-coordinates, it
also has an `id` property; that is, each distinct `Point` created during a
program's execution has a unique numerical id. However, there is no need
to include this when a `Point` is serialized. It can simply be recreated
when that `Point` is unserialized. This information is transient and need
not be preserved across program executions. (The same can be true for
other transient properties, such as those that contain temporary results
or run-time caches).

In the absence of methods `__sleep` and `__wakeup`, instances of derived
classes can be serialized and unserialized. However, it is not possible
to perform customize serialization using those methods for such
instances. For that, a class must implement the interface Serializable
([§§](15-interfaces.md#interface--serializable)).

**Examples**

```PHP
class Point 
{
  private static $nextId = 1;
  private $x;
  private $y;
  private $id;
  public function __construct($x = 0, $y = 0) 
  {
    $this->x = $x;
    $this->y = $y;
    $this->id = self::$nextId++;  // assign the next available id
  }
  public function __sleep() 
  {
    return array('y', 'x'); // serialize only $y and $x, in that order
  }
  public function __wakeup() 
  {
    $this->id = self::$nextId++;  // assign a new id
  }
  ...
}
$p = new Point(-1, 0);
$s = serialize($p);   // serialize Point(-1,0)
$v = unserialize($s); // unserialize Point(-1,0)
```

###Method `__toString`

**Syntax**

<pre>
public  function  __toString  ( )  <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Constraints**

This function must return a string.

This function must not throw any exceptions.

**Semantics**

This instance method is intended to create a string representation of
the instance on which it is called. If the instance's class is derived
from a class that has or inherits a `__toString` method, the result of
calling that method should be prepended to the returned string.

`__toString` is called by a number of language and library facilities,
including `echo`, when an object-to-string conversion is needed.
`__toString` can be called directly.

An implementation of `__toString` should factor in the possibility of an
instance having dynamic properties ([§§](#dynamic-members)).

**Examples**

```PHP
class Point 
{
  private $x;
  private $y;
  public function __construct($x = 0, $y = 0) 
  {
    $this->x = $x;
    $this->y = $y;
  }
  public function __toString() 
  {
    return '(' . $this->x . ',' . $this->y . ')';
  }
  ...
}
$p1 = new Point(20, 30);
echo $p1 . "\n";  // implicit call to __toString() returns "(20,30)"
// -----------------------------------------
class MyRangeException extends Exception 
{
  public function __toString() 
  {
    return parent::__toString()
      . string-representation-of-MyRangeException
  }
  ...
}
```

###Method `__unset`

**Syntax**

<pre>
public  function  __unset  (  <i>$name</i>  )  <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Constraints**

The argument passed to this method must have type `string` and be passed
by value.

**Semantics**

If the dynamic property ([§§](#dynamic-members)) designated by `$name` exists, it is
removed by this instance method; otherwise, the call has no effect. No
value is returned.

Typically, `__unset` is called implicitly, when the intrinsic `unset`
([§§](10-expressions.md#unset)) is called with an argument that designates a property that
is not visible. Now while `__unset` can be called explicitly, the two
scenarios do not necessarily produce the same result. Consider the
expression `unset($p->m)`, where `p` is an instance and `m` is a property
name. If `m` is the name of a visible property, `__unset` is not called.
Instead, the visible property is used. On the other hand, the expression
`p->__unset('m'))` always removes the named dynamic property, ignoring
the fact that a visible property having the same name might exist. If `m`
is not the name of a visible property, the two expressions are
equivalent; that is; when handling `p->m` in a non-lvalue context, if no
visible property by that name is found, a dynamic property is assumed.

**Examples**

```PHP
class Point 
{
    private $dynamicProperties = array();
    private $x;
    private $y;
    public function __unset($name)
    {
        unset($this->dynamicProperties[$name]);
    }
  ...
}
```

**Implementation Notes**

See the Implementation Notes for `__get` ([§§](#method-__get)).

###Method `__wakeup`

**Syntax**

<pre>
public  function  __wakeup  ( )  <i>compound-statement</i>
</pre>

*compound-statement* is described in [§§](11-statements.md#compound-statements).

**Constraints**

Xx

**Semantics**

The instance methods `__sleep` ([§§](#method-__sleep)) and `__wakeup` support
serialization ([§§](#serialization)).

When the library function `unserialize` (§xx) is called on the string
representation of an object, as created by the library function
`serialize` (§xx), `unserialize` creates an instance of that object's type
**without calling a constructor**, and then calls that class's
`__wakeup` method, if any, to initialize the instance. In the absence of
a `__wakeup` method, all that is done is that the values of the instance
properties encoded in the serialized string are restored.

Consider a `Point` class that not only contains x- and y-coordinates, it
also has an `id` property; that is, each distinct `Point` created during a
program's execution has a unique numerical id. However, there is no need
to include this when a `Point` is serialized. It can simply be recreated
by `__wakeup` when that `Point` is unserialized. This means that
`__wakeup` must emulate the constructor, as appropriate.

`__wakeup` does not return a value.

**Examples**

See [§§](#method-__sleep).

##Serialization

In PHP, variables can be converted into some external form suitable for
use in file storage or inter-program communication. The process of
converting to this form is known as *serialization* while that of
converting back again is known as *unserialization*. These facilities
are provided by the library functions `serialize` (§xx) and `unserialize`
(§xx), respectively.

In the case of variables that are objects, on their own, these two
functions serialize and unserialize all the instance properties, which
may be sufficient for some applications. However, if the programmer
wants to customize these processes, they can do so in one of two,
mutually exclusive ways. The first approach is to define methods called
`__sleep` and `__awake`, and have them get control before serialization
and after serialization, respectively. For information on this approach,
see [§§](#method-__sleep) and [§§](#method-__wakeup). The second approach involves implementing
the interface `Serializable` ([§§](15-interfaces.md#interface--serializable)) by defining two methods, `serialize`
and `unserialize`.

Consider a `Point` class that not only contains x- and y-coordinates, it
also has an `id` property; that is, each distinct `Point` created during a
program's execution has a unique numerical id. However, there is no need
to include this when a `Point` is serialized. It can simply be recreated
when that `Point` is unserialized. This information is transient and need
not be preserved across program executions. (The same can be true for
other transient properties, such as those that contain temporary results
or run-time caches). Furthermore, consider a class `ColoredPoint` that
extends `Point` by adding a `color` property. The following code shows how
these classes need be defined in order for both `Points` and `ColoredPoints`
to be serialized and unserialized:

```PHP
class Point implements Serializable // note the interface
{
  private static $nextId = 1;
  private $x;
  private $y;
  private $id;  // transient property; not serialized
  public function __construct($x = 0, $y = 0) 
  {
    $this->x = $x;
    $this->y = $y;
    $this->id = self::$nextId++;
  }
  public function __toString() 
  {
    return 'ID:' . $this->id . '(' . $this->x . ',' . $this->y . ')';
  }
  public function serialize() 
  {
    return serialize(array('y' => $this->y, 'x' => $this->x));
  }
```

The custom method `serialize` calls the library function `serialize` to
create a string version of the array, whose keys are the names of the
instance properties to be serialized. The insertion order of the array
is the order in which the properties are serialized in the resulting
string. The array is returned.

```PHP
  public function unserialize($data)
  {
    $data = unserialize($data);
    $this->x = $data['x'];
    $this->y = $data['y'];
    $this->id = self::$nextId++;
  }
}
```

The custom method `unserialize` converts the serialized string passed to
it back into an array. Because a new object is being created, but
without any constructor being called, the `unserialize` method must
perform the tasks ordinarily done by a constructor. In this case, that
involves assigning the new object a unique id.

```PHP
$p = new Point(2, 5);
$s = serialize($p);
```

The call to the library function `serialize` calls the custom `serialize`
method. Afterwards, the variable `$s` contains the serialized version of
the `Point(2,5)`, and that can be stored in a database or transmitted to a
cooperating program. The program that reads or receives that serialized
string can convert its contents back into the corresponding variable(s),
as follows:

```PHP
$v = unserialize($s);
```

The call to the library function `unserialize` calls the custom
`unserialize` method. Afterwards, the variable `$s` contains a new
`Point(2,5)`.


```PHP
class ColoredPoint extends Point implements Serializable
{
  const RED = 1;
  const BLUE = 2;

  private $color; // an instance property

  public function __construct($x = 0, $y = 0, $color = RED) 
  {
    parent::__construct($x, $y);
    $this->color = $color;
  }

  public function __toString() 
  {
    return parent::__toString() . $this->color;
  }

  public function serialize() 
  {
    return serialize(array(
      'color' => $this->color,
      'baseData' => parent::serialize()
    ));
  }
```

As with class `Point`, this custom method returns an array of the instance
properties that are to be serialized. However, in the case of the second
element, an arbitrary key name is used, and its value is the serialized
version of the base Point within the current `ColoredPoint` object. The
order of the elements is up to the programmer.

```PHP
    public function unserialize($data)
    {
    $data = unserialize($data);
    $this->color = $data['color'];
    parent::unserialize($data['baseData']);
    }
}
```

As `ColoredPoint` has a base class, it unserializes its own instance
properties before calling the base class's custom method, so it can
unserialize the `Point` properties.

```PHP
$cp = new ColoredPoint(9, 8, ColoredPoint::BLUE);
$s = serialize($cp);
...
$v = unserialize($s);
```

##Predefined Classes

### Class `Closure`

The predefined
class [`Closure`](http://php.net/manual/class.closure.php) is used
for representing an [anonymous
function](http://php.net/manual/functions.anonymous.php). It
cannot be instantiated except by the Engine, as described below. Closure objects are immutable and must not permit the creation or modification of properties.

Closures can be *bound*, *unbound* or *static*. If a closure is said to be 
bound, then it has an object that `$this` will be bound to when called. If a
closure is unbound, then it has no object `$this` will be bound to. If a closure
is static, then it cannot be bound.

Closures can be *scoped* or *unscoped*. If a closure is said to be *scoped*, it
has a class *scope* which determines the visibility of the private and protected
members of objects of tha class, including but not limited to such members on
`$this`. If a closure is said to be *unscoped*, it has no class scope set.

Closures have an invariant that scoped closures must be bound or static, and
unbound closures must be unscoped.

```PHP
class Closure
{
  public static bind(Closure $closure, $newthis [, $newscope = "static" ]);
  public bindTo($newthis [, $newscope = "static" ]);
  public call($newthis [, ...$parameters ]);
}

```

The class members are defined below:

Name | Purpose
-----|--------
`bind` | Duplicates closure `$closure` with a specific bound object `$newthis` and class scope `$newscope`. If `$newthis` is `NULL` then the closure is to be unbound if no scope is specified, or static if a scope is specified. `$newscope` is the scope the closure is to be given (either a string containing the name of a class, or an object whose class will be used), or `"static"` to keep the current one. Returns a new `Closure` object or `FALSE` on failure. This function must not violate the invariant that closures must either be both scoped and bound or static, or otherwise both unscoped and unbound. This function must prevent binding an object to the new closure if the `$closure` is static, however the new closure may have a different scope.
`bindTo` |  Duplicates the closure designated by the current instance with a new-bound object and class scope. This method is an instance version of bind. 
`call` | Calls the closure (the current instance) with `$this` bound to `$newthis`, the class scope of the class of `$newthis`, and the parameters specified by `$parameters`. This function must fail if `$newthis` is NULL, or if the closure is static.

When the anonymous function-creation operator ([§§](10-expressions.md#anonymous-function-creation)) is evaluated,
the result is an object of type `Closure` (or some unspecified class
derived from that type) created by the Engine. This object is referred
to here as "the Closure object". This instance encapsulates the
anonymous function defined in the corresponding
*anonymous-function-creation-expression*.

The contents of a `Closure` object are determined based on the context in
which an anonymous function is created. Consider the following scenario:

```PHP
class C
{
  public function compute()
  {
    $count = 0;
    $values = array("red" => 3, 10);
    $callback = function ($p1, $p2) use (&$count, $values)
    {
      ...
    };
    ...
  }
}

```

A `Closure` object may contain the following, optional dynamic properties,
in order: `static`, `this`, and `parameter`.

If an *anonymous-function-creation-expression* contains an
*anonymous-function-use-clause*, a dynamic property called `static` is
present. This is unrelated to whether a closure is said to be *static*. This
property is an array having an element for each *variable-name* in the
*use-variable-name-list*, inserted in lexical order of their appearance in the
use clause. Each element's key is the corresponding *variable-name*, and each
element value is the value of that variable at the time the time the `Closure`
object is created (not when it is used to call the encapsulated function). In
the scenario above, this leads to the following, shown as pseudo code:

```PHP
$this->static = array(["count"]=>&0,["values"]=>array(["red"]=>3,[0]=>10));
```

If an *anonymous-function-creation-expression* is used inside an
instance method, a dynamic property called `this` is present. This
property is a handle that points to the current instance. In the
scenario above, this leads to the following, shown as pseudo code:

```PHP
$this->this = $this;
```

If an *anonymous-function-creation-expression* contains a
*parameter-declaration-list*, a dynamic property called `parameter` is
present. This property is an array of one or more elements, each of
which corresponds to a parameter. The elements are inserted in that
array in lexical order of their declaration. Each element's key is the
corresponding parameter name, and each element value is some unspecified
value. (These values are overridden by the argument values used when the
anonymous function is called). In the scenario above, this leads to the
following, shown as pseudo code:

```PHP
$property = array("$p1" => ???, "$p2" => ???)
```

It is possible for all three dynamic properties to be absent, in which
case, the `Closure` object is empty.

###Class `Generator`

This class supports the `yield` operator ([§§](10-expressions.md#yield-operator)). This class cannot be
instantiated directly. It is defined, as follows:

class Generator implements Iterator

```PHP
class Generator implements Iterator
{
  public function current();
  public function key();
  public function next();
  public function rewind();
  public function send($value) ;
  public function throw(Exception $exception) ;
  public function valid();
  public function __wakeup();
}
```

The class members are defined below:

Name | Purpose
---- | -------
`current` | An implementation of the instance method `Iterator::current `([§§](15-interfaces.md#interface-iterator)).
`key` | An implementation of the instance method `Iterator::key` ([§§](15-interfaces.md#interface-iterator)).
`next` | An implementation of the instance method Iterator::next ([§§](15-interfaces.md#interface-iterator)).
`rewind` | An implementation of the instance method `Iterator::rewind` ([§§](15-interfaces.md#interface-iterator)).
`send` | This instance method sends the value designated by `$value` to the generator as the result of the current [`yield`](http://us2.php.net/manual/en/ language.generators.syntax.php#control-structures.yield) expression, and resumes execution of the generator. `$value` is the return value of the [`yield`](http://us2.php.net/manual/en/language.generators.syntax.php#control-structures.yield) expression the generator is currently at. If the generator is not at a [`yield`](http://us2.php.net/manual/en/language.generators.syntax.php#control-structures.yield) expression when this method is called, it will first be let to advance to the first [`yield`](http://us2.php.net/manual/en/language.generators.syntax.php#control-structures.yield) expression before sending the value. This method returns the yielded value.
`throw` | This instance method throws an exception into the generator and resumes execution of the generator. The behavior is as if the current [`yield`](http://us2.php.net/manual/en/language.generators.syntax.php#control-structures.yield) expression was replaced with throw `$exception`. If the generator is already closed when this method is invoked, the exception will be thrown in the caller's context instead. This method returns the yielded value.
`valid` |  An implementation of the instance method `Iterator::valid` ([§§](15-interfaces.md#interface-iterator)).
`__wakeup` | An implementation of the special instance method `__wakeup` ([§§](#method-__wakeup)). As a generator can't be serialized, this method throws an exception of an unspecified type. It returns no value.

###Class `__PHP_Incomplete_Class`

There are certain circumstances in which a program can generate an
instance of this class, which on its own contains no members. One
involves an attempt to unserialize ([§§](#method-__wakeup), [§§](#serialization)) a string that
encodes an instance of a class for which there is no definition in
scope. Consider the following class, which supports a two-dimensional
Cartesian point:

```PHP
class Point 
{
  private $x;
  private $y;
  ...
}
$p = new Point(2, 5);
$s = serialize($p); // properties $x and $y are serialized, in that order
```

Let us assume that the serialized string is stored in a database from
where it is retrieved by a separate program. That program contains the
following code, but does not contain a definition of the class Point:

```PHP
$v = unserialize($s);
```

Instead of returning a point, `Point(2, 5`), an instance of
`__PHP_Incomplete_Class` results, with the following contents:

```PHP
__PHP_Incomplete_Class
{
   __PHP_Incomplete_Class_Name => "Point"
  x:Point:private => 2
  y:Point:private => 5
}
```

The three dynamic properties ([§§](#dynamic-members)) contain the name of the unknown
class, and the name, visibility, and value of each property that was
serialized, in order of serialization.

###Class `stdClass`

This class contains no members. It can be instantiated and used as a
base class. An instance of this type is automatically created when a
non-object is converted to an object ([§§](08-conversions.md#converting-to-object-type)), or the member-selection
operator ([§§](10-expressions.md#member-selection-operator)) is applied to `NULL`, `FALSE`, or an empty string.


