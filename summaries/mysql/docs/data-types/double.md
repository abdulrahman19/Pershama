# DOUBLE

Min | Max | Length | Unit | Note
---|---|---|---|---|
-1.7976931348623157E+ 308 | -2.2250738585072014E- 308 | 8 |  Bytes | Signed
0, 2.2250738585072014E- 308 | 1.7976931348623157E+ 308 | 8 |  Bytes | Unsigned

It's like a [FLOAT](./float.md) data type, but `DOUBLE` can work with larger numbers and it can represent 15 digits before convert the value to scientific notation and 16 before approximate the value.

A precision from 24 to 53 ([Mantissa / Significand precision](https://en.wikipedia.org/wiki/Significand)) results in an 8-byte double-precision `DOUBLE` column. The 53-bit Significand precision gives from 15 to 17 significant decimal digits precision.

<pre>
S  EEEEEEEEEEE FFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFFF
63 62       52 51                                                 0

S = Sign = 1 bit
E = Exponent = 11 bits
F = Fraction = 53 bits (52 explicitly stored)
</pre>
