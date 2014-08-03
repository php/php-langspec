#Conversions

##General

Some operators implicitly convert automatically the values of operands
from one type to another. Explicit conversion is performed using the
cast operator ([§§](10-expressions.md#cast-operator)).

If an expression is converted to its own type, the type and value of the
result are the same as the type and value of the expression.

##Converting to Boolean Type

The [result type] (http://www.php.net/manual/en/language.types.boolean.php#language.types.boolean.casting) is `bool`.

If the source type is `int` or `float`, then if the source value tests equal
to 0, the result value is `FALSE`; otherwise, the result value is `TRUE`.

If the source value is `NULL`, the result value is `FALSE`.

If the source is an empty string or the string "0", the result value is
`FALSE`; otherwise, the result value is `TRUE`.

If the source is an array with zero elements, the result value is `FALSE`;
otherwise, the result value is `TRUE`.

If the source is an object, the result value is `TRUE`.

If the source is a resource, the result value is `TRUE`.

The library function `boolval` (§xx) allows values to be converted to
`bool`.

##Converting to Integer Type

The [result type](http://www.php.net/manual/en/language.types.integer.php#language.types.integer.casting)  is `int`.

If the source type is `bool`, then if the source value is `FALSE`, the
result value is 0; otherwise, the result value is 1.

If the source type is `float`, for the values `INF`, `-INF`, and `NAN`, the
result value is implementation-defined. For all other values, if the
precision can be preserved (that is, the float is within the range of an
integer), the fractional part is rounded towards zero. If the precision cannot
be preserved, the following conversion algorithm is used:

 1. The floating point remainder (wherein the remainder has the same sign as the
    dividend) of dividing the float by 2 to the power of the number of bits in
    an integer (for example, 32), rounded towards zero, is taken.
 2. If the remainder is less than zero, it is rounded towards
    infinity and 2 to the power of the number of bits is added.
 3. This result is then converted to an unsigned integer, then converted to a
    signed integer by treating the unsigned integer as a two's complement
    representation of the signed integer.

Implementations may implement this conversion differently (for example, on some
architectures there may be hardware support for this specific conversion mode)
so long as the result is the same.

If the source value is `NULL`, the result value is 0.

If the source is a numeric string or leading-numeric string ([§§](05-types.md#the-string-type))
having integer format, if the precision can be preserved the result
value is that string's integer value; otherwise, the result is
undefined. If the source is a numeric string or leading-numeric string
having floating-point format, the string's floating-point value is
treated as described above for a conversion from `float`. The trailing
non-numeric characters in leading-numeric strings are ignored.  For any
other string, the result value is 0.

If the source is an array with zero elements, the result value is 0;
otherwise, the result value is 1.

If the source is an object, the conversion is invalid.

If the source is a resource, the result is the resource's unique ID.

The library function [`intval`
(§xx)](http://php.net/manual/function.intval.php) allows values
to be converted to `int`.

##Converting to Floating-Point Type

The [result type](http://www.php.net/manual/en/language.types.float.php#language.types.float.casting) is `float`.

If the source type is `int`, if the precision can be preserved the result
value is the closest approximation to the source value; otherwise, the
result is undefined.

If the source is a numeric string or leading-numeric string ([§§](05-types.md#the-string-type))
having integer format, the string's integer value is treated as
described above for a conversion from `int`. If the source is a numeric
string or leading-numeric string having floating-point format, the
result value is the closest approximation to the string's floating-point
value. The trailing non-numeric characters in leading-numeric strings
are ignored. For any other string, the result value is 0.

If the source is an object, the conversion is invalid.

For sources of all other types, the conversion is performed by first
converting the source value to [`int`](http://php.net/manual/language.types.integer.php)
([§§](#converting-to-integer-type)) and then to `float`.

If the source is a resource, the result is the resource's unique ID.

The library function `floatval` (§xx) allows values to be converted to
float.

##Converting to String Type

The [result type](http://www.php.net/manual/en/language.types.string.php#language.types.string.casting) is string.

If the source type is `bool`, then if the source value is `FALSE`, the
result value is the empty string; otherwise, the result value is "1".

If the source type is `int` or `float`, then the result value is a string
containing the textual representation of the source value (as specified
by the library function `sprintf` (§xx)).

If the source value is `NULL`, the result value is an empty string.

If the source is an array, the result value is the string "Array".

If the source is an object, then if that object's class has a
`__toString` method ([§§](14-classes.md#method-__tostring)), the result value is the string returned
by that method; otherwise, the conversion is invalid.

If the source is a resource, the result value is an
implementation-defined string.

The library function `strval` (§xx) allows values to be converted to
string.

##Converting to Array Type

The [result type](http://www.php.net/manual/en/language.types.array.php#language.types.array.casting) is `array`.

If the source type is `bool`, `int`, `float`, or `string`, the result value is
an array of one element whose type and value is that of the source.

If the source value is `NULL`, the result value is an array of zero
elements.

If the source is an object, the result is
an [array](http://php.net/manual/language.types.array.php) of
zero or more elements, where the elements are key/value pairs
corresponding to the
[object](http://php.net/manual/language.types.object.php)'s
instance properties. The order of insertion of the elements into the
array is the lexical order of the instance properties in the
*class-member-declarations* ([§§](14-classes.md#class-members)) list. The key for a private instance
property has the form "\\0*name*\\0*name*", where the first *name* is
the class name, and the second name is the property name. The key for a
protected instance property has the form "\\0\*\\0*name*", where *name*
is that of the property. The key for a public instance property has the
form "*name*", where *name* is that of the property. The value for each
key is that from the corresponding property's initializer, if one
exists, else `NULL`.

If the source is a resource, the result is an array of one element
containing the implementation-defined value of the resource.

##Converting to Object Type

The [result type](http://www.php.net/manual/en/language.types.object.php#language.types.object.casting) is `object`.

If the source has any type other than object, the result is an instance
of the predefined class `stdClass` ([§§](14-classes.md#class-stdclass)). If the value of the source
is `NULL`, the instance is empty. If the value of the source has a scalar
type and is non-`NULL`, the instance contains a public property called
scalar whose value is that of the source. If the value of the source is
an array, the instance contains a set of public properties whose names
and values are those of the corresponding key/value pairs in the source.
The order of the properties is the order of insertion of the source's
elements.



