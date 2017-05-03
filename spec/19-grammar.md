# Grammar

## General

The grammar notation is described in [Grammars section](09-lexical-structure.md#grammars).

## Lexical Grammar

<pre>
<i id="grammar-input-file">input-file::</i>
   <i><a href="#grammar-input-element">input-element</a></i>
   <i><a href="#grammar-input-file">input-file</a></i>   <i><a href="#grammar-input-element">input-element</a></i>

<i id="grammar-input-element">input-element::</i>
   <i><a href="#grammar-comment">comment</a></i>
   <i><a href="#grammar-white-space">white-space</a></i>
   <i><a href="#grammar-token">token</a></i>

<i id="grammar-comment">comment::</i>
   <i><a href="#grammar-single-line-comment">single-line-comment</a></i>
   <i><a href="#grammar-delimited-comment">delimited-comment</a></i>

<i id="grammar-single-line-comment">single-line-comment::</i>
   //   <i><a href="#grammar-input-characters">input-characters</a></i><sub>opt</sub>
   #   <i><a href="#grammar-input-characters">input-characters</a></i><sub>opt</sub>

<i id="grammar-input-characters">input-characters::</i>
   <i><a href="#grammar-input-character">input-character</a></i>
   <i><a href="#grammar-input-characters">input-characters</a></i>   <i><a href="#grammar-input-character">input-character</a></i>

<i id="grammar-input-character">input-character::</i>
   Any source character except   <i><a href="#grammar-new-line">new-line</a></i>

<i id="grammar-new-line">new-line::</i>
   Carriage-return character (U+000D)
   Line-feed character (U+000A)
   Carriage-return character (U+000D) followed by line-feed character (U+000A)

<i id="grammar-delimited-comment">delimited-comment::</i>
   /*   No characters or any source character sequence except */   */

<i id="grammar-white-space">white-space::</i>
   <i><a href="#grammar-white-space-character">white-space-character</a></i>
   <i><a href="#grammar-white-space">white-space</a></i>   <i><a href="#grammar-white-space-character">white-space-character</a></i>

<i id="grammar-white-space-character">white-space-character::</i>
   <i><a href="#grammar-new-line">new-line</a></i>
   Space character (U+0020)
   Horizontal-tab character (U+0009)

<i id="grammar-token">token::</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>
   <i><a href="#grammar-name">name</a></i>
   <i><a href="#grammar-keyword">keyword</a></i>
   <i><a href="#grammar-integer-literal">integer-literal</a></i>
   <i><a href="#grammar-floating-literal">floating-literal</a></i>
   <i><a href="#grammar-string-literal">string-literal</a></i>
   <i><a href="#grammar-operator-or-punctuator">operator-or-punctuator</a></i>

<i id="grammar-variable-name">variable-name::</i>
   $   <i><a href="#grammar-name">name</a></i>

<i id="grammar-namespace-name">namespace-name::</i>
   <i><a href="#grammar-name">name</a></i>
   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \   <i><a href="#grammar-name">name</a></i>

<i id="grammar-namespace-name-as-a-prefix">namespace-name-as-a-prefix::</i>
   \
   \<sub>opt</sub>   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \
   namespace   \
   namespace   \   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \

<i id="grammar-qualified-name">qualified-name::</i>
   <i><a href="#grammar-namespace-name-as-a-prefix">namespace-name-as-a-prefix</a></i><sub>opt</sub>   <i><a href="#grammar-name">name</a></i>

<i id="grammar-name">name::</i>
   <i><a href="#grammar-name-nondigit">name-nondigit</a></i>
   <i><a href="#grammar-name">name</a></i>   <i><a href="#grammar-name-nondigit">name-nondigit</a></i>
   <i><a href="#grammar-name">name</a></i>   <i><a href="#grammar-digit">digit</a></i>

<i id="grammar-name-nondigit">name-nondigit::</i>
   <i><a href="#grammar-nondigit">nondigit</a></i>
   one of the characters U+0080–U+00ff

<i id="grammar-nondigit">nondigit:: one of</i>
   _
   a   b   c   d   e   f   g   h   i   j   k   l   m
   n   o   p   q   r   s   t   u   v   w   x   y   z
   A   B   C   D   E   F   G   H   I   J   K   L   M
   N   O   P   Q   R   S   T   U   V   W   X   Y   Z

<i id="grammar-keyword">keyword:: one of</i>
   abstract   and   array   as   break   callable   case   catch   class   clone
   const   continue   declare   default   die   do   echo   else   elseif   empty
   enddeclare   endfor   endforeach   endif   endswitch   endwhile   eval   exit
   extends   final   finally   for   foreach   function   global
   goto   if   implements   include   include_once   instanceof
   insteadof   interface   isset   list   namespace   new   or   print   private
   protected   public   require   require_once   return   static   switch
   throw   trait   try   unset   use   var   while   xor   yield   yield from

<i id="grammar-integer-literal">integer-literal::</i>
   <i><a href="#grammar-decimal-literal">decimal-literal</a></i>
   <i><a href="#grammar-octal-literal">octal-literal</a></i>
   <i><a href="#grammar-hexadecimal-literal">hexadecimal-literal</a></i>
   <i><a href="#grammar-binary-literal">binary-literal</a></i>

<i id="grammar-decimal-literal">decimal-literal::</i>
   <i><a href="#grammar-nonzero-digit">nonzero-digit</a></i>
   <i><a href="#grammar-decimal-literal">decimal-literal</a></i>   <i><a href="#grammar-digit">digit</a></i>

<i id="grammar-octal-literal">octal-literal::</i>
   0
   <i><a href="#grammar-octal-literal">octal-literal</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<i id="grammar-hexadecimal-literal">hexadecimal-literal::</i>
   <i><a href="#grammar-hexadecimal-prefix">hexadecimal-prefix</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>
   <i><a href="#grammar-hexadecimal-literal">hexadecimal-literal</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>

<i id="grammar-hexadecimal-prefix">hexadecimal-prefix:: one of</i>
   0x   0X

<i id="grammar-binary-literal">binary-literal::</i>
   <i><a href="#grammar-binary-prefix">binary-prefix</a></i>   <i><a href="#grammar-binary-digit">binary-digit</a></i>
   <i><a href="#grammar-binary-literal">binary-literal</a></i>   <i><a href="#grammar-binary-digit">binary-digit</a></i>

<i id="grammar-binary-prefix">binary-prefix:: one of</i>
   0b   0B

<i id="grammar-digit">digit:: one of</i>
   0   1   2   3   4   5   6   7   8   9

<i id="grammar-nonzero-digit">nonzero-digit:: one of</i>
   1   2   3   4   5   6   7   8   9

<i id="grammar-octal-digit">octal-digit:: one of</i>
   0   1   2   3   4   5   6   7

<i id="grammar-hexadecimal-digit">hexadecimal-digit:: one of</i>
   0   1   2   3   4   5   6   7   8   9
   a   b   c   d   e   f
   A   B   C   D   E   F

<i id="grammar-binary-digit">binary-digit:: one of</i>
   0   1

<i id="grammar-floating-literal">floating-literal::</i>
   <i><a href="#grammar-fractional-literal">fractional-literal</a></i>   <i><a href="#grammar-exponent-part">exponent-part</a></i><sub>opt</sub>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>   <i><a href="#grammar-exponent-part">exponent-part</a></i>

<i id="grammar-fractional-literal">fractional-literal::</i>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i><sub>opt</sub>   .   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>   .

<i id="grammar-exponent-part">exponent-part::</i>
   e   <i><a href="#grammar-sign">sign</a></i><sub>opt</sub>   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>
   E   <i><a href="#grammar-sign">sign</a></i><sub>opt</sub>   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>

<i id="grammar-sign">sign:: one of</i>
   +   -

<i id="grammar-digit-sequence">digit-sequence::</i>
   <i><a href="#grammar-digit">digit</a></i>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>   <i><a href="#grammar-digit">digit</a></i>

<i id="grammar-string-literal">string-literal::</i>
   <i><a href="#grammar-single-quoted-string-literal">single-quoted-string-literal</a></i>
   <i><a href="#grammar-double-quoted-string-literal">double-quoted-string-literal</a></i>
   <i><a href="#grammar-heredoc-string-literal">heredoc-string-literal</a></i>
   <i><a href="#grammar-nowdoc-string-literal">nowdoc-string-literal</a></i>

<i id="grammar-single-quoted-string-literal">single-quoted-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   '   <i><a href="#grammar-sq-char-sequence">sq-char-sequence</a></i><sub>opt</sub>   '

<i id="grammar-sq-char-sequence">sq-char-sequence::</i>
   <i><a href="#grammar-sq-char">sq-char</a></i>
   <i><a href="#grammar-sq-char-sequence">sq-char-sequence</a></i>   <i><a href="#grammar-sq-char">sq-char</a></i>

<i id="grammar-sq-char">sq-char::</i>
   <i><a href="#grammar-sq-escape-sequence">sq-escape-sequence</a></i>
   \<sub>opt</sub>   any member of the source character set except single-quote (') or backslash (\)

<i id="grammar-sq-escape-sequence">sq-escape-sequence:: one of</i>
   \'   \\

<i id="grammar-b-prefix">b-prefix:: one of</i>
   b   B

<i id="grammar-double-quoted-string-literal">double-quoted-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   &quot;   <i><a href="#grammar-dq-char-sequence">dq-char-sequence</a></i><sub>opt</sub>   &quot;

<i id="grammar-dq-char-sequence">dq-char-sequence::</i>
   <i><a href="#grammar-dq-char">dq-char</a></i>
   <i><a href="#grammar-dq-char-sequence">dq-char-sequence</a></i>   <i><a href="#grammar-dq-char">dq-char</a></i>

<i id="grammar-dq-char">dq-char::</i>
   <i><a href="#grammar-dq-escape-sequence">dq-escape-sequence</a></i>
   any member of the source character set except double-quote (&quot;) or backslash (\)
   \   any member of the source character set except &quot;\$efnrtvxX or   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<i id="grammar-dq-escape-sequence">dq-escape-sequence::</i>
   <i><a href="#grammar-dq-simple-escape-sequence">dq-simple-escape-sequence</a></i>
   <i><a href="#grammar-dq-octal-escape-sequence">dq-octal-escape-sequence</a></i>
   <i><a href="#grammar-dq-hexadecimal-escape-sequence">dq-hexadecimal-escape-sequence</a></i>
   <i><a href="#grammar-dq-unicode-escape-sequence">dq-unicode-escape-sequence</a></i>

<i id="grammar-dq-simple-escape-sequence">dq-simple-escape-sequence:: one of</i>
   \&quot;   \\   \$   \e   \f   \n   \r   \t   \v

<i id="grammar-dq-octal-escape-sequence">dq-octal-escape-sequence::</i>
   \   <i><a href="#grammar-octal-digit">octal-digit</a></i>
   \   <i><a href="#grammar-octal-digit">octal-digit</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>
   \   <i><a href="#grammar-octal-digit">octal-digit</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<i id="grammar-dq-hexadecimal-escape-sequence">dq-hexadecimal-escape-sequence::</i>
   \x   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i><sub>opt</sub>
   \X   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i><sub>opt</sub>

<i id="grammar-dq-unicode-escape-sequence">dq-unicode-escape-sequence::</i>
   \u{   <i><a href="#grammar-codepoint-digits">codepoint-digits</a></i>   }

<i id="grammar-codepoint-digits">codepoint-digits::</i>
   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>
   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>   <i><a href="#grammar-codepoint-digits">codepoint-digits</a></i>

<i id="grammar-string-variable">string-variable::</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>   <i><a href="#grammar-offset-or-property">offset-or-property</a></i><sub>opt</sub>
   ${   <i><a href="#grammar-expression">expression</a></i>   }

<i id="grammar-offset-or-property">offset-or-property::</i>
   <i><a href="#grammar-offset-in-string">offset-in-string</a></i>
   <i><a href="#grammar-property-in-string">property-in-string</a></i>

<i id="grammar-offset-in-string">offset-in-string::</i>
   [   <i><a href="#grammar-name">name</a></i>   ]
   [   <i><a href="#grammar-variable-name">variable-name</a></i>   ]
   [   <i><a href="#grammar-integer-literal">integer-literal</a></i>   ]

<i id="grammar-property-in-string">property-in-string::</i>
   -&gt;   <i><a href="#grammar-name">name</a></i>

<i id="grammar-heredoc-string-literal">heredoc-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   &lt;&lt;&lt;   <i><a href="#grammar-hd-start-identifier">hd-start-identifier</a></i>   <i><a href="#grammar-new-line">new-line</a></i>   <i><a href="#grammar-hd-body">hd-body</a></i><sub>opt</sub>   <i><a href="#grammar-hd-end-identifier">hd-end-identifier</a></i>   ;<sub>opt</sub>   <i><a href="#grammar-new-line">new-line</a></i>

<i id="grammar-hd-start-identifier">hd-start-identifier::</i>
   <i><a href="#grammar-name">name</a></i>
   &quot;   <i><a href="#grammar-name">name</a></i>   &quot;

<i id="grammar-hd-end-identifier">hd-end-identifier::</i>
   <i><a href="#grammar-name">name</a></i>

<i id="grammar-hd-body">hd-body::</i>
   <i><a href="#grammar-hd-char-sequence">hd-char-sequence</a></i><sub>opt</sub>   <i><a href="#grammar-new-line">new-line</a></i>

<i id="grammar-hd-char-sequence">hd-char-sequence::</i>
   <i><a href="#grammar-hd-char">hd-char</a></i>
   <i><a href="#grammar-hd-char-sequence">hd-char-sequence</a></i>   <i><a href="#grammar-hd-char">hd-char</a></i>

<i id="grammar-hd-char">hd-char::</i>
   <i><a href="#grammar-hd-escape-sequence">hd-escape-sequence</a></i>
   any member of the source character set except backslash (\)
   \ any member of the source character set except \$efnrtvxX or   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<i id="grammar-hd-escape-sequence">hd-escape-sequence::</i>
   <i><a href="#grammar-hd-simple-escape-sequence">hd-simple-escape-sequence</a></i>
   <i><a href="#grammar-dq-octal-escape-sequence">dq-octal-escape-sequence</a></i>
   <i><a href="#grammar-dq-hexadecimal-escape-sequence">dq-hexadecimal-escape-sequence</a></i>
   <i><a href="#grammar-dq-unicode-escape-sequence">dq-unicode-escape-sequence</a></i>

<i id="grammar-hd-simple-escape-sequence">hd-simple-escape-sequence:: one of</i>
   \\   \$   \e   \f   \n   \r   \t   \v

<i id="grammar-nowdoc-string-literal">nowdoc-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   &lt;&lt;&lt;   '   <i><a href="#grammar-name">name</a></i>   '   <i><a href="#grammar-new-line">new-line</a></i>   <i><a href="#grammar-hd-body">hd-body</a></i><sub>opt</sub>   <i><a href="#grammar-name">name</a></i>   ;<sub>opt</sub>   <i><a href="#grammar-new-line">new-line</a></i>

<i id="grammar-operator-or-punctuator">operator-or-punctuator:: one of</i>
   [   ]   (   )   {   }   .   -&gt;   ++   --   **   *   +   -   ~   !
   $   /   %   &lt;&lt;   &gt;&gt;   &lt;   &gt;   &lt;=   &gt;=   ==   ===   !=   !==   ^   |
   &amp;   &amp;&amp;   ||   ?   :   ;   =   **=   *=   /=   %=   +=   -=   .=   &lt;&lt;=
   &gt;&gt;=   &amp;=   ^=   |=   ,   ??   &lt;=&gt;   ...   \
</pre>

## Syntactic Grammar

### Basic Concepts

<pre>
<i id="grammar-script">script:</i>
   <i><a href="#grammar-script-section">script-section</a></i>
   <i><a href="#grammar-script">script</a></i>   <i><a href="#grammar-script-section">script-section</a></i>

<i id="grammar-script-section">script-section:</i>
   <i><a href="#grammar-text">text</a></i><sub>opt</sub>   <i><a href="#grammar-start-tag">start-tag</a></i>   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>   <i><a href="#grammar-end-tag">end-tag</a></i><sub>opt</sub>   <i><a href="#grammar-text">text</a></i><sub>opt</sub>

<i id="grammar-start-tag">start-tag:</i>
   &lt;?php
   &lt;?=

<i id="grammar-end-tag">end-tag:</i>
   ?&gt;

<i id="grammar-text">text:</i>
   arbitrary text not containing any of   <i><a href="#grammar-start-tag">start-tag</a></i>   sequences
</pre>

### Variables

<pre>
<i id="grammar-function-static-declaration">function-static-declaration:</i>
   static   <i><a href="#grammar-static-variable-name-list">static-variable-name-list</a></i>   ;

<i id="grammar-static-variable-name-list">static-variable-name-list:</i>
   <i><a href="#grammar-static-variable-declaration">static-variable-declaration</a></i>
   <i><a href="#grammar-static-variable-name-list">static-variable-name-list</a></i>   ,   <i><a href="#grammar-static-variable-declaration">static-variable-declaration</a></i>

<i id="grammar-static-variable-declaration">static-variable-declaration:</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>   <i><a href="#grammar-function-static-initializer">function-static-initializer</a></i><sub>opt</sub>

<i id="grammar-function-static-initializer">function-static-initializer:</i>
   =   <i><a href="#grammar-constant-expression">constant-expression</a></i>

<i id="grammar-global-declaration">global-declaration:</i>
   global   <i><a href="#grammar-variable-name-list">variable-name-list</a></i>   ;

<i id="grammar-variable-name-list">variable-name-list:</i>
   <i><a href="#grammar-simple-variable">simple-variable</a></i>
   <i><a href="#grammar-variable-name-list">variable-name-list</a></i>   ,   <i><a href="#grammar-simple-variable">simple-variable</a></i>
</pre>

### Expressions

<pre>
<i id="grammar-primary-expression">primary-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>
   <i><a href="#grammar-class-constant-access-expression">class-constant-access-expression</a></i>
   <i><a href="#grammar-constant-access-expression">constant-access-expression</a></i>
   <i><a href="#grammar-literal">literal</a></i>
   <i><a href="#grammar-array-creation-expression">array-creation-expression</a></i>
   <i><a href="#grammar-intrinsic">intrinsic</a></i>
   <i><a href="#grammar-anonymous-function-creation-expression">anonymous-function-creation-expression</a></i>
   (   <i><a href="#grammar-expression">expression</a></i>   )

<i id="grammar-simple-variable">simple-variable:</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>
   $   <i><a href="#grammar-simple-variable">simple-variable</a></i>
   $   {   <i><a href="#grammar-expression">expression</a></i>   }

<i id="grammar-dereferencable-expression">dereferencable-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>
   (   <i><a href="#grammar-expression">expression</a></i>   )
   <i><a href="#grammar-array-creation-expression">array-creation-expression</a></i>
   <i><a href="#grammar-string-literal">string-literal</a></i>

<i id="grammar-callable-expression">callable-expression:</i>
   <i><a href="#grammar-callable-variable">callable-variable</a></i>
   (   <i><a href="#grammar-expression">expression</a></i>   )
   <i><a href="#grammar-array-creation-expression">array-creation-expression</a></i>
   <i><a href="#grammar-string-literal">string-literal</a></i>

<i id="grammar-callable-variable">callable-variable:</i>
   <i><a href="#grammar-simple-variable">simple-variable</a></i>
   <i><a href="#grammar-subscript-expression">subscript-expression</a></i>
   <i><a href="#grammar-member-call-expression">member-call-expression</a></i>
   <i><a href="#grammar-scoped-call-expression">scoped-call-expression</a></i>
   <i><a href="#grammar-function-call-expression">function-call-expression</a></i>

<i id="grammar-variable">variable:</i>
   <i><a href="#grammar-callable-variable">callable-variable</a></i>
   <i><a href="#grammar-scoped-property-access-expression">scoped-property-access-expression</a></i>
   <i><a href="#grammar-member-access-expression">member-access-expression</a></i>

<i id="grammar-constant-access-expression">constant-access-expression:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<i id="grammar-literal">literal:</i>
   <i><a href="#grammar-integer-literal">integer-literal</a></i>
   <i><a href="#grammar-floating-literal">floating-literal</a></i>
   <i><a href="#grammar-string-literal">string-literal</a></i>

<i id="grammar-intrinsic">intrinsic:</i>
   <i><a href="#grammar-intrinsic-construct">intrinsic-construct</a></i>
   <i><a href="#grammar-intrinsic-operator">intrinsic-operator</a></i>

<i id="grammar-intrinsic-construct">intrinsic-construct:</i>
   <i><a href="#grammar-echo-intrinsic">echo-intrinsic</a></i>
   <i><a href="#grammar-list-intrinsic">list-intrinsic</a></i>
   <i><a href="#grammar-unset-intrinsic">unset-intrinsic</a></i>

<i id="grammar-intrinsic-operator">intrinsic-operator:</i>
   <i><a href="#grammar-empty-intrinsic">empty-intrinsic</a></i>
   <i><a href="#grammar-eval-intrinsic">eval-intrinsic</a></i>
   <i><a href="#grammar-exit-intrinsic">exit-intrinsic</a></i>
   <i><a href="#grammar-isset-intrinsic">isset-intrinsic</a></i>
   <i><a href="#grammar-print-intrinsic">print-intrinsic</a></i>

<i id="grammar-echo-intrinsic">echo-intrinsic:</i>
   echo   <i><a href="#grammar-expression-list">expression-list</a></i>

<i id="grammar-expression-list">expression-list:</i>
   <i><a href="#grammar-expression">expression</a></i>
   <i><a href="#grammar-expression-list">expression-list</a></i>   ,   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-empty-intrinsic">empty-intrinsic:</i>
   empty   (   <i><a href="#grammar-expression">expression</a></i>   )

<i id="grammar-eval-intrinsic">eval-intrinsic:</i>
   eval   (   <i><a href="#grammar-expression">expression</a></i>   )

<i id="grammar-exit-intrinsic">exit-intrinsic:</i>
   exit
   exit   (   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   )
   die
   die   (   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   )

<i id="grammar-isset-intrinsic">isset-intrinsic:</i>
   isset   (   <i><a href="#grammar-variable-list">variable-list</a></i>   )

<i id="grammar-variable-list">variable-list:</i>
   <i><a href="#grammar-variable">variable</a></i>
   <i><a href="#grammar-variable-list">variable-list</a></i>   ,   <i><a href="#grammar-variable">variable</a></i>

<i id="grammar-list-intrinsic">list-intrinsic:</i>
   list   (   <i><a href="#grammar-list-expression-list">list-expression-list</a></i>   )

<i id="grammar-list-expression-list">list-expression-list:</i>
   <i><a href="#grammar-unkeyed-list-expression-list">unkeyed-list-expression-list</a></i>
   <i><a href="#grammar-keyed-list-expression-list">keyed-list-expression-list</a></i>   ,<sub>opt</sub>

<i id="grammar-unkeyed-list-expression-list">unkeyed-list-expression-list:</i>
   <i><a href="#grammar-list-or-variable">list-or-variable</a></i>
   ,
   <i><a href="#grammar-unkeyed-list-expression-list">unkeyed-list-expression-list</a></i>   ,   <i><a href="#grammar-list-or-variable">list-or-variable</a></i><sub>opt</sub>

<i id="grammar-keyed-list-expression-list">keyed-list-expression-list:</i>
   <i><a href="#grammar-expression">expression</a></i>   =&gt;   <i><a href="#grammar-list-or-variable">list-or-variable</a></i>
   <i><a href="#grammar-keyed-list-expression-list">keyed-list-expression-list</a></i>   ,   <i><a href="#grammar-expression">expression</a></i>   =&gt;   <i><a href="#grammar-list-or-variable">list-or-variable</a></i>

<i id="grammar-list-or-variable">list-or-variable:</i>
   <i><a href="#grammar-list-intrinsic">list-intrinsic</a></i>
   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-print-intrinsic">print-intrinsic:</i>
   print   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-unset-intrinsic">unset-intrinsic:</i>
   unset   (   <i><a href="#grammar-variable-list">variable-list</a></i>   )

<i id="grammar-anonymous-function-creation-expression">anonymous-function-creation-expression:</i>
   static<sub>opt</sub>   function   &amp;<sub>opt</sub>   (   <i><a href="#grammar-parameter-declaration-list">parameter-declaration-list</a></i><sub>opt</sub>   )   <i><a href="#grammar-anonymous-function-use-clause">anonymous-function-use-clause</a></i><sub>opt</sub>   <i><a href="#grammar-return-type">return-type</a></i><sub>opt</sub>   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<i id="grammar-anonymous-function-use-clause">anonymous-function-use-clause:</i>
   use   (   <i><a href="#grammar-use-variable-name-list">use-variable-name-list</a></i>   )

<i id="grammar-use-variable-name-list">use-variable-name-list:</i>
   &amp;<sub>opt</sub>   <i><a href="#grammar-variable-name">variable-name</a></i>
   <i><a href="#grammar-use-variable-name-list">use-variable-name-list</a></i>   ,   &amp;<sub>opt</sub>   <i><a href="#grammar-variable-name">variable-name</a></i>

<i id="grammar-postfix-expression">postfix-expression:</i>
   <i><a href="#grammar-primary-expression">primary-expression</a></i>
   <i><a href="#grammar-clone-expression">clone-expression</a></i>
   <i><a href="#grammar-object-creation-expression">object-creation-expression</a></i>
   <i><a href="#grammar-postfix-increment-expression">postfix-increment-expression</a></i>
   <i><a href="#grammar-postfix-decrement-expression">postfix-decrement-expression</a></i>
   <i><a href="#grammar-exponentiation-expression">exponentiation-expression</a></i>

<i id="grammar-clone-expression">clone-expression:</i>
   clone   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-object-creation-expression">object-creation-expression:</i>
   new   <i><a href="#grammar-class-type-designator">class-type-designator</a></i>   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )
   new   <i><a href="#grammar-class-type-designator">class-type-designator</a></i>
   new   class   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )   <i><a href="#grammar-class-base-clause">class-base-clause</a></i><sub>opt</sub>   <i><a href="#grammar-class-interface-clause">class-interface-clause</a></i><sub>opt</sub>   {   <i><a href="#grammar-class-member-declarations">class-member-declarations</a></i><sub>opt</sub>   }
   new   class   <i><a href="#grammar-class-base-clause">class-base-clause</a></i><sub>opt</sub>   <i><a href="#grammar-class-interface-clause">class-interface-clause</a></i><sub>opt</sub>   {   <i><a href="#grammar-class-member-declarations">class-member-declarations</a></i><sub>opt</sub>   }

