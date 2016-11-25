#Grammar

##General

The grammar notation is described in [Grammars section](09-lexical-structure.md#grammars).

##Lexical Grammar

<pre>
<a name="grammar-input-file"><i>input-file::</i>
   <i><a href="#grammar-input-element">input-element</a></i>
   <i><a href="#grammar-input-file">input-file</a></i>   <i><a href="#grammar-input-element">input-element</a></i>

<a name="grammar-input-element"><i>input-element::</i>
   <i><a href="#grammar-comment">comment</a></i>
   <i><a href="#grammar-white-space">white-space</a></i>
   <i><a href="#grammar-token">token</a></i>

<a name="grammar-comment"><i>comment::</i>
   <i><a href="#grammar-single-line-comment">single-line-comment</a></i>
   <i><a href="#grammar-delimited-comment">delimited-comment</a></i>

<a name="grammar-single-line-comment"><i>single-line-comment::</i>
   //   <i><a href="#grammar-input-characters">input-characters</a></i><sub>opt</sub>
   #   <i><a href="#grammar-input-characters">input-characters</a></i><sub>opt</sub>

<a name="grammar-input-characters"><i>input-characters::</i>
   <i><a href="#grammar-input-character">input-character</a></i>
   <i><a href="#grammar-input-characters">input-characters</a></i>   <i><a href="#grammar-input-character">input-character</a></i>

<a name="grammar-input-character"><i>input-character::</i>
   Any source character except   <i><a href="#grammar-new-line">new-line</a></i>

<a name="grammar-new-line"><i>new-line::</i>
   Carriage-return character (U+000D)
   Line-feed character (U+000A)
   Carriage-return character (U+000D) followed by line-feed character (U+000A)

<a name="grammar-delimited-comment"><i>delimited-comment::</i>
   /*   No characters or any source character sequence except */   */

<a name="grammar-white-space"><i>white-space::</i>
   <i><a href="#grammar-white-space-character">white-space-character</a></i>
   <i><a href="#grammar-white-space">white-space</a></i>   <i><a href="#grammar-white-space-character">white-space-character</a></i>

<a name="grammar-white-space-character"><i>white-space-character::</i>
   <i><a href="#grammar-new-line">new-line</a></i>
   Space character (U+0020)
   Horizontal-tab character (U+0009)

<a name="grammar-token"><i>token::</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>
   <i><a href="#grammar-name">name</a></i>
   <i><a href="#grammar-keyword">keyword</a></i>
   <i><a href="#grammar-integer-literal">integer-literal</a></i>
   <i><a href="#grammar-floating-literal">floating-literal</a></i>
   <i><a href="#grammar-string-literal">string-literal</a></i>
   <i><a href="#grammar-operator-or-punctuator">operator-or-punctuator</a></i>

<a name="grammar-variable-name"><i>variable-name::</i>
   $   <i><a href="#grammar-name">name</a></i>

<a name="grammar-namespace-name"><i>namespace-name::</i>
   <i><a href="#grammar-name">name</a></i>
   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \   <i><a href="#grammar-name">name</a></i>

<a name="grammar-namespace-name-as-a-prefix"><i>namespace-name-as-a-prefix::</i>
   \
   \<sub>opt</sub>   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \
   namespace   \
   namespace   \   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \

<a name="grammar-qualified-name"><i>qualified-name::</i>
   <i><a href="#grammar-namespace-name-as-a-prefix">namespace-name-as-a-prefix</a></i><sub>opt</sub>   <i><a href="#grammar-name">name</a></i>

<a name="grammar-name"><i>name::</i>
   <i><a href="#grammar-name-nondigit">name-nondigit</a></i>
   <i><a href="#grammar-name">name</a></i>   <i><a href="#grammar-name-nondigit">name-nondigit</a></i>
   <i><a href="#grammar-name">name</a></i>   <i><a href="#grammar-digit">digit</a></i>

<a name="grammar-name-nondigit"><i>name-nondigit::</i>
   <i><a href="#grammar-nondigit">nondigit</a></i>
   one of the characters U+0080–U+00ff

<a name="grammar-nondigit"><i>nondigit:: one of</i>
   _
   a   b   c   d   e   f   g   h   i   j   k   l   m
   n   o   p   q   r   s   t   u   v   w   x   y   z
   A   B   C   D   E   F   G   H   I   J   K   L   M
   N   O   P   Q   R   S   T   U   V   W   X   Y   Z

<a name="grammar-keyword"><i>keyword:: one of</i>
   abstract   and   array   as   break   callable   case   catch   class   clone
   const   continue   declare   default   die   do   echo   else   elseif   empty
   enddeclare   endfor   endforeach   endif   endswitch   endwhile   eval   exit
   extends   final   finally   for   foreach   function   global
   goto   if   implements   include   include_once   instanceof
   insteadof   interface   isset   list   namespace   new   or   print   private
   protected   public   require   require_once   return   static   switch
   throw   trait   try   unset   use   var   while   xor   yield   yield from

<a name="grammar-integer-literal"><i>integer-literal::</i>
   <i><a href="#grammar-decimal-literal">decimal-literal</a></i>
   <i><a href="#grammar-octal-literal">octal-literal</a></i>
   <i><a href="#grammar-hexadecimal-literal">hexadecimal-literal</a></i>
   <i><a href="#grammar-binary-literal">binary-literal</a></i>

<a name="grammar-decimal-literal"><i>decimal-literal::</i>
   <i><a href="#grammar-nonzero-digit">nonzero-digit</a></i>
   <i><a href="#grammar-decimal-literal">decimal-literal</a></i>   <i><a href="#grammar-digit">digit</a></i>

<a name="grammar-octal-literal"><i>octal-literal::</i>
   0
   <i><a href="#grammar-octal-literal">octal-literal</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<a name="grammar-hexadecimal-literal"><i>hexadecimal-literal::</i>
   <i><a href="#grammar-hexadecimal-prefix">hexadecimal-prefix</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>
   <i><a href="#grammar-hexadecimal-literal">hexadecimal-literal</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>

<a name="grammar-hexadecimal-prefix"><i>hexadecimal-prefix:: one of</i>
   0x   0X

<a name="grammar-binary-literal"><i>binary-literal::</i>
   <i><a href="#grammar-binary-prefix">binary-prefix</a></i>   <i><a href="#grammar-binary-digit">binary-digit</a></i>
   <i><a href="#grammar-binary-literal">binary-literal</a></i>   <i><a href="#grammar-binary-digit">binary-digit</a></i>

<a name="grammar-binary-prefix"><i>binary-prefix:: one of</i>
   0b   0B

<a name="grammar-digit"><i>digit:: one of</i>
   0   1   2   3   4   5   6   7   8   9

<a name="grammar-nonzero-digit"><i>nonzero-digit:: one of</i>
   1   2   3   4   5   6   7   8   9

<a name="grammar-octal-digit"><i>octal-digit:: one of</i>
   0   1   2   3   4   5   6   7

<a name="grammar-hexadecimal-digit"><i>hexadecimal-digit:: one of</i>
   0   1   2   3   4   5   6   7   8   9
   a   b   c   d   e   f
   A   B   C   D   E   F

<a name="grammar-binary-digit"><i>binary-digit:: one of</i>
   0   1

<a name="grammar-floating-literal"><i>floating-literal::</i>
   <i><a href="#grammar-fractional-literal">fractional-literal</a></i>   <i><a href="#grammar-exponent-part">exponent-part</a></i><sub>opt</sub>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>   <i><a href="#grammar-exponent-part">exponent-part</a></i>

<a name="grammar-fractional-literal"><i>fractional-literal::</i>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i><sub>opt</sub>   .   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>   .

<a name="grammar-exponent-part"><i>exponent-part::</i>
   e   <i><a href="#grammar-sign">sign</a></i><sub>opt</sub>   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>
   E   <i><a href="#grammar-sign">sign</a></i><sub>opt</sub>   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>

<a name="grammar-sign"><i>sign:: one of</i>
   +   -

<a name="grammar-digit-sequence"><i>digit-sequence::</i>
   <i><a href="#grammar-digit">digit</a></i>
   <i><a href="#grammar-digit-sequence">digit-sequence</a></i>   <i><a href="#grammar-digit">digit</a></i>

<a name="grammar-string-literal"><i>string-literal::</i>
   <i><a href="#grammar-single-quoted-string-literal">single-quoted-string-literal</a></i>
   <i><a href="#grammar-double-quoted-string-literal">double-quoted-string-literal</a></i>
   <i><a href="#grammar-heredoc-string-literal">heredoc-string-literal</a></i>
   <i><a href="#grammar-nowdoc-string-literal">nowdoc-string-literal</a></i>

<a name="grammar-single-quoted-string-literal"><i>single-quoted-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   '   <i><a href="#grammar-sq-char-sequence">sq-char-sequence</a></i><sub>opt</sub>   '

<a name="grammar-sq-char-sequence"><i>sq-char-sequence::</i>
   <i><a href="#grammar-sq-char">sq-char</a></i>
   <i><a href="#grammar-sq-char-sequence">sq-char-sequence</a></i>   <i><a href="#grammar-sq-char">sq-char</a></i>

<a name="grammar-sq-char"><i>sq-char::</i>
   <i><a href="#grammar-sq-escape-sequence">sq-escape-sequence</a></i>
   \<sub>opt</sub>   any member of the source character set except single-quote (') or backslash (\)

<a name="grammar-sq-escape-sequence"><i>sq-escape-sequence:: one of</i>
   \'   \\

<a name="grammar-b-prefix"><i>b-prefix:: one of</i>
   b   B

<a name="grammar-double-quoted-string-literal"><i>double-quoted-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   &quot;   <i><a href="#grammar-dq-char-sequence">dq-char-sequence</a></i><sub>opt</sub>   &quot;

<a name="grammar-dq-char-sequence"><i>dq-char-sequence::</i>
   <i><a href="#grammar-dq-char">dq-char</a></i>
   <i><a href="#grammar-dq-char-sequence">dq-char-sequence</a></i>   <i><a href="#grammar-dq-char">dq-char</a></i>

<a name="grammar-dq-char"><i>dq-char::</i>
   <i><a href="#grammar-dq-escape-sequence">dq-escape-sequence</a></i>
   any member of the source character set except double-quote (&quot;) or backslash (\)
   \   any member of the source character set except &quot;\$efnrtvxX or   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<a name="grammar-dq-escape-sequence"><i>dq-escape-sequence::</i>
   <i><a href="#grammar-dq-simple-escape-sequence">dq-simple-escape-sequence</a></i>
   <i><a href="#grammar-dq-octal-escape-sequence">dq-octal-escape-sequence</a></i>
   <i><a href="#grammar-dq-hexadecimal-escape-sequence">dq-hexadecimal-escape-sequence</a></i>
   <i><a href="#grammar-dq-unicode-escape-sequence">dq-unicode-escape-sequence</a></i>

<a name="grammar-dq-simple-escape-sequence"><i>dq-simple-escape-sequence:: one of</i>
   \&quot;   \\   \$   \e   \f   \n   \r   \t   \v

<a name="grammar-dq-octal-escape-sequence"><i>dq-octal-escape-sequence::</i>
   \   <i><a href="#grammar-octal-digit">octal-digit</a></i>
   \   <i><a href="#grammar-octal-digit">octal-digit</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>
   \   <i><a href="#grammar-octal-digit">octal-digit</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<a name="grammar-dq-hexadecimal-escape-sequence"><i>dq-hexadecimal-escape-sequence::</i>
   \x   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i><sub>opt</sub>
   \X   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i><sub>opt</sub>

<a name="grammar-dq-unicode-escape-sequence"><i>dq-unicode-escape-sequence::</i>
   \u{   <i><a href="#grammar-codepoint-digits">codepoint-digits</a></i>   }

<a name="grammar-codepoint-digits"><i>codepoint-digits::</i>
   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>
   <i><a href="#grammar-hexadecimal-digit">hexadecimal-digit</a></i>   <i><a href="#grammar-codepoint-digits">codepoint-digits</a></i>

<a name="grammar-string-variable"><i>string-variable::</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>   <i><a href="#grammar-offset-or-property">offset-or-property</a></i><sub>opt</sub>
   ${   <i><a href="#grammar-expression">expression</a></i>   }

<a name="grammar-offset-or-property"><i>offset-or-property::</i>
   <i><a href="#grammar-offset-in-string">offset-in-string</a></i>
   <i><a href="#grammar-property-in-string">property-in-string</a></i>

<a name="grammar-offset-in-string"><i>offset-in-string::</i>
   [   <i><a href="#grammar-name">name</a></i>   ]
   [   <i><a href="#grammar-variable-name">variable-name</a></i>   ]
   [   <i><a href="#grammar-integer-literal">integer-literal</a></i>   ]

<a name="grammar-property-in-string"><i>property-in-string::</i>
   -&gt;   <i><a href="#grammar-name">name</a></i>

<a name="grammar-heredoc-string-literal"><i>heredoc-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   &lt;&lt;&lt;   <i><a href="#grammar-hd-start-identifier">hd-start-identifier</a></i>   <i><a href="#grammar-new-line">new-line</a></i>   <i><a href="#grammar-hd-body">hd-body</a></i><sub>opt</sub>   <i><a href="#grammar-hd-end-identifier">hd-end-identifier</a></i>   ;<sub>opt</sub>   <i><a href="#grammar-new-line">new-line</a></i>

<a name="grammar-hd-start-identifier"><i>hd-start-identifier::</i>
   <i><a href="#grammar-name">name</a></i>
   &quot;   <i><a href="#grammar-name">name</a></i>   &quot;

<a name="grammar-hd-end-identifier"><i>hd-end-identifier::</i>
   <i><a href="#grammar-name">name</a></i>

<a name="grammar-hd-body"><i>hd-body::</i>
   <i><a href="#grammar-hd-char-sequence">hd-char-sequence</a></i><sub>opt</sub>   <i><a href="#grammar-new-line">new-line</a></i>

<a name="grammar-hd-char-sequence"><i>hd-char-sequence::</i>
   <i><a href="#grammar-hd-char">hd-char</a></i>
   <i><a href="#grammar-hd-char-sequence">hd-char-sequence</a></i>   <i><a href="#grammar-hd-char">hd-char</a></i>

<a name="grammar-hd-char"><i>hd-char::</i>
   <i><a href="#grammar-hd-escape-sequence">hd-escape-sequence</a></i>
   any member of the source character set except backslash (\)
   \ any member of the source character set except \$efnrtvxX or   <i><a href="#grammar-octal-digit">octal-digit</a></i>

<a name="grammar-hd-escape-sequence"><i>hd-escape-sequence::</i>
   <i><a href="#grammar-hd-simple-escape-sequence">hd-simple-escape-sequence</a></i>
   <i><a href="#grammar-dq-octal-escape-sequence">dq-octal-escape-sequence</a></i>
   <i><a href="#grammar-dq-hexadecimal-escape-sequence">dq-hexadecimal-escape-sequence</a></i>
   <i><a href="#grammar-dq-unicode-escape-sequence">dq-unicode-escape-sequence</a></i>

<a name="grammar-hd-simple-escape-sequence"><i>hd-simple-escape-sequence:: one of</i>
   \\   \$   \e   \f   \n   \r   \t   \v

<a name="grammar-nowdoc-string-literal"><i>nowdoc-string-literal::</i>
   <i><a href="#grammar-b-prefix">b-prefix</a></i><sub>opt</sub>   &lt;&lt;&lt;   '   <i><a href="#grammar-name">name</a></i>   '   <i><a href="#grammar-new-line">new-line</a></i>   <i><a href="#grammar-hd-body">hd-body</a></i><sub>opt</sub>   <i><a href="#grammar-name">name</a></i>   ;<sub>opt</sub>   <i><a href="#grammar-new-line">new-line</a></i>

<a name="grammar-operator-or-punctuator"><i>operator-or-punctuator:: one of</i>
   [   ]   (   )   {   }   .   -&gt;   ++   --   **   *   +   -   ~   !
   $   /   %   &lt;&lt;   &gt;&gt;   &lt;   &gt;   &lt;=   &gt;=   ==   ===   !=   !==   ^   |
   &amp;   &amp;&amp;   ||   ?   :   ;   =   **=   *=   /=   %=   +=   -=   .=   &lt;&lt;=
   &gt;&gt;=   &amp;=   ^=   |=   ,   ??   &lt;=&gt;   ...   \
</pre>

##Syntactic Grammar

###Basic Concepts

<pre>
<a name="grammar-script"><i>script:</i>
   <i><a href="#grammar-script-section">script-section</a></i>
   <i><a href="#grammar-script">script</a></i>   <i><a href="#grammar-script-section">script-section</a></i>

<a name="grammar-script-section"><i>script-section:</i>
   <i><a href="#grammar-text">text</a></i><sub>opt</sub>   <i><a href="#grammar-start-tag">start-tag</a></i>   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>   <i><a href="#grammar-end-tag">end-tag</a></i><sub>opt</sub>   <i><a href="#grammar-text">text</a></i><sub>opt</sub>

<a name="grammar-start-tag"><i>start-tag:</i>
   &lt;?php
   &lt;?=

<a name="grammar-end-tag"><i>end-tag:</i>
   ?&gt;

<a name="grammar-text"><i>text:</i>
   arbitrary text not containing any of   <i><a href="#grammar-start-tag">start-tag</a></i>   sequences
</pre>

###Variables

<pre>
<a name="grammar-function-static-declaration"><i>function-static-declaration:</i>
   static   <i><a href="#grammar-static-variable-name-list">static-variable-name-list</a></i>   ;

<a name="grammar-static-variable-name-list"><i>static-variable-name-list:</i>
   <i><a href="#grammar-static-variable-declaration">static-variable-declaration</a></i>
   <i><a href="#grammar-static-variable-name-list">static-variable-name-list</a></i>   ,   <i><a href="#grammar-static-variable-declaration">static-variable-declaration</a></i>

<a name="grammar-static-variable-declaration"><i>static-variable-declaration:</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>   <i><a href="#grammar-function-static-initializer">function-static-initializer</a></i><sub>opt</sub>

<a name="grammar-function-static-initializer"><i>function-static-initializer:</i>
   =   <i><a href="#grammar-constant-expression">constant-expression</a></i>

<a name="grammar-global-declaration"><i>global-declaration:</i>
   global   <i><a href="#grammar-variable-name-list">variable-name-list</a></i>   ;

<a name="grammar-variable-name-list"><i>variable-name-list:</i>
   <i><a href="#grammar-simple-variable">simple-variable</a></i>
   <i><a href="#grammar-variable-name-list">variable-name-list</a></i>   ,   <i><a href="#grammar-simple-variable">simple-variable</a></i>
</pre>

###Expressions

<pre>
<a name="grammar-primary-expression"><i>primary-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>
   <i><a href="#grammar-class-constant-access-expression">class-constant-access-expression</a></i>
   <i><a href="#grammar-constant-access-expression">constant-access-expression</a></i>
   <i><a href="#grammar-literal">literal</a></i>
   <i><a href="#grammar-array-creation-expression">array-creation-expression</a></i>
   <i><a href="#grammar-intrinsic">intrinsic</a></i>
   <i><a href="#grammar-anonymous-function-creation-expression">anonymous-function-creation-expression</a></i>
   (   <i><a href="#grammar-expression">expression</a></i>   )

<a name="grammar-simple-variable"><i>simple-variable:</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>
   $   <i><a href="#grammar-simple-variable">simple-variable</a></i>
   $   {   <i><a href="#grammar-expression">expression</a></i>   }

<a name="grammar-dereferencable-expression"><i>dereferencable-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>
   (   <i><a href="#grammar-expression">expression</a></i>   )
   <i><a href="#grammar-array-creation-expression">array-creation-expression</a></i>
   <i><a href="#grammar-string-literal">string-literal</a></i>

<a name="grammar-callable-expression"><i>callable-expression:</i>
   <i><a href="#grammar-callable-variable">callable-variable</a></i>
   (   <i><a href="#grammar-expression">expression</a></i>   )
   <i><a href="#grammar-array-creation-expression">array-creation-expression</a></i>
   <i><a href="#grammar-string-literal">string-literal</a></i>

<a name="grammar-callable-variable"><i>callable-variable:</i>
   <i><a href="#grammar-simple-variable">simple-variable</a></i>
   <i><a href="#grammar-subscript-expression">subscript-expression</a></i>
   <i><a href="#grammar-member-call-expression">member-call-expression</a></i>
   <i><a href="#grammar-scoped-call-expression">scoped-call-expression</a></i>
   <i><a href="#grammar-function-call-expression">function-call-expression</a></i>

<a name="grammar-variable"><i>variable:</i>
   <i><a href="#grammar-callable-variable">callable-variable</a></i>
   <i><a href="#grammar-scoped-property-access-expression">scoped-property-access-expression</a></i>
   <i><a href="#grammar-member-access-expression">member-access-expression</a></i>

<a name="grammar-constant-access-expression"><i>constant-access-expression:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<a name="grammar-literal"><i>literal:</i>
   <i><a href="#grammar-integer-literal">integer-literal</a></i>
   <i><a href="#grammar-floating-literal">floating-literal</a></i>
   <i><a href="#grammar-string-literal">string-literal</a></i>

<a name="grammar-intrinsic"><i>intrinsic:</i>
   <i><a href="#grammar-intrinsic-construct">intrinsic-construct</a></i>
   <i><a href="#grammar-intrinsic-operator">intrinsic-operator</a></i>

<a name="grammar-intrinsic-construct"><i>intrinsic-construct:</i>
   <i><a href="#grammar-echo-intrinsic">echo-intrinsic</a></i>
   <i><a href="#grammar-list-intrinsic">list-intrinsic</a></i>
   <i><a href="#grammar-unset-intrinsic">unset-intrinsic</a></i>

<a name="grammar-intrinsic-operator"><i>intrinsic-operator:</i>
   <i><a href="#grammar-empty-intrinsic">empty-intrinsic</a></i>
   <i><a href="#grammar-eval-intrinsic">eval-intrinsic</a></i>
   <i><a href="#grammar-exit-intrinsic">exit-intrinsic</a></i>
   <i><a href="#grammar-isset-intrinsic">isset-intrinsic</a></i>
   <i><a href="#grammar-print-intrinsic">print-intrinsic</a></i>

<a name="grammar-echo-intrinsic"><i>echo-intrinsic:</i>
   echo   <i><a href="#grammar-expression-list">expression-list</a></i>

<a name="grammar-expression-list"><i>expression-list:</i>
   <i><a href="#grammar-expression">expression</a></i>
   <i><a href="#grammar-expression-list">expression-list</a></i>   ,   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-empty-intrinsic"><i>empty-intrinsic:</i>
   empty   (   <i><a href="#grammar-expression">expression</a></i>   )

<a name="grammar-eval-intrinsic"><i>eval-intrinsic:</i>
   eval   (   <i><a href="#grammar-expression">expression</a></i>   )

<a name="grammar-exit-intrinsic"><i>exit-intrinsic:</i>
   exit
   exit   (   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   )
   die
   die   (   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   )

<a name="grammar-isset-intrinsic"><i>isset-intrinsic:</i>
   isset   (   <i><a href="#grammar-variable-list">variable-list</a></i>   )

<a name="grammar-variable-list"><i>variable-list:</i>
   <i><a href="#grammar-variable">variable</a></i>
   <i><a href="#grammar-variable-list">variable-list</a></i>   ,   <i><a href="#grammar-variable">variable</a></i>

<a name="grammar-list-intrinsic"><i>list-intrinsic:</i>
   list   (   <i><a href="#grammar-list-expression-list">list-expression-list</a></i>   )

<a name="grammar-list-expression-list"><i>list-expression-list:</i>
   <i><a href="#grammar-unkeyed-list-expression-list">unkeyed-list-expression-list</a></i>
   <i><a href="#grammar-keyed-list-expression-list">keyed-list-expression-list</a></i>   ,<sub>opt</sub>

<a name="grammar-unkeyed-list-expression-list"><i>unkeyed-list-expression-list:</i>
   <i><a href="#grammar-list-or-variable">list-or-variable</a></i>
   ,
   <i><a href="#grammar-unkeyed-list-expression-list">unkeyed-list-expression-list</a></i>   ,   <i><a href="#grammar-list-or-variable">list-or-variable</a></i><sub>opt</sub>

<a name="grammar-keyed-list-expression-list"><i>keyed-list-expression-list:</i>
   <i><a href="#grammar-expression">expression</a></i>   =&gt;   <i><a href="#grammar-list-or-variable">list-or-variable</a></i>
   <i><a href="#grammar-keyed-list-expression-list">keyed-list-expression-list</a></i>   ,   <i><a href="#grammar-expression">expression</a></i>   =&gt;   <i><a href="#grammar-list-or-variable">list-or-variable</a></i>

<a name="grammar-list-or-variable"><i>list-or-variable:</i>
   <i><a href="#grammar-list-intrinsic">list-intrinsic</a></i>
   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-print-intrinsic"><i>print-intrinsic:</i>
   print   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-unset-intrinsic"><i>unset-intrinsic:</i>
   unset   (   <i><a href="#grammar-variable-list">variable-list</a></i>   )

<a name="grammar-anonymous-function-creation-expression"><i>anonymous-function-creation-expression:</i>
   static?   function   &amp;<sub>opt</sub>   (   <i><a href="#grammar-parameter-declaration-list">parameter-declaration-list</a></i><sub>opt</sub>   )   <i><a href="#grammar-return-type">return-type</a></i><sub>opt</sub>   <i><a href="#grammar-anonymous-function-use-clause">anonymous-function-use-clause</a></i><sub>opt</sub>   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<a name="grammar-anonymous-function-use-clause"><i>anonymous-function-use-clause:</i>
   use   (   <i><a href="#grammar-use-variable-name-list">use-variable-name-list</a></i>   )

<a name="grammar-use-variable-name-list"><i>use-variable-name-list:</i>
   &amp;<sub>opt</sub>   <i><a href="#grammar-variable-name">variable-name</a></i>
   <i><a href="#grammar-use-variable-name-list">use-variable-name-list</a></i>   ,   &amp;<sub>opt</sub>   <i><a href="#grammar-variable-name">variable-name</a></i>

<a name="grammar-postfix-expression"><i>postfix-expression:</i>
   <i><a href="#grammar-primary-expression">primary-expression</a></i>
   <i><a href="#grammar-clone-expression">clone-expression</a></i>
   <i><a href="#grammar-object-creation-expression">object-creation-expression</a></i>
   <i><a href="#grammar-postfix-increment-expression">postfix-increment-expression</a></i>
   <i><a href="#grammar-postfix-decrement-expression">postfix-decrement-expression</a></i>
   <i><a href="#grammar-exponentiation-expression">exponentiation-expression</a></i>

<a name="grammar-clone-expression"><i>clone-expression:</i>
   clone   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-object-creation-expression"><i>object-creation-expression:</i>
   new   <i><a href="#grammar-class-type-designator">class-type-designator</a></i>   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )
   new   <i><a href="#grammar-class-type-designator">class-type-designator</a></i>
   new   class   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )   <i><a href="#grammar-class-base-clause">class-base-clause</a></i><sub>opt</sub>   <i><a href="#grammar-class-interface-clause">class-interface-clause</a></i><sub>opt</sub>   {   <i><a href="#grammar-class-member-declarations">class-member-declarations</a></i><sub>opt</sub>   }
   new   class   <i><a href="#grammar-class-base-clause">class-base-clause</a></i><sub>opt</sub>   <i><a href="#grammar-class-interface-clause">class-interface-clause</a></i><sub>opt</sub>   {   <i><a href="#grammar-class-member-declarations">class-member-declarations</a></i><sub>opt</sub>   }

