#Types

##General

The meaning of a value is determined by its *type*. PHP's types are
categorized as *scalar types* and *composite types*. The scalar types
are Boolean ([§§](#the-boolean-type)), integer ([§§](#the-integer-type)), floating-point ([§§](#the-floating-point-type)), string
([§§](#the-string-type)), and null ([§§](#the-null-type)). The composite types are array ([§§](#the-array-type)),
and object ([§§](#objects)). The resource ([§§](#resources)) is an opaque type whose internal structure is not specified and depends
on the implementation.

The scalar types are *value types*. That is, a variable of scalar type
behaves as though it contains its own value.

The composite types can contain other variables, besides the variable itself, e.g.
array contains its elements and object contains its properties.

The objects and resources are *handle types*. The type contains information — in a *handle* —
that leads to the value. The differences between value and handle types become apparent
when it comes to understanding the semantics of assignment, and passing
arguments to, and returning values from, functions ([§§](04-basic-concepts.md#the-memory-model)).

Variables are not declared to have a particular type. Instead, a
variable's type is determined at runtime by the value it contains.
The same variable can contain values of different types at different times.

Useful library functions for interrogating and using type information
include `gettype` (§xx), `is_type` (§xx), `settype` (§xx), and `var_dump`
(§xx).

##Scalar Types

###General

The integer and floating-point types are collectively known as
*arithmetic types*. The library function `is_numeric` (§xx) indicates if
a given value is a number or a numeric string ([§§](#the-string-type)).

The library function `is_scalar` (§xx) indicates if a given value has a
scalar type. However, that function does not consider `NULL` to be scalar.
To test for `NULL`, use `is_null` (§xx).

Some objects may support arithmetic and other scalar operations and/or be
convertible to scalar types (this is currently available only to internal classes).
Such object types together with scalar types are called *scalar-compatible types*.
Note that the same object type may be scalar-compatible for one operation but not for another.

###The Boolean Type

The Boolean type is `bool`, for which the name `boolean` is a synonym. This
type is capable of storing two distinct values, which correspond to the
Boolean values `true` and `false` ([§§](06-constants.md#core-predefined-constants)), respectively.
The internal representation of this type and its values is unspecified.

The library function `is_bool` (§xx) indicates if a given value has type
`bool`.

###The Integer Type

There is one integer type, `int`, for which the name `integer` is a synonym.
This type is a binary, signed, arbitrary-precision integer. Its range is
limited only by available memory.

Implementations MAY choose to implement this type with an underlying native
integer type and a separate arbitrary-precision integer type, switching between
the two types as and where appropriate, so long as the observed behaviour is
identical and the two types are indistinguishable, i.e. they are, for all
intents and purposes, the same type and are reported as such.

Bitwise operations MUST use two's-complement arithmetic, however implementations
MAY choose not to use a two's-complement underlying representation.

The constants `PHP_INT_SIZE` (§[[6.3](06-constants.md#core-predefined-constants)](#core-predefined-constants)), `PHP_INT_MAX` (§[[6.3](06-constants.md#core-predefined-constants)](#core-predefined-constants)) and `PHP_INT_MIN` (§[[6.3](06-constants.md#core-predefined-constants)](#core-predefined-constants))
exist for backwards-compatibility reasons, and indicate the native integer
size of the machine (usually 32-bit or 64-bit). They do not, however, represent
the actual range and size of the PHP integer type, which is unlimited.

The library function `is_int` (§xx) indicates if a given value has type
`int`.

###The Floating-Point Type

There is one floating-point type, `float`, for which the names `double` and
`real` are synonyms. The `float` type must support at least the range and
precision of IEEE 754 64-bit double-precision representation.

The library function `is_float` (§xx) indicates if a given value has type
`float`. The library function `is_finite` (§xx) indicates if a given
floating-point value is finite. The library function `is_infinite` (§xx)
indicates if a given floating-point value is infinite. The library
function `is_nan` (§xx) indicates if a given floating-point value is a
`NaN`.

###The String Type

A string is a set of contiguous bytes that represents a sequence of zero
or more characters.

Conceptually, a string can be considered as an array ([§§](#array-types)) of
bytes—the *elements*—whose keys are the `int` values starting at zero. The
type of each element is `string`. However, a string is *not* considered a
collection, so it cannot be iterated over.

A string whose length is zero is an *empty string*.

As to how the bytes in a string translate into characters is
unspecified.

Although a user of a string might choose to ascribe special semantics to
bytes having the value `\0`, from PHP's perspective, such *null bytes*
have no special meaning. PHP does not assume strings contain any specific
data or assign special values to any bytes or sequences. However, many
library functions assume the strings they receive as arguments are UTF-8
encoded, often without explicitly mentioning that fact.

A *numeric string* is a string whose content exactly matches the pattern
defined using integer format by the production *integer-literal*
([§§](09-lexical-structure.md#integer-literals)) or using floating-point format by the production
*floating-literal* ([§§](09-lexical-structure.md#floating-point-literals)), where leading whitespace is permitted.
A *leading-numeric string* is a string whose initial characters follow
the requirements of a numeric string, and whose trailing characters are
non-numeric. A *non-numeric string* is a string that is not a numeric
string.

Only one mutation operation may be performed on a string, offset
assignment, which involves the simple assignment operator = ([§§](10-expressions.md#simple-assignment)).

The library function `is_string` (§xx) indicates if a given value has
type string.

###The Null Type

The null type has only one possible value, `NULL` ([§§](06-constants.md#core-predefined-constants)). The representation
of this type and its value is unspecified.

The library function `is_null` (§xx) indicates if a given value is `NULL`.

##Composite Types

###The Array Type

An array is a data structure that contains a collection of zero or more
elements whose values are accessed through keys that are of type `int` or
`string`. Arrays are described in [§§](12-arrays.md#arrays).

The library function `is_array` (§xx) indicates if a given value is an
array.

###Objects

An *object* is an instance of a class ([§§](14-classes.md#classes)). Each distinct
*class-declaration* ([§§](14-classes.md#class-declarations)) defines a new class type, and each class
type is an object type. The representation of object types is unspecified.

The library function `is_object` (§xx) indicates if a given value is an
object, and the library function
[`get_class`](http://php.net/manual/function.get-class.php)
(§xx) indicates the name of an object's class.

###Resources

A [*resource*](http://php.net/manual/language.types.resource.php)
is a descriptor to some sort of external entity. Examples include
files, databases, and network sockets.

A resource is an abstract entity whose representation is unspecified.
Resources are only created or consumed by the implementation; they are
never created or consumed by PHP code.

Each distinct resource has a unique identity of some unspecified form.

The library function `is_resource` (§xx) indicates if a given value is a
resource, and the library function
[`get_resource_type`](http://php.net/manual/function.get-resource-type.php)
(§xx) indicates the type of a resource.