<i id="grammar-class-type-designator">class-type-designator:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-array-creation-expression">array-creation-expression:</i>
   array   (   <i><a href="#grammar-array-initializer">array-initializer</a></i><sub>opt</sub>   )
   [   <i><a href="#grammar-array-initializer">array-initializer</a></i><sub>opt</sub>   ]

<i id="grammar-array-initializer">array-initializer:</i>
   <i><a href="#grammar-array-initializer-list">array-initializer-list</a></i>   ,<sub>opt</sub>

<i id="grammar-array-initializer-list">array-initializer-list:</i>
   <i><a href="#grammar-array-element-initializer">array-element-initializer</a></i>
   <i><a href="#grammar-array-element-initializer">array-element-initializer</a></i>   ,   <i><a href="#grammar-array-initializer-list">array-initializer-list</a></i>

<i id="grammar-array-element-initializer">array-element-initializer:</i>
   &amp;<sub>opt</sub>   <i><a href="#grammar-element-value">element-value</a></i>
   <i><a href="#grammar-element-key">element-key</a></i>   =&gt;   &amp;<sub>opt</sub>   <i><a href="#grammar-element-value">element-value</a></i>

<i id="grammar-element-key">element-key:</i>
   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-element-value">element-value:</i>
   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-subscript-expression">subscript-expression:</i>
   <i><a href="#grammar-dereferencable-expression">dereferencable-expression</a></i>   [   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   ]
   <i><a href="#grammar-dereferencable-expression">dereferencable-expression</a></i>   {   <i><a href="#grammar-expression">expression</a></i>   }   &lt;b&gt;[Deprecated form]&lt;/b&gt;