<a name="grammar-class-type-designator"><i>class-type-designator:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-array-creation-expression"><i>array-creation-expression:</i>
   array   (   <i><a href="#grammar-array-initializer">array-initializer</a></i><sub>opt</sub>   )
   [   <i><a href="#grammar-array-initializer">array-initializer</a></i><sub>opt</sub>   ]

<a name="grammar-array-initializer"><i>array-initializer:</i>
   <i><a href="#grammar-array-initializer-list">array-initializer-list</a></i>   ,<sub>opt</sub>

<a name="grammar-array-initializer-list"><i>array-initializer-list:</i>
   <i><a href="#grammar-array-element-initializer">array-element-initializer</a></i>
   <i><a href="#grammar-array-element-initializer">array-element-initializer</a></i>   ,   <i><a href="#grammar-array-initializer-list">array-initializer-list</a></i>

<a name="grammar-array-element-initializer"><i>array-element-initializer:</i>
   &amp;<sub>opt</sub>   <i><a href="#grammar-element-value">element-value</a></i>
   <i><a href="#grammar-element-key">element-key</a></i>   =&gt;   &amp;<sub>opt</sub>   <i><a href="#grammar-element-value">element-value</a></i>

<a name="grammar-element-key"><i>element-key:</i>
   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-element-value"><i>element-value:</i>
   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-subscript-expression"><i>subscript-expression:</i>
   <i><a href="#grammar-dereferencable-expression">dereferencable-expression</a></i>   [   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   ]
   <i><a href="#grammar-dereferencable-expression">dereferencable-expression</a></i>   {   <i><a href="#grammar-expression">expression</a></i>   }   &lt;b&gt;[Deprecated form]&lt;/b&gt;

