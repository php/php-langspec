#Terms and Definitions
For the purposes of this document, the following terms and definitions
apply:

**argument** – a value passed to a function, that is intended to
map to a corresponding parameter.

**behavior** – external appearance or action.

**behavior, implementation-defined** – behavior specific to an
implementation, where that implementation must document that behavior.

**behavior, undefined** – behavior which is not guaranteed to produce
any specific result. Usually follows an erroneous program
construct or data.

**behavior, unspecified** – behavior for which this specification
provides no requirements.

**constraint** – restriction, either syntactic or semantic, on how
language elements can be used.

**error, fatal** – a condition in which the engine cannot continue
executing the script and must terminate.

**error, fatal, catchable** – a fatal error that can be caught by a
user-defined handler.

**error, non-fatal** – an error that is not a fatal error and allows for 
the engine to continue execution.

**lvalue** – an expression that designates a location that can store
a value.

**lvalue, modifiable** – an lvalue whose value can be changed.

**lvalue, non-modifiable** – an lvalue whose value cannot be changed.

**parameter** – a variable declared in the parameter list of a function
that is intended to map to a corresponding argument in a call to that
function.

**PHP Run-Time Engine** – the software that executes a PHP program.
Referred to as *the Engine* throughout this specification.

**value** – a primitive unit of data operated by the Engine having a type
and potentially other content depending on the type.

Other terms are defined throughout this specification, as needed, with
the first usage being typeset *like this*.