<i id="grammar-function-call-expression">function-call-expression:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )
   <i><a href="#grammar-callable-expression">callable-expression</a></i>   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )

<i id="grammar-argument-expression-list">argument-expression-list:</i>
   <i><a href="#grammar-argument-expression">argument-expression</a></i>
   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i>   ,   <i><a href="#grammar-argument-expression">argument-expression</a></i>

<i id="grammar-argument-expression">argument-expression:</i>
   <i><a href="#grammar-variadic-unpacking">variadic-unpacking</a></i>
   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<i id="grammar-variadic-unpacking">variadic-unpacking:</i>
   ...   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<i id="grammar-member-access-expression">member-access-expression:</i>
   <i><a href="#grammar-dereferencable-expression">dereferencable-expression</a></i>   -&gt;   <i><a href="#grammar-member-name">member-name</a></i>

<i id="grammar-member-name">member-name:</i>
   <i><a href="#grammar-name">name</a></i>
   <i><a href="#grammar-simple-variable">simple-variable</a></i>
   {   <i><a href="#grammar-expression">expression</a></i>   }

<i id="grammar-member-call-expression">member-call-expression:</i>
   <i><a href="#grammar-dereferencable-expression">dereferencable-expression</a></i>   -&gt;   <i><a href="#grammar-member-name">member-name</a></i>   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )

<i id="grammar-postfix-increment-expression">postfix-increment-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>   ++

<i id="grammar-postfix-decrement-expression">postfix-decrement-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>   --

<i id="grammar-scoped-property-access-expression">scoped-property-access-expression:</i>
   <i><a href="#grammar-scope-resolution-qualifier">scope-resolution-qualifier</a></i>   ::   <i><a href="#grammar-simple-variable">simple-variable</a></i>

<i id="grammar-scoped-call-expression">scoped-call-expression:</i>
   <i><a href="#grammar-scope-resolution-qualifier">scope-resolution-qualifier</a></i>   ::   <i><a href="#grammar-member-name">member-name</a></i>   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )

<i id="grammar-class-constant-access-expression">class-constant-access-expression:</i>
   <i><a href="#grammar-scope-resolution-qualifier">scope-resolution-qualifier</a></i>   ::   <i><a href="#grammar-name">name</a></i>

<i id="grammar-scope-resolution-qualifier">scope-resolution-qualifier:</i>
   <i><a href="#grammar-relative-scope">relative-scope</a></i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-dereferencable-expression">dereferencable-expression</a></i>

<i id="grammar-relative-scope">relative-scope:</i>
   self
   parent
   static

<i id="grammar-exponentiation-expression">exponentiation-expression:</i>
   <i><a href="#grammar-expression">expression</a></i>   **   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-unary-expression">unary-expression:</i>
   <i><a href="#grammar-postfix-expression">postfix-expression</a></i>
   <i><a href="#grammar-prefix-increment-expression">prefix-increment-expression</a></i>
   <i><a href="#grammar-prefix-decrement-expression">prefix-decrement-expression</a></i>
   <i><a href="#grammar-unary-op-expression">unary-op-expression</a></i>
   <i><a href="#grammar-error-control-expression">error-control-expression</a></i>
   <i><a href="#grammar-shell-command-expression">shell-command-expression</a></i>
   <i><a href="#grammar-cast-expression">cast-expression</a></i>

<i id="grammar-prefix-increment-expression">prefix-increment-expression:</i>
   ++   <i><a href="#grammar-variable">variable</a></i>

<i id="grammar-prefix-decrement-expression">prefix-decrement-expression:</i>
   --   <i><a href="#grammar-variable">variable</a></i>

<i id="grammar-unary-op-expression">unary-op-expression:</i>
   <i><a href="#grammar-unary-operator">unary-operator</a></i>   <i><a href="#grammar-cast-expression">cast-expression</a></i>

<i id="grammar-unary-operator">unary-operator: one of</i>
   +   -   !   ~