<a name="grammar-function-call-expression"><i>function-call-expression:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )
   <i><a href="#grammar-callable-expression">callable-expression</a></i>   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )

<a name="grammar-argument-expression-list"><i>argument-expression-list:</i>
   <i><a href="#grammar-argument-expression">argument-expression</a></i>
   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i>   ,   <i><a href="#grammar-argument-expression">argument-expression</a></i>

<a name="grammar-argument-expression"><i>argument-expression:</i>
   <i><a href="#grammar-variadic-unpacking">variadic-unpacking</a></i>
   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<a name="grammar-variadic-unpacking"><i>variadic-unpacking:</i>
   ...   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<a name="grammar-member-access-expression"><i>member-access-expression:</i>
   <i><a href="#grammar-dereferencable-expression">dereferencable-expression</a></i>   -&gt;   <i><a href="#grammar-member-name">member-name</a></i>

<a name="grammar-member-name"><i>member-name:</i>
   <i><a href="#grammar-name">name</a></i>
   <i><a href="#grammar-simple-variable">simple-variable</a></i>
   {   <i><a href="#grammar-expression">expression</a></i>   }

<a name="grammar-member-call-expression"><i>member-call-expression:</i>
   <i><a href="#grammar-dereferencable-expression">dereferencable-expression</a></i>   -&gt;   <i><a href="#grammar-member-name">member-name</a></i>   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )

<a name="grammar-postfix-increment-expression"><i>postfix-increment-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>   ++

<a name="grammar-postfix-decrement-expression"><i>postfix-decrement-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>   --

<a name="grammar-scoped-property-access-expression"><i>scoped-property-access-expression:</i>
   <i><a href="#grammar-scope-resolution-qualifier">scope-resolution-qualifier</a></i>   ::   <i><a href="#grammar-simple-variable">simple-variable</a></i>

<a name="grammar-scoped-call-expression"><i>scoped-call-expression:</i>
   <i><a href="#grammar-scope-resolution-qualifier">scope-resolution-qualifier</a></i>   ::   <i><a href="#grammar-member-name">member-name</a></i>   (   <i><a href="#grammar-argument-expression-list">argument-expression-list</a></i><sub>opt</sub>   )

<a name="grammar-class-constant-access-expression"><i>class-constant-access-expression:</i>
   <i><a href="#grammar-scope-resolution-qualifier">scope-resolution-qualifier</a></i>   ::   <i><a href="#grammar-name">name</a></i>

<a name="grammar-scope-resolution-qualifier"><i>scope-resolution-qualifier:</i>
   <i><a href="#grammar-relative-scope">relative-scope</a></i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-dereferencable-expression">dereferencable-expression</a></i>

<a name="grammar-relative-scope"><i>relative-scope:</i>
   self
   parent
   static

<a name="grammar-exponentiation-expression"><i>exponentiation-expression:</i>
   <i><a href="#grammar-expression">expression</a></i>   **   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-unary-expression"><i>unary-expression:</i>
   <i><a href="#grammar-postfix-expression">postfix-expression</a></i>
   <i><a href="#grammar-prefix-increment-expression">prefix-increment-expression</a></i>
   <i><a href="#grammar-prefix-decrement-expression">prefix-decrement-expression</a></i>
   <i><a href="#grammar-unary-op-expression">unary-op-expression</a></i>
   <i><a href="#grammar-error-control-expression">error-control-expression</a></i>
   <i><a href="#grammar-shell-command-expression">shell-command-expression</a></i>
   <i><a href="#grammar-cast-expression">cast-expression</a></i>

<a name="grammar-prefix-increment-expression"><i>prefix-increment-expression:</i>
   ++   <i><a href="#grammar-variable">variable</a></i>

<a name="grammar-prefix-decrement-expression"><i>prefix-decrement-expression:</i>
   --   <i><a href="#grammar-variable">variable</a></i>

<a name="grammar-unary-op-expression"><i>unary-op-expression:</i>
   <i><a href="#grammar-unary-operator">unary-operator</a></i>   <i><a href="#grammar-cast-expression">cast-expression</a></i>

<a name="grammar-unary-operator"><i>unary-operator: one of</i>
   +   -   !   ~

<a name="grammar-error-control-expression"><i>error-control-expression:</i>
   @   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-shell-command-expression"><i>shell-command-expression:</i>
   `   <i><a href="#grammar-dq-char-sequence">dq-char-sequence</a></i><sub>opt</sub>   `

<a name="grammar-cast-expression"><i>cast-expression:</i>
   <i><a href="#grammar-unary-expression">unary-expression</a></i>
   (   <i><a href="#grammar-cast-type">cast-type</a></i>   )   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-cast-type"><i>cast-type: one of</i>
   array   binary   bool   boolean   double   int   integer   float   object
   real   string   unset

<a name="grammar-instanceof-expression"><i>instanceof-expression:</i>
   <i><a href="#grammar-unary-expression">unary-expression</a></i>
   <i><a href="#grammar-instanceof-subject">instanceof-subject</a></i>   instanceof   <i><a href="#grammar-instanceof-type-designator">instanceof-type-designator</a></i>

<a name="grammar-instanceof-subject"><i>instanceof-subject:</i>
   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-instanceof-type-designator"><i>instanceof-type-designator:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-multiplicative-expression"><i>multiplicative-expression:</i>
   <i><a href="#grammar-instanceof-expression">instanceof-expression</a></i>
   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>   *   <i><a href="#grammar-instanceof-expression">instanceof-expression</a></i>
   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>   /   <i><a href="#grammar-instanceof-expression">instanceof-expression</a></i>
   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>   %   <i><a href="#grammar-instanceof-expression">instanceof-expression</a></i>

