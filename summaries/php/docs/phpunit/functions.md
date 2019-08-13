# PHPUnit Functions Cheat Sheet

> Please hover over the function name to see the arguments or special cases for the same function, don't click : )

> This cheat sheet for 7.4 version.

* [String](#string)
* [Array primitive](#array-primitive)
* [Array class attribute](#array-class-attribute)
* [Variable primitive](#variable-primitive)
* [Variable class attribute](#variable-class-attribute)
* [Class structure](#class-structure)
* [File](#file)
* [Xml](#xml)

### String
* [assertRegExp](# "string $pattern, string $string[, string $message = '']")
* [assertNotRegExp](# "string $pattern, string $string[, string $message = '']")
* [assertStringMatchesFormat](# "string $format, string $string[, string $message = '']")
* [assertStringNotMatchesFormat](# "string $format, string $string[, string $message = '']")
* [assertStringEndsWith](# "string $suffix, string $string[, string $message = '']")
* [assertStringEndsNotWith](# "string $suffix, string $string[, string $message = '']")
* [assertStringStartsWith](# "string $prefix, string $string[, string $message = '']")
* [assertStringStartsNotWith](# "string $prefix, string $string[, string $message = '']")
* [assertStringMatchesFormatFile](# "string $formatFile, string $string[, string $message = '']")
* [assertStringNotMatchesFormatFile](# "string $formatFile, string $string[, string $message = '']")
* [assertStringEqualsFile](# "string $expectedFile, string $actualString[, string $message = '']")
* [assertStringNotEqualsFile](# "string $expectedFile, string $actualString[, string $message = '']")

### Array primitive
* [assertArrayHasKey](# "mixed $key, array $array[, string $message = '']")
* [assertArrayNotHasKey](# "mixed $key, array $array[, string $message = '']")
* [assertArraySubset](# "array $subset, array $array[, bool $strict = false, string $message = '']")
* [assertContains](# "mixed $needle, Iterator|array $haystack[, string $message = '']")
    * [assertContains](# "string $needle, string $haystack[, string $message = '', boolean $ignoreCase = false]")
* [assertNotContains](# "mixed $needle, Iterator|array $haystack[, string $message = '']")
    * [assertNotContains](# "string $needle, string $haystack[, string $message = '', boolean $ignoreCase = false]")
* [assertContainsOnly](# "string $type, Iterator|array $haystack[, boolean $isNativeType = null, string $message = '']")
* [assertNotContainsOnly](# "string $type, Iterator|array $haystack[, boolean $isNativeType = null, string $message = '']")
* [assertContainsOnlyInstancesOf](# "string $classname, Traversable|array $haystack[, string $message = '']")
* [assertCount](# "$expectedCount, $haystack[, string $message = '']")

### Array class attribute
* [assertAttributeContains](# "mixed $needle, Iterator|array $haystack[, string $message = '']")
* [assertAttributeNotContains](# "mixed $needle, Iterator|array $haystack[, string $message = '']")
* [assertAttributeContainsOnly](# "string $type, Iterator|array $haystack[, boolean $isNativeType = null, string $message = '']")
* [assertAttributeNotContainsOnly](# "string $type, Iterator|array $haystack[, boolean $isNativeType = null, string $message = '']")

### Variable primitive
* [assertEmpty](# "mixed $actual[, string $message = '']")
* [assertNotEmpty](# "mixed $actual[, string $message = '']")
* [assertNull](# "mixed $variable[, string $message = '']")
* [assertNotNull](# "mixed $variable[, string $message = '']")
* [assertEquals](# "mixed $expected, mixed $actual[, string $message = '']")
    * [assertEquals](# "float $expected, float $actual[, string $message = '', float $delta = 0]")
    * [assertEquals](# "DOMDocument $expected, DOMDocument $actual[, string $message = '']")
    * [assertEquals](# "object $expected, object $actual[, string $message = '']")
    * [assertEquals](# "array $expected, array $actual[, string $message = '']")
* [assertNotEquals](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertSame](# "mixed $expected, mixed $actual[, string $message = '']")
    * [assertSame](# "object $expected, object $actual[, string $message = '']")
* [assertNotSame](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertInternalType](# "$expected, $actual[, $message = '']")
* [assertNotInternalType](# "$expected, $actual[, $message = '']")
* [assertTrue](# "bool $condition[, string $message = '']")
* [assertNotTrue](# "bool $condition[, string $message = '']")
* [assertFalse](# "bool $condition[, string $message = '']")
* [assertNotFalse](# "bool $condition[, string $message = '']")
* [assertGreaterThan](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertGreaterThanOrEqual](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertLessThan](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertLessThanOrEqual](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertInfinite](# "mixed $variable[, string $message = '']")
* [assertFinite](# "mixed $variable[, string $message = '']")
* [assertNan](# "mixed $variable[, string $message = '']")
* [assertInstanceOf](# "$expected, $actual[, $message = '']")
* [assertNotInstanceOf](# "$expected, $actual[, $message = '']")
* [assertThat](# "mixed $value, PHPUnit\Framework\Constraint $constraint[, $message = '']")
    * [attribute](# "PHPUnit\Framework\Constraint $constraint, $attributeName")
    * logicalAnd
    * [logicalNot](# "PHPUnit\Framework\Constraint $constraint")
    * logicalOr
    * logicalXor
    * [arrayHasKey](# "mixed $key")
    * [contains](# "mixed $value")
    * [containsOnly](# "string $type")
    * [containsOnlyInstancesOf](# "string $classname")
    * [equalTo](# "$value, $delta = 0, $maxDepth = 10")
    * [attributeEqualTo](# "$attributeName, $value, $delta = 0, $maxDepth = 10")
    * [identicalTo](# "mixed $value")
    * [greaterThan](# "mixed $value")
    * [greaterThanOrEqual](# "mixed $value")
    * [lessThan](# "mixed $value")
    * [lessThanOrEqual](# "mixed $value")
    * directoryExists
    * fileExists
    * [classHasAttribute](# "string $attributeName")
    * [classHasStaticAttribute](# "string $attributeName")
    * [objectHasAttribute](# "string $attributeName")
    * [matchesRegularExpression](# "string $pattern")
    * [stringContains](# "string $string, bool $case")
    * [stringEndsWith](# "string $suffix")
    * [stringStartsWith](# "string $prefix")
    * [isInstanceOf](# "string $className")
    * [isType](# "string $type")
    * isTrue
    * isFalse
    * isReadable
    * isWritable
    * isNull
    * anything



### Variable class attribute
* [assertAttributeEmpty](# "mixed $actual[, string $message = '']")
* [assertAttributeNotEmpty](# "mixed $actual[, string $message = '']")
* [assertAttributeEquals](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertAttributeNotEquals](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertAttributeSame](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertAttributeNotSame](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertAttributeInternalType](# "$expected, $actual[, $message = '']")
* [assertAttributeNotInternalType](# "$expected, $actual[, $message = '']")
* [assertAttributeInstanceOf](# "$expected, $actual[, $message = '']")
* [assertAttributeNotInstanceOf](# "$expected, $actual[, $message = '']")
* [assertAttributeGreaterThan](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertAttributeGreaterThanOrEqual](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertAttributeLessThan](# "mixed $expected, mixed $actual[, string $message = '']")
* [assertAttributeLessThanOrEqual](# "mixed $expected, mixed $actual[, string $message = '']")

### Class structure
* [assertClassHasAttribute](# "string $attributeName, string $className[, string $message = '']")
* [assertClassNotHasAttribute](# "string $attributeName, string $className[, string $message = '']")
* [assertClassHasStaticAttribute](# "string $attributeName, string $className[, string $message = '']")
* [assertClassNotHasStaticAttribute](# "string $attributeName, string $className[, string $message = '']")
* [assertObjectHasAttribute](# "string $attributeName, object $object[, string $message = '']")
* [assertObjectNotHasAttribute](# "string $attributeName, object $object[, string $message = '']")

### File
* [assertDirectoryExists](# "string $directory[, string $message = '']")
* [assertDirectoryNotExists](# "string $directory[, string $message = '']")
* [assertDirectoryIsReadable](# "string $directory[, string $message = '']")
* [assertDirectoryNotIsReadable](# "string $directory[, string $message = '']")
* [assertDirectoryIsWritable](# "string $directory[, string $message = '']")
* [assertDirectoryNotIsWritable](# "string $directory[, string $message = '']")
* [assertFileEquals](# "string $expected, string $actual[, string $message = '']")
* [assertFileNotEquals](# "string $expected, string $actual[, string $message = '']")
* [assertFileExists](# "string $filename[, string $message = '']")
* [assertFileNotExists](# "string $filename[, string $message = '']")
* [assertFileIsReadable](# "string $filename[, string $message = '']")
* [assertFileNotIsReadable](# "string $filename[, string $message = '']")
* [assertIsReadable](# "string $filename[, string $message = '']")
* [assertNotIsReadable](# "string $filename[, string $message = '']")
* [assertFileIsWritable](# "string $filename[, string $message = '']")
* [assertFileNotIsWritable](# "string $filename[, string $message = '']")
* [assertIsWritable](# "string $filename[, string $message = '']")
* [assertNotIsWritable](# "string $filename[, string $message = '']")
* [assertJsonFileEqualsJsonFile](# "mixed $expectedFile, mixed $actualFile[, string $message = '']")
* [assertJsonStringEqualsJsonFile](# "mixed $expectedFile, mixed $actualJson[, string $message = '']")
* [assertJsonStringEqualsJsonString](# "mixed $expectedJson, mixed $actualJson[, string $message = '']")

### Xml
* [assertEqualXMLStructure](# "DOMElement $expectedElement, DOMElement $actualElement[, boolean $checkAttributes = false, string $message = '']")
* [assertXmlFileEqualsXmlFile](# "string $expectedFile, string $actualFile[, string $message = '']")
* [assertXmlFileNotEqualsXmlFile](# "string $expectedFile, string $actualFile[, string $message = '']")
* [assertXmlStringEqualsXmlFile](# "string $expectedFile, string $actualXml[, string $message = '']")
* [assertXmlStringNotEqualsXmlFile](# "string $expectedFile, string $actualXml[, string $message = '']")
* [assertXmlStringEqualsXmlString](# "string $expectedXml, string $actualXml[, string $message = '']")
* [assertXmlStringNotEqualsXmlString](# "string $expectedXml, string $actualXml[, string $message = '']")