<i id="grammar-error-control-expression">error-control-expression:</i>
   @   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-shell-command-expression">shell-command-expression:</i>
   `   <i><a href="#grammar-dq-char-sequence">dq-char-sequence</a></i><sub>opt</sub>   `

<i id="grammar-cast-expression">cast-expression:</i>
   <i><a href="#grammar-unary-expression">unary-expression</a></i>
   (   <i><a href="#grammar-cast-type">cast-type</a></i>   )   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-cast-type">cast-type: one of</i>
   array   binary   bool   boolean   double   int   integer   float   object
   real   string   unset

<i id="grammar-instanceof-expression">instanceof-expression:</i>
   <i><a href="#grammar-unary-expression">unary-expression</a></i>
   <i><a href="#grammar-instanceof-subject">instanceof-subject</a></i>   instanceof   <i><a href="#grammar-instanceof-type-designator">instanceof-type-designator</a></i>

<i id="grammar-instanceof-subject">instanceof-subject:</i>
   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-instanceof-type-designator">instanceof-type-designator:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-multiplicative-expression">multiplicative-expression:</i>
   <i><a href="#grammar-instanceof-expression">instanceof-expression</a></i>
   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>   *   <i><a href="#grammar-instanceof-expression">instanceof-expression</a></i>
   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>   /   <i><a href="#grammar-instanceof-expression">instanceof-expression</a></i>
   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>   %   <i><a href="#grammar-instanceof-expression">instanceof-expression</a></i>

<i id="grammar-additive-expression">additive-expression:</i>
   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>
   <i><a href="#grammar-additive-expression">additive-expression</a></i>   +   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>
   <i><a href="#grammar-additive-expression">additive-expression</a></i>   -   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>
   <i><a href="#grammar-additive-expression">additive-expression</a></i>   .   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>

<i id="grammar-shift-expression">shift-expression:</i>
   <i><a href="#grammar-additive-expression">additive-expression</a></i>
   <i><a href="#grammar-shift-expression">shift-expression</a></i>   &lt;&lt;   <i><a href="#grammar-additive-expression">additive-expression</a></i>
   <i><a href="#grammar-shift-expression">shift-expression</a></i>   &gt;&gt;   <i><a href="#grammar-additive-expression">additive-expression</a></i>

<i id="grammar-relational-expression">relational-expression:</i>
   <i><a href="#grammar-shift-expression">shift-expression</a></i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>   &lt;   <i><a href="#grammar-shift-expression">shift-expression</a></i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>   &gt;   <i><a href="#grammar-shift-expression">shift-expression</a></i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>   &lt;=   <i><a href="#grammar-shift-expression">shift-expression</a></i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>   &gt;=   <i><a href="#grammar-shift-expression">shift-expression</a></i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>   &lt;=&gt;   <i><a href="#grammar-shift-expression">shift-expression</a></i>

<i id="grammar-equality-expression">equality-expression:</i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>   ==   <i><a href="#grammar-relational-expression">relational-expression</a></i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>   !=   <i><a href="#grammar-relational-expression">relational-expression</a></i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>   &lt;&gt;   <i><a href="#grammar-relational-expression">relational-expression</a></i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>   ===   <i><a href="#grammar-relational-expression">relational-expression</a></i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>   !==   <i><a href="#grammar-relational-expression">relational-expression</a></i>

<i id="grammar-bitwise-AND-expression">bitwise-AND-expression:</i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>
   <i><a href="#grammar-bitwise-AND-expression">bitwise-AND-expression</a></i>   &amp;   <i><a href="#grammar-equality-expression">equality-expression</a></i>

<i id="grammar-bitwise-exc-OR-expression">bitwise-exc-OR-expression:</i>
   <i><a href="#grammar-bitwise-AND-expression">bitwise-AND-expression</a></i>
   <i><a href="#grammar-bitwise-exc-OR-expression">bitwise-exc-OR-expression</a></i>   ^   <i><a href="#grammar-bitwise-AND-expression">bitwise-AND-expression</a></i>

<i id="grammar-bitwise-inc-OR-expression">bitwise-inc-OR-expression:</i>
   <i><a href="#grammar-bitwise-exc-OR-expression">bitwise-exc-OR-expression</a></i>
   <i><a href="#grammar-bitwise-inc-OR-expression">bitwise-inc-OR-expression</a></i>   |   <i><a href="#grammar-bitwise-exc-OR-expression">bitwise-exc-OR-expression</a></i>

<i id="grammar-logical-AND-expression-1">logical-AND-expression-1:</i>
   <i><a href="#grammar-bitwise-inc-OR-expression">bitwise-inc-OR-expression</a></i>
   <i><a href="#grammar-logical-AND-expression-1">logical-AND-expression-1</a></i>   &amp;&amp;   <i><a href="#grammar-bitwise-inc-OR-expression">bitwise-inc-OR-expression</a></i>

<i id="grammar-logical-inc-OR-expression-1">logical-inc-OR-expression-1:</i>
   <i><a href="#grammar-logical-AND-expression-1">logical-AND-expression-1</a></i>
   <i><a href="#grammar-logical-inc-OR-expression-1">logical-inc-OR-expression-1</a></i>   ||   <i><a href="#grammar-logical-AND-expression-1">logical-AND-expression-1</a></i>

<i id="grammar-conditional-expression">conditional-expression:</i>
   <i><a href="#grammar-logical-inc-OR-expression-1">logical-inc-OR-expression-1</a></i>
   <i><a href="#grammar-logical-inc-OR-expression-1">logical-inc-OR-expression-1</a></i>   ?   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   :   <i><a href="#grammar-conditional-expression">conditional-expression</a></i>

<i id="grammar-coalesce-expression">coalesce-expression:</i>
   <i><a href="#grammar-logical-inc-OR-expression-1">logical-inc-OR-expression-1</a></i>   ??   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-assignment-expression">assignment-expression:</i>
   <i><a href="#grammar-conditional-expression">conditional-expression</a></i>
   <i><a href="#grammar-coalesce-expression">coalesce-expression</a></i>
   <i><a href="#grammar-simple-assignment-expression">simple-assignment-expression</a></i>
   <i><a href="#grammar-byref-assignment-expression">byref-assignment-expression</a></i>
   <i><a href="#grammar-compound-assignment-expression">compound-assignment-expression</a></i>

<i id="grammar-simple-assignment-expression">simple-assignment-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>   =   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>
   <i><a href="#grammar-list-intrinsic">list-intrinsic</a></i>   =   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<i id="grammar-byref-assignment-expression">byref-assignment-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>   =   &amp;   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<i id="grammar-compound-assignment-expression">compound-assignment-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>   <i><a href="#grammar-compound-assignment-operator">compound-assignment-operator</a></i>   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<i id="grammar-compound-assignment-operator">compound-assignment-operator: one of</i>
   **=   *=   /=   %=   +=   -=   .=   &lt;&lt;=   &gt;&gt;=   &amp;=   ^=   |=

<i id="grammar-logical-AND-expression-2">logical-AND-expression-2:</i>
   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>
   <i><a href="#grammar-logical-AND-expression-2">logical-AND-expression-2</a></i>   and   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<i id="grammar-logical-exc-OR-expression">logical-exc-OR-expression:</i>
   <i><a href="#grammar-logical-AND-expression-2">logical-AND-expression-2</a></i>
   <i><a href="#grammar-logical-exc-OR-expression">logical-exc-OR-expression</a></i>   xor   <i><a href="#grammar-logical-AND-expression-2">logical-AND-expression-2</a></i>

<i id="grammar-logical-inc-OR-expression-2">logical-inc-OR-expression-2:</i>
   <i><a href="#grammar-logical-exc-OR-expression">logical-exc-OR-expression</a></i>
   <i><a href="#grammar-logical-inc-OR-expression-2">logical-inc-OR-expression-2</a></i>   or   <i><a href="#grammar-logical-exc-OR-expression">logical-exc-OR-expression</a></i>

<i id="grammar-yield-expression">yield-expression:</i>
   <i><a href="#grammar-logical-inc-OR-expression-2">logical-inc-OR-expression-2</a></i>
   yield   <i><a href="#grammar-array-element-initializer">array-element-initializer</a></i>
   yield from   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-expression">expression:</i>
   <i><a href="#grammar-yield-expression">yield-expression</a></i>
   <i><a href="#grammar-include-expression">include-expression</a></i>
   <i><a href="#grammar-include-once-expression">include-once-expression</a></i>
   <i><a href="#grammar-require-expression">require-expression</a></i>
   <i><a href="#grammar-require-once-expression">require-once-expression</a></i>