<a name="grammar-additive-expression"><i>additive-expression:</i>
   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>
   <i><a href="#grammar-additive-expression">additive-expression</a></i>   +   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>
   <i><a href="#grammar-additive-expression">additive-expression</a></i>   -   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>
   <i><a href="#grammar-additive-expression">additive-expression</a></i>   .   <i><a href="#grammar-multiplicative-expression">multiplicative-expression</a></i>

<a name="grammar-shift-expression"><i>shift-expression:</i>
   <i><a href="#grammar-additive-expression">additive-expression</a></i>
   <i><a href="#grammar-shift-expression">shift-expression</a></i>   &lt;&lt;   <i><a href="#grammar-additive-expression">additive-expression</a></i>
   <i><a href="#grammar-shift-expression">shift-expression</a></i>   &gt;&gt;   <i><a href="#grammar-additive-expression">additive-expression</a></i>

<a name="grammar-relational-expression"><i>relational-expression:</i>
   <i><a href="#grammar-shift-expression">shift-expression</a></i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>   &lt;   <i><a href="#grammar-shift-expression">shift-expression</a></i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>   &gt;   <i><a href="#grammar-shift-expression">shift-expression</a></i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>   &lt;=   <i><a href="#grammar-shift-expression">shift-expression</a></i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>   &gt;=   <i><a href="#grammar-shift-expression">shift-expression</a></i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>   &lt;=&gt;   <i><a href="#grammar-shift-expression">shift-expression</a></i>

<a name="grammar-equality-expression"><i>equality-expression:</i>
   <i><a href="#grammar-relational-expression">relational-expression</a></i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>   ==   <i><a href="#grammar-relational-expression">relational-expression</a></i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>   !=   <i><a href="#grammar-relational-expression">relational-expression</a></i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>   &lt;&gt;   <i><a href="#grammar-relational-expression">relational-expression</a></i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>   ===   <i><a href="#grammar-relational-expression">relational-expression</a></i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>   !==   <i><a href="#grammar-relational-expression">relational-expression</a></i>

<a name="grammar-bitwise-AND-expression"><i>bitwise-AND-expression:</i>
   <i><a href="#grammar-equality-expression">equality-expression</a></i>
   <i><a href="#grammar-bitwise-AND-expression">bitwise-AND-expression</a></i>   &amp;   <i><a href="#grammar-equality-expression">equality-expression</a></i>

<a name="grammar-bitwise-exc-OR-expression"><i>bitwise-exc-OR-expression:</i>
   <i><a href="#grammar-bitwise-AND-expression">bitwise-AND-expression</a></i>
   <i><a href="#grammar-bitwise-exc-OR-expression">bitwise-exc-OR-expression</a></i>   ^   <i><a href="#grammar-bitwise-AND-expression">bitwise-AND-expression</a></i>

<a name="grammar-bitwise-inc-OR-expression"><i>bitwise-inc-OR-expression:</i>
   <i><a href="#grammar-bitwise-exc-OR-expression">bitwise-exc-OR-expression</a></i>
   <i><a href="#grammar-bitwise-inc-OR-expression">bitwise-inc-OR-expression</a></i>   |   <i><a href="#grammar-bitwise-exc-OR-expression">bitwise-exc-OR-expression</a></i>

<a name="grammar-logical-AND-expression-1"><i>logical-AND-expression-1:</i>
   <i><a href="#grammar-bitwise-inc-OR-expression">bitwise-inc-OR-expression</a></i>
   <i><a href="#grammar-logical-AND-expression-1">logical-AND-expression-1</a></i>   &amp;&amp;   <i><a href="#grammar-bitwise-inc-OR-expression">bitwise-inc-OR-expression</a></i>

<a name="grammar-logical-inc-OR-expression-1"><i>logical-inc-OR-expression-1:</i>
   <i><a href="#grammar-logical-AND-expression-1">logical-AND-expression-1</a></i>
   <i><a href="#grammar-logical-inc-OR-expression-1">logical-inc-OR-expression-1</a></i>   ||   <i><a href="#grammar-logical-AND-expression-1">logical-AND-expression-1</a></i>

<a name="grammar-conditional-expression"><i>conditional-expression:</i>
   <i><a href="#grammar-logical-inc-OR-expression-1">logical-inc-OR-expression-1</a></i>
   <i><a href="#grammar-logical-inc-OR-expression-1">logical-inc-OR-expression-1</a></i>   ?   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   :   <i><a href="#grammar-conditional-expression">conditional-expression</a></i>

<a name="grammar-coalesce-expression"><i>coalesce-expression:</i>
   <i><a href="#grammar-logical-inc-OR-expression-1">logical-inc-OR-expression-1</a></i>   ??   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-assignment-expression"><i>assignment-expression:</i>
   <i><a href="#grammar-conditional-expression">conditional-expression</a></i>
   <i><a href="#grammar-coalesce-expression">coalesce-expression</a></i>
   <i><a href="#grammar-simple-assignment-expression">simple-assignment-expression</a></i>
   <i><a href="#grammar-byref-assignment-expression">byref-assignment-expression</a></i>
   <i><a href="#grammar-compound-assignment-expression">compound-assignment-expression</a></i>

<a name="grammar-simple-assignment-expression"><i>simple-assignment-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>   =   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>
   <i><a href="#grammar-list-intrinsic">list-intrinsic</a></i>   =   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<a name="grammar-byref-assignment-expression"><i>byref-assignment-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>   =   &amp;   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<a name="grammar-compound-assignment-expression"><i>compound-assignment-expression:</i>
   <i><a href="#grammar-variable">variable</a></i>   <i><a href="#grammar-compound-assignment-operator">compound-assignment-operator</a></i>   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<a name="grammar-compound-assignment-operator"><i>compound-assignment-operator: one of</i>
   **=   *=   /=   %=   +=   -=   .=   &lt;&lt;=   &gt;&gt;=   &amp;=   ^=   |=

<a name="grammar-logical-AND-expression-2"><i>logical-AND-expression-2:</i>
   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>
   <i><a href="#grammar-logical-AND-expression-2">logical-AND-expression-2</a></i>   and   <i><a href="#grammar-assignment-expression">assignment-expression</a></i>

<a name="grammar-logical-exc-OR-expression"><i>logical-exc-OR-expression:</i>
   <i><a href="#grammar-logical-AND-expression-2">logical-AND-expression-2</a></i>
   <i><a href="#grammar-logical-exc-OR-expression">logical-exc-OR-expression</a></i>   xor   <i><a href="#grammar-logical-AND-expression-2">logical-AND-expression-2</a></i>

<a name="grammar-logical-inc-OR-expression-2"><i>logical-inc-OR-expression-2:</i>
   <i><a href="#grammar-logical-exc-OR-expression">logical-exc-OR-expression</a></i>
   <i><a href="#grammar-logical-inc-OR-expression-2">logical-inc-OR-expression-2</a></i>   or   <i><a href="#grammar-logical-exc-OR-expression">logical-exc-OR-expression</a></i>

<a name="grammar-yield-expression"><i>yield-expression:</i>
   <i><a href="#grammar-logical-inc-OR-expression-2">logical-inc-OR-expression-2</a></i>
   yield   <i><a href="#grammar-array-element-initializer">array-element-initializer</a></i>
   yield from   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-expression"><i>expression:</i>
   <i><a href="#grammar-yield-expression">yield-expression</a></i>
   <i><a href="#grammar-include-expression">include-expression</a></i>
   <i><a href="#grammar-include-once-expression">include-once-expression</a></i>
   <i><a href="#grammar-require-expression">require-expression</a></i>
   <i><a href="#grammar-require-once-expression">require-once-expression</a></i>

<a name="grammar-include-expression"><i>include-expression:</i>
   include   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-include-once-expression"><i>include-once-expression:</i>
   include_once   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-require-expression"><i>require-expression:</i>
   require   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-require-once-expression"><i>require-once-expression:</i>
   require_once   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-constant-expression"><i>constant-expression:</i>
   <i><a href="#grammar-expression">expression</a></i>
</pre>

###Statements

<pre>
<a name="grammar-statement"><i>statement:</i>
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

<a name="grammar-compound-statement"><i>compound-statement:</i>
   {   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>   }

<a name="grammar-statement-list"><i>statement-list:</i>
   <i><a href="#grammar-statement">statement</a></i>
   <i><a href="#grammar-statement-list">statement-list</a></i>   <i><a href="#grammar-statement">statement</a></i>

<a name="grammar-named-label-statement"><i>named-label-statement:</i>
   <i><a href="#grammar-name">name</a></i>   ;   <i><a href="#grammar-statement">statement</a></i>