<i id="grammar-include-expression">include-expression:</i>
   include   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-include-once-expression">include-once-expression:</i>
   include_once   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-require-expression">require-expression:</i>
   require   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-require-once-expression">require-once-expression:</i>
   require_once   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-constant-expression">constant-expression:</i>
   <i><a href="#grammar-expression">expression</a></i>
</pre>

### Statements

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
   <i><a href="#grammar-const-declaration">const-declaration</a></i>
   <i><a href="#grammar-function-definition">function-definition</a></i>
   <i><a href="#grammar-class-declaration">class-declaration</a></i>
   <i><a href="#grammar-interface-declaration">interface-declaration</a></i>
   <i><a href="#grammar-trait-declaration">trait-declaration</a></i>
   <i><a href="#grammar-namespace-definition">namespace-definition</a></i>
   <i><a href="#grammar-namespace-use-declaration">namespace-use-declaration</a></i>
   <i><a href="#grammar-global-declaration">global-declaration</a></i>
   <i><a href="#grammar-function-static-declaration">function-static-declaration</a></i>

<i id="grammar-compound-statement">compound-statement:</i>
   {   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>   }

<i id="grammar-statement-list">statement-list:</i>
   <i><a href="#grammar-statement">statement</a></i>
   <i><a href="#grammar-statement-list">statement-list</a></i>   <i><a href="#grammar-statement">statement</a></i>

<i id="grammar-named-label-statement">named-label-statement:</i>
   <i><a href="#grammar-name">name</a></i>   ;   <i><a href="#grammar-statement">statement</a></i>

<i id="grammar-expression-statement">expression-statement:</i>
   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   ;

<i id="grammar-selection-statement">selection-statement:</i>
   <i><a href="#grammar-if-statement">if-statement</a></i>
   <i><a href="#grammar-switch-statement">switch-statement</a></i>

<i id="grammar-if-statement">if-statement:</i>
   if   (   <i><a href="#grammar-expression">expression</a></i>   )   <i><a href="#grammar-statement">statement</a></i>   <i><a href="#grammar-elseif-clauses-1">elseif-clauses-1</a></i><sub>opt</sub>   <i><a href="#grammar-else-clause-1">else-clause-1</a></i><sub>opt</sub>
   if   (   <i><a href="#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   <i><a href="#grammar-elseif-clauses-2">elseif-clauses-2</a></i><sub>opt</sub>   <i><a href="#grammar-else-clause-2">else-clause-2</a></i><sub>opt</sub>   endif   ;

<i id="grammar-elseif-clauses-1">elseif-clauses-1:</i>
   <i><a href="#grammar-elseif-clause-1">elseif-clause-1</a></i>
   <i><a href="#grammar-elseif-clauses-1">elseif-clauses-1</a></i>   <i><a href="#grammar-elseif-clause-1">elseif-clause-1</a></i>

<i id="grammar-elseif-clause-1">elseif-clause-1:</i>
   elseif   (   <i><a href="#grammar-expression">expression</a></i>   )   <i><a href="#grammar-statement">statement</a></i>

<i id="grammar-else-clause-1">else-clause-1:</i>
   else   <i><a href="#grammar-statement">statement</a></i>

<i id="grammar-elseif-clauses-2">elseif-clauses-2:</i>
   <i><a href="#grammar-elseif-clause-2">elseif-clause-2</a></i>
   <i><a href="#grammar-elseif-clauses-2">elseif-clauses-2</a></i>   <i><a href="#grammar-elseif-clause-2">elseif-clause-2</a></i>

<i id="grammar-elseif-clause-2">elseif-clause-2:</i>
   elseif   (   <i><a href="#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>

<i id="grammar-else-clause-2">else-clause-2:</i>
   else   :   <i><a href="#grammar-statement-list">statement-list</a></i>

<i id="grammar-switch-statement">switch-statement:</i>
   switch   (   <i><a href="#grammar-expression">expression</a></i>   )   {   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>   }
   switch   (   <i><a href="#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>   endswitch;

<i id="grammar-case-statements">case-statements:</i>
   <i><a href="#grammar-case-statement">case-statement</a></i>   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>
   <i><a href="#grammar-default-statement">default-statement</a></i>   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>

<i id="grammar-case-statement">case-statement:</i>
   case   <i><a href="#grammar-expression">expression</a></i>   <i><a href="#grammar-case-default-label-terminator">case-default-label-terminator</a></i>   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>

<i id="grammar-default-statement">default-statement:</i>
   default   <i><a href="#grammar-case-default-label-terminator">case-default-label-terminator</a></i>   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>

<i id="grammar-case-default-label-terminator">case-default-label-terminator:</i>
   :
   ;

<i id="grammar-iteration-statement">iteration-statement:</i>
   <i><a href="#grammar-while-statement">while-statement</a></i>
   <i><a href="#grammar-do-statement">do-statement</a></i>
   <i><a href="#grammar-for-statement">for-statement</a></i>
   <i><a href="#grammar-foreach-statement">foreach-statement</a></i>

<i id="grammar-while-statement">while-statement:</i>
   while   (   <i><a href="#grammar-expression">expression</a></i>   )   <i><a href="#grammar-statement">statement</a></i>
   while   (   <i><a href="#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   endwhile   ;

<i id="grammar-do-statement">do-statement:</i>
   do   <i><a href="#grammar-statement">statement</a></i>   while   (   <i><a href="#grammar-expression">expression</a></i>   )   ;

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
   <i><a href="#grammar-expression">expression</a></i>
   <i><a href="#grammar-for-expression-group">for-expression-group</a></i>   ,   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-foreach-statement">foreach-statement:</i>
   foreach   (   <i><a href="#grammar-foreach-collection-name">foreach-collection-name</a></i>   as   <i><a href="#grammar-foreach-key">foreach-key</a></i><sub>opt</sub>   <i><a href="#grammar-foreach-value">foreach-value</a></i>   )   statement
   foreach   (   <i><a href="#grammar-foreach-collection-name">foreach-collection-name</a></i>   as   <i><a href="#grammar-foreach-key">foreach-key</a></i><sub>opt</sub>   <i><a href="#grammar-foreach-value">foreach-value</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   endforeach   ;

<i id="grammar-foreach-collection-name">foreach-collection-name:</i>
   <i><a href="#grammar-expression">expression</a></i>

<i id="grammar-foreach-key">foreach-key:</i>
   <i><a href="#grammar-expression">expression</a></i>   =&gt;

<i id="grammar-foreach-value">foreach-value:</i>
   &amp;<sub>opt</sub>   <i><a href="#grammar-expression">expression</a></i>
   <i><a href="#grammar-list-intrinsic">list-intrinsic</a></i>

<i id="grammar-jump-statement">jump-statement:</i>
   <i><a href="#grammar-goto-statement">goto-statement</a></i>
   <i><a href="#grammar-continue-statement">continue-statement</a></i>
   <i><a href="#grammar-break-statement">break-statement</a></i>
   <i><a href="#grammar-return-statement">return-statement</a></i>
   <i><a href="#grammar-throw-statement">throw-statement</a></i>

<i id="grammar-goto-statement">goto-statement:</i>
   goto   <i><a href="#grammar-name">name</a></i>   ;

<i id="grammar-continue-statement">continue-statement:</i>
   continue   <i><a href="#grammar-breakout-level">breakout-level</a></i><sub>opt</sub>   ;

<i id="grammar-breakout-level">breakout-level:</i>
   <i><a href="#grammar-integer-literal">integer-literal</a></i>

<i id="grammar-break-statement">break-statement:</i>
   break   <i><a href="#grammar-breakout-level">breakout-level</a></i><sub>opt</sub>   ;

<i id="grammar-return-statement">return-statement:</i>
   return   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   ;

<i id="grammar-throw-statement">throw-statement:</i>
   throw   <i><a href="#grammar-expression">expression</a></i>   ;

<i id="grammar-try-statement">try-statement:</i>
   try   <i><a href="#grammar-compound-statement">compound-statement</a></i>   <i><a href="#grammar-catch-clauses">catch-clauses</a></i>
   try   <i><a href="#grammar-compound-statement">compound-statement</a></i>   <i><a href="#grammar-finally-clause">finally-clause</a></i>
   try   <i><a href="#grammar-compound-statement">compound-statement</a></i>   <i><a href="#grammar-catch-clauses">catch-clauses</a></i>   <i><a href="#grammar-finally-clause">finally-clause</a></i>

<i id="grammar-catch-clauses">catch-clauses:</i>
   <i><a href="#grammar-catch-clause">catch-clause</a></i>
   <i><a href="#grammar-catch-clauses">catch-clauses</a></i>   <i><a href="#grammar-catch-clause">catch-clause</a></i>

<i id="grammar-catch-clause">catch-clause:</i>
   catch   (   <i><a href="#grammar-qualified-name">qualified-name</a></i>   <i><a href="#grammar-variable-name">variable-name</a></i>   )   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<i id="grammar-finally-clause">finally-clause:</i>
   finally   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<i id="grammar-declare-statement">declare-statement:</i>
   declare   (   <i><a href="#grammar-declare-directive">declare-directive</a></i>   )   <i><a href="#grammar-statement">statement</a></i>
   declare   (   <i><a href="#grammar-declare-directive">declare-directive</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   enddeclare   ;
   declare   (   <i><a href="#grammar-declare-directive">declare-directive</a></i>   )   ;

<i id="grammar-declare-directive">declare-directive:</i>
   ticks   =   <i><a href="#grammar-literal">literal</a></i>
   encoding   =   <i><a href="#grammar-literal">literal</a></i>
   strict_types   =   <i><a href="#grammar-literal">literal</a></i>
</pre>

### Functions

<pre>
<i id="grammar-function-definition">function-definition:</i>
   <i><a href="#grammar-function-definition-header">function-definition-header</a></i>   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<i id="grammar-function-definition-header">function-definition-header:</i>
   function   &amp;<sub>opt</sub>   <i><a href="#grammar-name">name</a></i>   (   <i><a href="#grammar-parameter-declaration-list">parameter-declaration-list</a></i><sub>opt</sub>   )   <i><a href="#grammar-return-type">return-type</a></i><sub>opt</sub>

<i id="grammar-parameter-declaration-list">parameter-declaration-list:</i>
   <i><a href="#grammar-simple-parameter-declaration-list">simple-parameter-declaration-list</a></i>
   <i><a href="#grammar-variadic-declaration-list">variadic-declaration-list</a></i>

<i id="grammar-simple-parameter-declaration-list">simple-parameter-declaration-list:</i>
   <i><a href="#grammar-parameter-declaration">parameter-declaration</a></i>
   <i><a href="#grammar-parameter-declaration-list">parameter-declaration-list</a></i>   ,   <i><a href="#grammar-parameter-declaration">parameter-declaration</a></i>

<i id="grammar-variadic-declaration-list">variadic-declaration-list:</i>
   <i><a href="#grammar-simple-parameter-declaration-list">simple-parameter-declaration-list</a></i>   ,   <i><a href="#grammar-variadic-parameter">variadic-parameter</a></i>
   <i><a href="#grammar-variadic-parameter">variadic-parameter</a></i>

<i id="grammar-parameter-declaration">parameter-declaration:</i>
   <i><a href="#grammar-type-declaration">type-declaration</a></i><sub>opt</sub>   &amp;<sub>opt</sub>   <i><a href="#grammar-variable-name">variable-name</a></i>   <i><a href="#grammar-default-argument-specifier">default-argument-specifier</a></i><sub>opt</sub>

<i id="grammar-variadic-parameter">variadic-parameter:</i>
   <i><a href="#grammar-type-declaration">type-declaration</a></i><sub>opt</sub>   &amp;<sub>opt</sub>   ...   <i><a href="#grammar-variable-name">variable-name</a></i>

<i id="grammar-return-type">return-type:</i>
   :   <i><a href="#grammar-type-declaration">type-declaration</a></i>
   :   void

<i id="grammar-type-declaration">type-declaration:</i>
   array
   callable
   iterable
   <i><a href="#grammar-scalar-type">scalar-type</a></i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<i id="grammar-scalar-type">scalar-type:</i>
   bool
   float
   int
   string

<i id="grammar-default-argument-specifier">default-argument-specifier:</i>
   =   <i><a href="#grammar-constant-expression">constant-expression</a></i>
</pre>

### Classes

<pre>
<i id="grammar-class-declaration">class-declaration:</i>
   <i><a href="#grammar-class-modifier">class-modifier</a></i><sub>opt</sub>   class   <i><a href="#grammar-name">name</a></i>   <i><a href="#grammar-class-base-clause">class-base-clause</a></i><sub>opt</sub>   <i><a href="#grammar-class-interface-clause">class-interface-clause</a></i><sub>opt</sub>   {   <i><a href="#grammar-class-member-declarations">class-member-declarations</a></i><sub>opt</sub>   }

<i id="grammar-class-modifier">class-modifier:</i>
   abstract
   final

<i id="grammar-class-base-clause">class-base-clause:</i>
   extends   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<i id="grammar-class-interface-clause">class-interface-clause:</i>
   implements   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-class-interface-clause">class-interface-clause</a></i>   ,   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<i id="grammar-class-member-declarations">class-member-declarations:</i>
   <i><a href="#grammar-class-member-declaration">class-member-declaration</a></i>
   <i><a href="#grammar-class-member-declarations">class-member-declarations</a></i>   <i><a href="#grammar-class-member-declaration">class-member-declaration</a></i>

<i id="grammar-class-member-declaration">class-member-declaration:</i>
   <i><a href="#grammar-class-const-declaration">class-const-declaration</a></i>
   <i><a href="#grammar-property-declaration">property-declaration</a></i>
   <i><a href="#grammar-method-declaration">method-declaration</a></i>
   <i><a href="#grammar-constructor-declaration">constructor-declaration</a></i>
   <i><a href="#grammar-destructor-declaration">destructor-declaration</a></i>
   <i><a href="#grammar-trait-use-clause">trait-use-clause</a></i>

<i id="grammar-const-declaration">const-declaration:</i>
   const   <i><a href="#grammar-const-elements">const-elements</a></i>   ;

<i id="grammar-class-const-declaration">class-const-declaration:</i>
   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i><sub>opt</sub>   const   <i><a href="#grammar-const-elements">const-elements</a></i>   ;

<i id="grammar-const-elements">const-elements:</i>
   <i><a href="#grammar-const-element">const-element</a></i>
   <i><a href="#grammar-const-elements">const-elements</a></i>   <i><a href="#grammar-const-element">const-element</a></i>

<i id="grammar-const-element">const-element:</i>
   <i><a href="#grammar-name">name</a></i>   =   <i><a href="#grammar-constant-expression">constant-expression</a></i>

<i id="grammar-property-declaration">property-declaration:</i>
   <i><a href="#grammar-property-modifier">property-modifier</a></i>   <i><a href="#grammar-property-elements">property-elements</a></i>   ;

<i id="grammar-property-modifier">property-modifier:</i>
   var
   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i>   <i><a href="#grammar-static-modifier">static-modifier</a></i><sub>opt</sub>
   <i><a href="#grammar-static-modifier">static-modifier</a></i>   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i><sub>opt</sub>

<i id="grammar-visibility-modifier">visibility-modifier:</i>
   public
   protected
   private

<i id="grammar-static-modifier">static-modifier:</i>
   static

<i id="grammar-property-elements">property-elements:</i>
   <i><a href="#grammar-property-element">property-element</a></i>
   <i><a href="#grammar-property-elements">property-elements</a></i>   <i><a href="#grammar-property-element">property-element</a></i>

<i id="grammar-property-element">property-element:</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>   <i><a href="#grammar-property-initializer">property-initializer</a></i><sub>opt</sub>   ;

<i id="grammar-property-initializer">property-initializer:</i>
   =   <i><a href="#grammar-constant-expression">constant-expression</a></i>

<i id="grammar-method-declaration">method-declaration:</i>
   <i><a href="#grammar-method-modifiers">method-modifiers</a></i><sub>opt</sub>   <i><a href="#grammar-function-definition">function-definition</a></i>
   <i><a href="#grammar-method-modifiers">method-modifiers</a></i>   <i><a href="#grammar-function-definition-header">function-definition-header</a></i>   ;

<i id="grammar-method-modifiers">method-modifiers:</i>
   <i><a href="#grammar-method-modifier">method-modifier</a></i>
   <i><a href="#grammar-method-modifiers">method-modifiers</a></i>   <i><a href="#grammar-method-modifier">method-modifier</a></i>

<i id="grammar-method-modifier">method-modifier:</i>
   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i>
   <i><a href="#grammar-static-modifier">static-modifier</a></i>
   <i><a href="#grammar-class-modifier">class-modifier</a></i>

<i id="grammar-constructor-declaration">constructor-declaration:</i>
   <i><a href="#grammar-method-modifiers">method-modifiers</a></i>   function   &amp;<sub>opt</sub>   __construct   (   <i><a href="#grammar-parameter-declaration-list">parameter-declaration-list</a></i><sub>opt</sub>   )   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<i id="grammar-destructor-declaration">destructor-declaration:</i>
   <i><a href="#grammar-method-modifiers">method-modifiers</a></i>   function   &amp;<sub>opt</sub>   __destruct   (   )   <i><a href="#grammar-compound-statement">compound-statement</a></i>
</pre>

### Interfaces

<pre>
<i id="grammar-interface-declaration">interface-declaration:</i>
   interface   <i><a href="#grammar-name">name</a></i>   <i><a href="#grammar-interface-base-clause">interface-base-clause</a></i><sub>opt</sub>   {   <i><a href="#grammar-interface-member-declarations">interface-member-declarations</a></i><sub>opt</sub>   }

<i id="grammar-interface-base-clause">interface-base-clause:</i>
   extends   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-interface-base-clause">interface-base-clause</a></i>   ,   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<i id="grammar-interface-member-declarations">interface-member-declarations:</i>
   <i><a href="#grammar-interface-member-declaration">interface-member-declaration</a></i>
   <i><a href="#grammar-interface-member-declarations">interface-member-declarations</a></i>   <i><a href="#grammar-interface-member-declaration">interface-member-declaration</a></i>

<i id="grammar-interface-member-declaration">interface-member-declaration:</i>
   <i><a href="#grammar-class-const-declaration">class-const-declaration</a></i>
   <i><a href="#grammar-method-declaration">method-declaration</a></i>
</pre>

### Traits

<pre>
<i id="grammar-trait-declaration">trait-declaration:</i>
   trait   <i><a href="#grammar-name">name</a></i>   {   <i><a href="#grammar-trait-member-declarations">trait-member-declarations</a></i><sub>opt</sub>   }

<i id="grammar-trait-member-declarations">trait-member-declarations:</i>
   <i><a href="#grammar-trait-member-declaration">trait-member-declaration</a></i>
   <i><a href="#grammar-trait-member-declarations">trait-member-declarations</a></i>   <i><a href="#grammar-trait-member-declaration">trait-member-declaration</a></i>

<i id="grammar-trait-member-declaration">trait-member-declaration:</i>
   <i><a href="#grammar-property-declaration">property-declaration</a></i>
   <i><a href="#grammar-method-declaration">method-declaration</a></i>
   <i><a href="#grammar-constructor-declaration">constructor-declaration</a></i>
   <i><a href="#grammar-destructor-declaration">destructor-declaration</a></i>
   <i><a href="#grammar-trait-use-clauses">trait-use-clauses</a></i>

<i id="grammar-trait-use-clauses">trait-use-clauses:</i>
   <i><a href="#grammar-trait-use-clause">trait-use-clause</a></i>
   <i><a href="#grammar-trait-use-clauses">trait-use-clauses</a></i>   <i><a href="#grammar-trait-use-clause">trait-use-clause</a></i>

<i id="grammar-trait-use-clause">trait-use-clause:</i>
   use   <i><a href="#grammar-trait-name-list">trait-name-list</a></i>   <i><a href="#grammar-trait-use-specification">trait-use-specification</a></i>

<i id="grammar-trait-name-list">trait-name-list:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-trait-name-list">trait-name-list</a></i>   ,   <i><a href="#grammar-qualified-name">qualified-name</a></i>

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
   <i><a href="#grammar-name">name</a></i>   insteadof   <i><a href="#grammar-name">name</a></i>

<i id="grammar-trait-alias-as-clause">trait-alias-as-clause:</i>
   <i><a href="#grammar-name">name</a></i>   as   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i><sub>opt</sub>   <i><a href="#grammar-name">name</a></i>
   <i><a href="#grammar-name">name</a></i>   as   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i>   <i><a href="#grammar-name">name</a></i><sub>opt</sub>
</pre>

### Namespaces

<pre>
<i id="grammar-namespace-definition">namespace-definition:</i>
   namespace   <i><a href="#grammar-name">name</a></i>   ;
   namespace   <i><a href="#grammar-name">name</a></i><sub>opt</sub>   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<i id="grammar-namespace-use-declaration">namespace-use-declaration:</i>
   use   <i><a href="#grammar-namespace-function-or-const">namespace-function-or-const</a></i><sub>opt</sub>   <i><a href="#grammar-namespace-use-clauses">namespace-use-clauses</a></i>   ;
   use   <i><a href="#grammar-namespace-function-or-const">namespace-function-or-const</a></i>   \<sub>opt</sub>   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \   {   <i><a href="#grammar-namespace-use-group-clauses-1">namespace-use-group-clauses-1</a></i>   }   ;
   use   \<sub>opt</sub>   namespace-name   \   {   <i><a href="#grammar-namespace-use-group-clauses-2">namespace-use-group-clauses-2</a></i>   }   ;

<i id="grammar-namespace-use-clauses">namespace-use-clauses:</i>
   <i><a href="#grammar-namespace-use-clause">namespace-use-clause</a></i>
   <i><a href="#grammar-namespace-use-clauses">namespace-use-clauses</a></i>   ,   <i><a href="#grammar-namespace-use-clause">namespace-use-clause</a></i>

<i id="grammar-namespace-use-clause">namespace-use-clause:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>   <i><a href="#grammar-namespace-aliasing-clause">namespace-aliasing-clause</a></i><sub>opt</sub>

<i id="grammar-namespace-aliasing-clause">namespace-aliasing-clause:</i>
   as   <i><a href="#grammar-name">name</a></i>

<i id="grammar-namespace-function-or-const">namespace-function-or-const:</i>
   function
   const

<i id="grammar-namespace-use-group-clauses-1">namespace-use-group-clauses-1:</i>
   <i><a href="#grammar-namespace-use-group-clause-1">namespace-use-group-clause-1</a></i>
   <i><a href="#grammar-namespace-use-group-clauses-1">namespace-use-group-clauses-1</a></i>   ,   <i><a href="#grammar-namespace-use-group-clause-1">namespace-use-group-clause-1</a></i>

<i id="grammar-namespace-use-group-clause-1">namespace-use-group-clause-1:</i>
   <i><a href="#grammar-namespace-name">namespace-name</a></i>   <i><a href="#grammar-namespace-aliasing-clause">namespace-aliasing-clause</a></i><sub>opt</sub>

<i id="grammar-namespace-use-group-clauses-2">namespace-use-group-clauses-2:</i>
   <i><a href="#grammar-namespace-use-group-clause-2">namespace-use-group-clause-2</a></i>
   <i><a href="#grammar-namespace-use-group-clauses-2">namespace-use-group-clauses-2</a></i>   ,   <i><a href="#grammar-namespace-use-group-clause-2">namespace-use-group-clause-2</a></i>

<i id="grammar-namespace-use-group-clause-2">namespace-use-group-clause-2:</i>
   <i><a href="#grammar-namespace-function-or-const">namespace-function-or-const</a></i><sub>opt</sub>   <i><a href="#grammar-namespace-name">namespace-name</a></i>   <i><a href="#grammar-namespace-aliasing-clause">namespace-aliasing-clause</a></i><sub>opt</sub>
</pre>