<a name="grammar-expression-statement"><i>expression-statement:</i>
   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   ;

<a name="grammar-selection-statement"><i>selection-statement:</i>
   <i><a href="#grammar-if-statement">if-statement</a></i>
   <i><a href="#grammar-switch-statement">switch-statement</a></i>

<a name="grammar-if-statement"><i>if-statement:</i>
   if   (   <i><a href="#grammar-expression">expression</a></i>   )   <i><a href="#grammar-statement">statement</a></i>   <i><a href="#grammar-elseif-clauses-1">elseif-clauses-1</a></i><sub>opt</sub>   <i><a href="#grammar-else-clause-1">else-clause-1</a></i><sub>opt</sub>
   if   (   <i><a href="#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   <i><a href="#grammar-elseif-clauses-2">elseif-clauses-2</a></i><sub>opt</sub>   <i><a href="#grammar-else-clause-2">else-clause-2</a></i><sub>opt</sub>   endif   ;

<a name="grammar-elseif-clauses-1"><i>elseif-clauses-1:</i>
   <i><a href="#grammar-elseif-clause-1">elseif-clause-1</a></i>
   <i><a href="#grammar-elseif-clauses-1">elseif-clauses-1</a></i>   <i><a href="#grammar-elseif-clause-1">elseif-clause-1</a></i>

<a name="grammar-elseif-clause-1"><i>elseif-clause-1:</i>
   elseif   (   <i><a href="#grammar-expression">expression</a></i>   )   <i><a href="#grammar-statement">statement</a></i>

<a name="grammar-else-clause-1"><i>else-clause-1:</i>
   else   <i><a href="#grammar-statement">statement</a></i>

<a name="grammar-elseif-clauses-2"><i>elseif-clauses-2:</i>
   <i><a href="#grammar-elseif-clause-2">elseif-clause-2</a></i>
   <i><a href="#grammar-elseif-clauses-2">elseif-clauses-2</a></i>   <i><a href="#grammar-elseif-clause-2">elseif-clause-2</a></i>

<a name="grammar-elseif-clause-2"><i>elseif-clause-2:</i>
   elseif   (   <i><a href="#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>

<a name="grammar-else-clause-2"><i>else-clause-2:</i>
   else   :   <i><a href="#grammar-statement-list">statement-list</a></i>

<a name="grammar-switch-statement"><i>switch-statement:</i>
   switch   (   <i><a href="#grammar-expression">expression</a></i>   )   {   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>   }
   switch   (   <i><a href="#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>   endswitch;

<a name="grammar-case-statements"><i>case-statements:</i>
   <i><a href="#grammar-case-statement">case-statement</a></i>   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>
   <i><a href="#grammar-default-statement">default-statement</a></i>   <i><a href="#grammar-case-statements">case-statements</a></i><sub>opt</sub>

<a name="grammar-case-statement"><i>case-statement:</i>
   case   <i><a href="#grammar-expression">expression</a></i>   <i><a href="#grammar-case-default-label-terminator">case-default-label-terminator</a></i>   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>

<a name="grammar-default-statement"><i>default-statement:</i>
   default   <i><a href="#grammar-case-default-label-terminator">case-default-label-terminator</a></i>   <i><a href="#grammar-statement-list">statement-list</a></i><sub>opt</sub>

<a name="grammar-case-default-label-terminator"><i>case-default-label-terminator:</i>
   :
   ;

<a name="grammar-iteration-statement"><i>iteration-statement:</i>
   <i><a href="#grammar-while-statement">while-statement</a></i>
   <i><a href="#grammar-do-statement">do-statement</a></i>
   <i><a href="#grammar-for-statement">for-statement</a></i>
   <i><a href="#grammar-foreach-statement">foreach-statement</a></i>

<a name="grammar-while-statement"><i>while-statement:</i>
   while   (   <i><a href="#grammar-expression">expression</a></i>   )   <i><a href="#grammar-statement">statement</a></i>
   while   (   <i><a href="#grammar-expression">expression</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   endwhile   ;

<a name="grammar-do-statement"><i>do-statement:</i>
   do   <i><a href="#grammar-statement">statement</a></i>   while   (   <i><a href="#grammar-expression">expression</a></i>   )   ;

<a name="grammar-for-statement"><i>for-statement:</i>
   for   (   <i><a href="#grammar-for-initializer">for-initializer</a></i><sub>opt</sub>   ;   <i><a href="#grammar-for-control">for-control</a></i><sub>opt</sub>   ;   <i><a href="#grammar-for-end-of-loop">for-end-of-loop</a></i><sub>opt</sub>   )   <i><a href="#grammar-statement">statement</a></i>
   for   (   <i><a href="#grammar-for-initializer">for-initializer</a></i><sub>opt</sub>   ;   <i><a href="#grammar-for-control">for-control</a></i><sub>opt</sub>   ;   <i><a href="#grammar-for-end-of-loop">for-end-of-loop</a></i><sub>opt</sub>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   endfor   ;

<a name="grammar-for-initializer"><i>for-initializer:</i>
   <i><a href="#grammar-for-expression-group">for-expression-group</a></i>

<a name="grammar-for-control"><i>for-control:</i>
   <i><a href="#grammar-for-expression-group">for-expression-group</a></i>

<a name="grammar-for-end-of-loop"><i>for-end-of-loop:</i>
   <i><a href="#grammar-for-expression-group">for-expression-group</a></i>

<a name="grammar-for-expression-group"><i>for-expression-group:</i>
   <i><a href="#grammar-expression">expression</a></i>
   <i><a href="#grammar-for-expression-group">for-expression-group</a></i>   ,   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-foreach-statement"><i>foreach-statement:</i>
   foreach   (   <i><a href="#grammar-foreach-collection-name">foreach-collection-name</a></i>   as   <i><a href="#grammar-foreach-key">foreach-key</a></i><sub>opt</sub>   <i><a href="#grammar-foreach-value">foreach-value</a></i>   )   statement
   foreach   (   <i><a href="#grammar-foreach-collection-name">foreach-collection-name</a></i>   as   <i><a href="#grammar-foreach-key">foreach-key</a></i><sub>opt</sub>   <i><a href="#grammar-foreach-value">foreach-value</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   endforeach   ;

<a name="grammar-foreach-collection-name"><i>foreach-collection-name:</i>
   <i><a href="#grammar-expression">expression</a></i>

<a name="grammar-foreach-key"><i>foreach-key:</i>
   <i><a href="#grammar-expression">expression</a></i>   =&gt;

<a name="grammar-foreach-value"><i>foreach-value:</i>
   &amp;<sub>opt</sub>   <i><a href="#grammar-expression">expression</a></i>
   <i><a href="#grammar-list-intrinsic">list-intrinsic</a></i>

<a name="grammar-jump-statement"><i>jump-statement:</i>
   <i><a href="#grammar-goto-statement">goto-statement</a></i>
   <i><a href="#grammar-continue-statement">continue-statement</a></i>
   <i><a href="#grammar-break-statement">break-statement</a></i>
   <i><a href="#grammar-return-statement">return-statement</a></i>
   <i><a href="#grammar-throw-statement">throw-statement</a></i>

<a name="grammar-goto-statement"><i>goto-statement:</i>
   goto   <i><a href="#grammar-name">name</a></i>   ;

<a name="grammar-continue-statement"><i>continue-statement:</i>
   continue   <i><a href="#grammar-breakout-level">breakout-level</a></i><sub>opt</sub>   ;

<a name="grammar-breakout-level"><i>breakout-level:</i>
   <i><a href="#grammar-integer-literal">integer-literal</a></i>

<a name="grammar-break-statement"><i>break-statement:</i>
   break   <i><a href="#grammar-breakout-level">breakout-level</a></i><sub>opt</sub>   ;

<a name="grammar-return-statement"><i>return-statement:</i>
   return   <i><a href="#grammar-expression">expression</a></i><sub>opt</sub>   ;

<a name="grammar-throw-statement"><i>throw-statement:</i>
   throw   <i><a href="#grammar-expression">expression</a></i>   ;

<a name="grammar-try-statement"><i>try-statement:</i>
   try   <i><a href="#grammar-compound-statement">compound-statement</a></i>   <i><a href="#grammar-catch-clauses">catch-clauses</a></i>
   try   <i><a href="#grammar-compound-statement">compound-statement</a></i>   <i><a href="#grammar-finally-clause">finally-clause</a></i>
   try   <i><a href="#grammar-compound-statement">compound-statement</a></i>   <i><a href="#grammar-catch-clauses">catch-clauses</a></i>   <i><a href="#grammar-finally-clause">finally-clause</a></i>

<a name="grammar-catch-clauses"><i>catch-clauses:</i>
   <i><a href="#grammar-catch-clause">catch-clause</a></i>
   <i><a href="#grammar-catch-clauses">catch-clauses</a></i>   <i><a href="#grammar-catch-clause">catch-clause</a></i>

<a name="grammar-catch-clause"><i>catch-clause:</i>
   catch   (   <i><a href="#grammar-qualified-name">qualified-name</a></i>   <i><a href="#grammar-variable-name">variable-name</a></i>   )   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<a name="grammar-finally-clause"><i>finally-clause:</i>
   finally   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<a name="grammar-declare-statement"><i>declare-statement:</i>
   declare   (   <i><a href="#grammar-declare-directive">declare-directive</a></i>   )   <i><a href="#grammar-statement">statement</a></i>
   declare   (   <i><a href="#grammar-declare-directive">declare-directive</a></i>   )   :   <i><a href="#grammar-statement-list">statement-list</a></i>   enddeclare   ;
   declare   (   <i><a href="#grammar-declare-directive">declare-directive</a></i>   )   ;

<a name="grammar-declare-directive"><i>declare-directive:</i>
   ticks   =   <i><a href="#grammar-literal">literal</a></i>
   encoding   =   <i><a href="#grammar-literal">literal</a></i>
   strict_types   =   <i><a href="#grammar-literal">literal</a></i>
</pre>

###Functions

<pre>
<a name="grammar-function-definition"><i>function-definition:</i>
   <i><a href="#grammar-function-definition-header">function-definition-header</a></i>   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<a name="grammar-function-definition-header"><i>function-definition-header:</i>
   function   &amp;<sub>opt</sub>   <i><a href="#grammar-name">name</a></i>   (   <i><a href="#grammar-parameter-declaration-list">parameter-declaration-list</a></i><sub>opt</sub>   )   <i><a href="#grammar-return-type">return-type</a></i><sub>opt</sub>

<a name="grammar-parameter-declaration-list"><i>parameter-declaration-list:</i>
   <i><a href="#grammar-simple-parameter-declaration-list">simple-parameter-declaration-list</a></i>
   <i><a href="#grammar-variadic-declaration-list">variadic-declaration-list</a></i>

<a name="grammar-simple-parameter-declaration-list"><i>simple-parameter-declaration-list:</i>
   <i><a href="#grammar-parameter-declaration">parameter-declaration</a></i>
   <i><a href="#grammar-parameter-declaration-list">parameter-declaration-list</a></i>   ,   <i><a href="#grammar-parameter-declaration">parameter-declaration</a></i>

<a name="grammar-variadic-declaration-list"><i>variadic-declaration-list:</i>
   <i><a href="#grammar-simple-parameter-declaration-list">simple-parameter-declaration-list</a></i>   ,   <i><a href="#grammar-variadic-parameter">variadic-parameter</a></i>
   <i><a href="#grammar-variadic-parameter">variadic-parameter</a></i>

<a name="grammar-parameter-declaration"><i>parameter-declaration:</i>
   <i><a href="#grammar-type-declaration">type-declaration</a></i><sub>opt</sub>   &amp;<sub>opt</sub>   <i><a href="#grammar-variable-name">variable-name</a></i>   <i><a href="#grammar-default-argument-specifier">default-argument-specifier</a></i><sub>opt</sub>

<a name="grammar-variadic-parameter"><i>variadic-parameter:</i>
   <i><a href="#grammar-type-declaration">type-declaration</a></i><sub>opt</sub>   &amp;<sub>opt</sub>   ...   <i><a href="#grammar-variable-name">variable-name</a></i>

<a name="grammar-return-type"><i>return-type:</i>
   :   <i><a href="#grammar-type-declaration">type-declaration</a></i>
   :   void

<a name="grammar-type-declaration"><i>type-declaration:</i>
   array
   callable
   <i><a href="#grammar-scalar-type">scalar-type</a></i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<a name="grammar-scalar-type"><i>scalar-type:</i>
   bool
   float
   int
   string

<a name="grammar-default-argument-specifier"><i>default-argument-specifier:</i>
   =   <i><a href="#grammar-constant-expression">constant-expression</a></i>
</pre>

###Classes

<pre>
<a name="grammar-class-declaration"><i>class-declaration:</i>
   <i><a href="#grammar-class-modifier">class-modifier</a></i><sub>opt</sub>   class   <i><a href="#grammar-name">name</a></i>   <i><a href="#grammar-class-base-clause">class-base-clause</a></i><sub>opt</sub>   <i><a href="#grammar-class-interface-clause">class-interface-clause</a></i><sub>opt</sub>   {   <i><a href="#grammar-class-member-declarations">class-member-declarations</a></i><sub>opt</sub>   }

<a name="grammar-class-modifier"><i>class-modifier:</i>
   abstract
   final

<a name="grammar-class-base-clause"><i>class-base-clause:</i>
   extends   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<a name="grammar-class-interface-clause"><i>class-interface-clause:</i>
   implements   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-class-interface-clause">class-interface-clause</a></i>   ,   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<a name="grammar-class-member-declarations"><i>class-member-declarations:</i>
   <i><a href="#grammar-class-member-declaration">class-member-declaration</a></i>
   <i><a href="#grammar-class-member-declarations">class-member-declarations</a></i>   <i><a href="#grammar-class-member-declaration">class-member-declaration</a></i>

<a name="grammar-class-member-declaration"><i>class-member-declaration:</i>
   <i><a href="#grammar-class-const-declaration">class-const-declaration</a></i>
   <i><a href="#grammar-property-declaration">property-declaration</a></i>
   <i><a href="#grammar-method-declaration">method-declaration</a></i>
   <i><a href="#grammar-constructor-declaration">constructor-declaration</a></i>
   <i><a href="#grammar-destructor-declaration">destructor-declaration</a></i>
   <i><a href="#grammar-trait-use-clause">trait-use-clause</a></i>

<a name="grammar-const-declaration"><i>const-declaration:</i>
   const   <i><a href="#grammar-const-elements">const-elements</a></i>   ;

<a name="grammar-class-const-declaration"><i>class-const-declaration:</i>
   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i><sub>opt</sub>   const   <i><a href="#grammar-const-elements">const-elements</a></i>   ;

<a name="grammar-const-elements"><i>const-elements:</i>
   <i><a href="#grammar-const-element">const-element</a></i>
   <i><a href="#grammar-const-elements">const-elements</a></i>   <i><a href="#grammar-const-element">const-element</a></i>

<a name="grammar-const-element"><i>const-element:</i>
   <i><a href="#grammar-name">name</a></i>   =   <i><a href="#grammar-constant-expression">constant-expression</a></i>

<a name="grammar-property-declaration"><i>property-declaration:</i>
   <i><a href="#grammar-property-modifier">property-modifier</a></i>   <i><a href="#grammar-property-elements">property-elements</a></i>   ;

<a name="grammar-property-modifier"><i>property-modifier:</i>
   var
   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i>   <i><a href="#grammar-static-modifier">static-modifier</a></i><sub>opt</sub>
   <i><a href="#grammar-static-modifier">static-modifier</a></i>   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i><sub>opt</sub>

<a name="grammar-visibility-modifier"><i>visibility-modifier:</i>
   public
   protected
   private

<a name="grammar-static-modifier"><i>static-modifier:</i>
   static

<a name="grammar-property-elements"><i>property-elements:</i>
   <i><a href="#grammar-property-element">property-element</a></i>
   <i><a href="#grammar-property-elements">property-elements</a></i>   <i><a href="#grammar-property-element">property-element</a></i>

<a name="grammar-property-element"><i>property-element:</i>
   <i><a href="#grammar-variable-name">variable-name</a></i>   <i><a href="#grammar-property-initializer">property-initializer</a></i><sub>opt</sub>   ;

<a name="grammar-property-initializer"><i>property-initializer:</i>
   =   <i><a href="#grammar-constant-expression">constant-expression</a></i>

<a name="grammar-method-declaration"><i>method-declaration:</i>
   <i><a href="#grammar-method-modifiers">method-modifiers</a></i><sub>opt</sub>   <i><a href="#grammar-function-definition">function-definition</a></i>
   <i><a href="#grammar-method-modifiers">method-modifiers</a></i>   <i><a href="#grammar-function-definition-header">function-definition-header</a></i>   ;

<a name="grammar-method-modifiers"><i>method-modifiers:</i>
   <i><a href="#grammar-method-modifier">method-modifier</a></i>
   <i><a href="#grammar-method-modifiers">method-modifiers</a></i>   <i><a href="#grammar-method-modifier">method-modifier</a></i>

<a name="grammar-method-modifier"><i>method-modifier:</i>
   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i>
   <i><a href="#grammar-static-modifier">static-modifier</a></i>
   <i><a href="#grammar-class-modifier">class-modifier</a></i>

<a name="grammar-constructor-declaration"><i>constructor-declaration:</i>
   <i><a href="#grammar-method-modifiers">method-modifiers</a></i>   function   &amp;<sub>opt</sub>   __construct   (   <i><a href="#grammar-parameter-declaration-list">parameter-declaration-list</a></i><sub>opt</sub>   )   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<a name="grammar-destructor-declaration"><i>destructor-declaration:</i>
   <i><a href="#grammar-method-modifiers">method-modifiers</a></i>   function   &amp;<sub>opt</sub>   __destruct   (   )   <i><a href="#grammar-compound-statement">compound-statement</a></i>
</pre>

###Interfaces

<pre>
<a name="grammar-interface-declaration"><i>interface-declaration:</i>
   interface   <i><a href="#grammar-name">name</a></i>   <i><a href="#grammar-interface-base-clause">interface-base-clause</a></i><sub>opt</sub>   {   <i><a href="#grammar-interface-member-declarations">interface-member-declarations</a></i><sub>opt</sub>   }

<a name="grammar-interface-base-clause"><i>interface-base-clause:</i>
   extends   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-interface-base-clause">interface-base-clause</a></i>   ,   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<a name="grammar-interface-member-declarations"><i>interface-member-declarations:</i>
   <i><a href="#grammar-interface-member-declaration">interface-member-declaration</a></i>
   <i><a href="#grammar-interface-member-declarations">interface-member-declarations</a></i>   <i><a href="#grammar-interface-member-declaration">interface-member-declaration</a></i>

<a name="grammar-interface-member-declaration"><i>interface-member-declaration:</i>
   <i><a href="#grammar-class-const-declaration">class-const-declaration</a></i>
   <i><a href="#grammar-method-declaration">method-declaration</a></i>
</pre>

###Traits

<pre>
<a name="grammar-trait-declaration"><i>trait-declaration:</i>
   trait   <i><a href="#grammar-name">name</a></i>   {   <i><a href="#grammar-trait-member-declarations">trait-member-declarations</a></i><sub>opt</sub>   }

<a name="grammar-trait-member-declarations"><i>trait-member-declarations:</i>
   <i><a href="#grammar-trait-member-declaration">trait-member-declaration</a></i>
   <i><a href="#grammar-trait-member-declarations">trait-member-declarations</a></i>   <i><a href="#grammar-trait-member-declaration">trait-member-declaration</a></i>

<a name="grammar-trait-member-declaration"><i>trait-member-declaration:</i>
   <i><a href="#grammar-property-declaration">property-declaration</a></i>
   <i><a href="#grammar-method-declaration">method-declaration</a></i>
   <i><a href="#grammar-constructor-declaration">constructor-declaration</a></i>
   <i><a href="#grammar-destructor-declaration">destructor-declaration</a></i>
   <i><a href="#grammar-trait-use-clauses">trait-use-clauses</a></i>

<a name="grammar-trait-use-clauses"><i>trait-use-clauses:</i>
   <i><a href="#grammar-trait-use-clause">trait-use-clause</a></i>
   <i><a href="#grammar-trait-use-clauses">trait-use-clauses</a></i>   <i><a href="#grammar-trait-use-clause">trait-use-clause</a></i>

<a name="grammar-trait-use-clause"><i>trait-use-clause:</i>
   use   <i><a href="#grammar-trait-name-list">trait-name-list</a></i>   <i><a href="#grammar-trait-use-specification">trait-use-specification</a></i>

<a name="grammar-trait-name-list"><i>trait-name-list:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>
   <i><a href="#grammar-trait-name-list">trait-name-list</a></i>   ,   <i><a href="#grammar-qualified-name">qualified-name</a></i>

<a name="grammar-trait-use-specification"><i>trait-use-specification:</i>
   ;
   {   <i><a href="#grammar-trait-select-and-alias-clauses">trait-select-and-alias-clauses</a></i><sub>opt</sub>   }

<a name="grammar-trait-select-and-alias-clauses"><i>trait-select-and-alias-clauses:</i>
   <i><a href="#grammar-trait-select-and-alias-clause">trait-select-and-alias-clause</a></i>
   <i><a href="#grammar-trait-select-and-alias-clauses">trait-select-and-alias-clauses</a></i>   <i><a href="#grammar-trait-select-and-alias-clause">trait-select-and-alias-clause</a></i>

<a name="grammar-trait-select-and-alias-clause"><i>trait-select-and-alias-clause:</i>
   <i><a href="#grammar-trait-select-insteadof-clause">trait-select-insteadof-clause</a></i>   ;
   <i><a href="#grammar-trait-alias-as-clause">trait-alias-as-clause</a></i>   ;

<a name="grammar-trait-select-insteadof-clause"><i>trait-select-insteadof-clause:</i>
   <i><a href="#grammar-name">name</a></i>   insteadof   <i><a href="#grammar-name">name</a></i>

<a name="grammar-trait-alias-as-clause"><i>trait-alias-as-clause:</i>
   <i><a href="#grammar-name">name</a></i>   as   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i><sub>opt</sub>   <i><a href="#grammar-name">name</a></i>
   <i><a href="#grammar-name">name</a></i>   as   <i><a href="#grammar-visibility-modifier">visibility-modifier</a></i>   <i><a href="#grammar-name">name</a></i><sub>opt</sub>
</pre>

###Namespaces

<pre>
<a name="grammar-namespace-definition"><i>namespace-definition:</i>
   namespace   <i><a href="#grammar-name">name</a></i>   ;
   namespace   <i><a href="#grammar-name">name</a></i><sub>opt</sub>   <i><a href="#grammar-compound-statement">compound-statement</a></i>

<a name="grammar-namespace-use-declaration"><i>namespace-use-declaration:</i>
   use   <i><a href="#grammar-namespace-function-or-const">namespace-function-or-const</a></i><sub>opt</sub>   <i><a href="#grammar-namespace-use-clauses">namespace-use-clauses</a></i>   ;
   use   <i><a href="#grammar-namespace-function-or-const">namespace-function-or-const</a></i>   \<sub>opt</sub>   <i><a href="#grammar-namespace-name">namespace-name</a></i>   \   {   <i><a href="#grammar-namespace-use-group-clauses-1">namespace-use-group-clauses-1</a></i>   }   ;
   use   \<sub>opt</sub>   namespace-name   \   {   <i><a href="#grammar-namespace-use-group-clauses-2">namespace-use-group-clauses-2</a></i>   }   ;

<a name="grammar-namespace-use-clauses"><i>namespace-use-clauses:</i>
   <i><a href="#grammar-namespace-use-clause">namespace-use-clause</a></i>
   <i><a href="#grammar-namespace-use-clauses">namespace-use-clauses</a></i>   ,   <i><a href="#grammar-namespace-use-clause">namespace-use-clause</a></i>

<a name="grammar-namespace-use-clause"><i>namespace-use-clause:</i>
   <i><a href="#grammar-qualified-name">qualified-name</a></i>   <i><a href="#grammar-namespace-aliasing-clause">namespace-aliasing-clause</a></i><sub>opt</sub>

<a name="grammar-namespace-aliasing-clause"><i>namespace-aliasing-clause:</i>
   as   <i><a href="#grammar-name">name</a></i>

<a name="grammar-namespace-function-or-const"><i>namespace-function-or-const:</i>
   function
   const

<a name="grammar-namespace-use-group-clauses-1"><i>namespace-use-group-clauses-1:</i>
   <i><a href="#grammar-namespace-use-group-clause-1">namespace-use-group-clause-1</a></i>
   <i><a href="#grammar-namespace-use-group-clauses-1">namespace-use-group-clauses-1</a></i>   ,   <i><a href="#grammar-namespace-use-group-clause-1">namespace-use-group-clause-1</a></i>

<a name="grammar-namespace-use-group-clause-1"><i>namespace-use-group-clause-1:</i>
   <i><a href="#grammar-namespace-name">namespace-name</a></i>   <i><a href="#grammar-namespace-aliasing-clause">namespace-aliasing-clause</a></i><sub>opt</sub>

<a name="grammar-namespace-use-group-clauses-2"><i>namespace-use-group-clauses-2:</i>
   <i><a href="#grammar-namespace-use-group-clause-2">namespace-use-group-clause-2</a></i>
   <i><a href="#grammar-namespace-use-group-clauses-2">namespace-use-group-clauses-2</a></i>   ,   <i><a href="#grammar-namespace-use-group-clause-2">namespace-use-group-clause-2</a></i>

<a name="grammar-namespace-use-group-clause-2"><i>namespace-use-group-clause-2:</i>
   <i><a href="#grammar-namespace-function-or-const">namespace-function-or-const</a></i><sub>opt</sub>   <i><a href="#grammar-namespace-name">namespace-name</a></i>   <i><a href="#grammar-namespace-aliasing-clause">namespace-aliasing-clause</a></i><sub>opt</sub>
</pre>
