# PHPUnit Interview Cheat Sheet

* [Command-Line](#command-line)
* [Fixtures](#fixtures)
* [Organizing Tests](#organizing-tests)
* [Risky Tests](#risky-tests)
* [Incomplete and Skipped Tests](#incomplete-and-skipped-tests)
* [Database Testing](#database-testing)
* [Test Doubles](#test-doubles)

## Command-Line
For each test run, the PHPUnit command-line tool prints one character to indicate progress:

Character | Meaning
---|---|
`.` | Printed when the test **succeeds**.
`F` | Printed when an assertion **fails** while running the test method.
`E` | Printed when an **error** occurs while running the test method.
`R` | Printed when the test has been marked as **risky**.
`S` | Printed when the test has been **skipped**.
`I` | Printed when the test is marked as being **incomplete** or not yet implemented.

**TestDox Option:**

PHPUnit’s TestDox functionality looks at a test class and all the test method names and converts them from `camel case` (or `snake_case`) PHP names to sentences:

<pre>
$ phpunit --testdox BankAccountTest
PHPUnit |version|.0 by Sebastian Bergmann and contributors.

BankAccount
 ✔ Balance is initially zero
 ✔ Balance cannot become negative
</pre>

## Fixtures
**What is a Fixture?**

A fixture describes the initial state your application and database are in when you execute a test.

Before Test | After Test
---|---|
`setUpBeforeClass()` | `assertPostConditions()`
`setUp()` | `tearDown()`
`assertPreConditions()` | `onNotSuccessfulTest()`
\- | `tearDownAfterClass()`

`setUpBeforeClass()` & `tearDownAfterClass()` methods are shared fixtures.

## Organizing Tests
Composing a Test Suite Using XML Configuration
```xml
<phpunit bootstrap="src/autoload.php">
  <testsuites>
    <testsuite name="money">
      <directory>tests</directory>
    </testsuite>
  </testsuites>
</phpunit>
```
for files
```xml
<phpunit bootstrap="src/autoload.php">
  <testsuites>
    <testsuite name="money">
      <file>tests/IntlFormatterTest.php</file>
      <file>tests/MoneyTest.php</file>
      <file>tests/CurrencyTest.php</file>
    </testsuite>
  </testsuites>
</phpunit>
```

## Risky Tests
The reasons for mark test as a risky test:

Reason | Explain
---|---|
Useless Tests | PHPUnit is by default strict about tests that do not test anything. (no assertion inside them), you can disabled by using the `--dont-report-useless-tests` option or `beStrictAboutTestsThatDoNotTestAnything="false"` in XML configuration file.
Unintentionally Covered Code | When you enable `--strict-coverage` option or `beStrictAboutCoversAnnotation="true"` in XML configuration file.
Output During Test Execution | When you enable `--disallow-test-output` option or `beStrictAboutOutputDuringTests="true"` in XML configuration file.
Test Execution Timeout | When you enable `--enforce-time-limit` option or `enforceTimeLimit="true"` in XML configuration file.
Global State Manipulation | When you enable `--strict-global-state` option or `beStrictAboutChangesToGlobalState="true"` in XML configuration file.

A test annotated with `@large` will fail if it takes longer than `60 seconds` to execute. This timeout is configurable via the `timeoutForLargeTests` attribute in the XML configuration file.

A test annotated with `@medium` will fail if it takes longer than `10 seconds` to execute. This timeout is configurable via the `timeoutForMediumTests` attribute in the XML configuration file.

A test annotated with `@small` will fail if it takes longer than `1 second` to execute. This timeout is configurable via the `timeoutForSmallTests` attribute in the XML configuration file.

## Incomplete and Skipped Tests
To mark test as `incomplete test` use `markTestIncomplete([$message])` method.

To skip test and mark it as `skipped Test` use `markTestSkipped([$message])` method, also by using `@requires` annotation if the conditions not happened.

```php
/**
 * @requires PHP 5.3
 */
public function testConnection()
{
    // Test requires the mysqli extension and PHP >= 5.3
}
```

## Database Testing
The four stages of a database test:
* Set up fixture
* Exercise System Under Test
* Verify outcome
* Teardown

## Test Doubles
**Stubs**

You can use a stub to “replace a real component on which the SUT depends so that the test has a control point for the indirect inputs of the SUT. This allows the test to force the SUT down paths it might not otherwise execute”.

```php
<?php
class SomeClass
{
    public function doSomething()
    {
        // Do something.
    }
}
```

```php
<?php
use PHPUnit\Framework\TestCase;

class StubTest extends TestCase
{
    public function testStub()
    {
        // Create a stub for the SomeClass class.
        $stub = $this->createMock(SomeClass::class);

        // Configure the stub.
        $stub->method('doSomething')
             ->willReturn('foo');

        // Calling $stub->doSomething() will now return
        // 'foo'.
        $this->assertSame('foo', $stub->doSomething());
    }
}
```

If defaults used in `createMock($type)` are not what you need then you can use the `getMockBuilder($type)` method to customize the test double generation using a fluent interface.

Those methods can used with `createMock($type)`:
* `will($this->returnValue($value))` = `willReturn($value)`
* `will($this->returnArgument(0))`
* `will($this->returnSelf())`
* `will($this->returnValueMap($array_map))`
* `will($this->returnCallback('method_name'))`
* `will($this->onConsecutiveCalls(2, 3, 5, 7))`
* `will($this->throwException(new Exception))`

You can build stubs using `getMockBuilder` like following:
```php
$this->createMock(SomeClass::class);

// is equal to

$stub = $this->getMockBuilder(SomeClass::class)
             ->disableOriginalConstructor()
             ->disableOriginalClone()
             ->disableArgumentCloning()
             ->disallowMockingUnknownTypes()
             ->getMock();
```
**Mock Objects**

The practice of replacing an object with a test double that verifies expectations, for instance asserting that a method has been called, is referred to as `mocking`.

```php
<?php
use PHPUnit\Framework\TestCase;

class SubjectTest extends TestCase
{
    public function testObserversAreUpdated()
    {
        // Create a mock for the Observer class,
        // only mock the update() method.
        $observer = $this->getMockBuilder(Observer::class)
                         ->setMethods(['update'])
                         ->getMock();

        // Set up the expectation for the update() method
        // to be called only once and with the string 'something'
        // as its parameter.
        $observer->expects($this->once())
                 ->method('update')
                 ->with($this->equalTo('something'));

        // Create a Subject object and attach the mocked
        // Observer object to it.
        $subject = new Subject('My subject');
        $subject->attach($observer);

        // Call the doSomething() method on the $subject object
        // which we expect to call the mocked Observer object's
        // update() method with the string 'something'.
        $subject->doSomething();
    }
}
```
Those methods can used with `expects(arguments)`:
* `any()`
* `never()`
* `atLeastOnce()`
* `once()`
* `exactly(int $count)`
* `at(int $index)`

Those methods can used with `with(arguments)`:
* `$this->equalTo('something')`
* `$this->greaterThan(0)`
* `$this->stringContains('something')`
* `$this->callback(function(arguments){//code here})`
* `$this->identicalTo(type)`
* `$this->anything()`

The `withConsecutive()` method can take any number of arrays of arguments.
```php
<?php
use PHPUnit\Framework\TestCase;

class FooTest extends TestCase
{
    public function testFunctionCalledTwoTimesWithSpecificArguments()
    {
        $mock = $this->getMockBuilder(stdClass::class)
                     ->setMethods(['set'])
                     ->getMock();

        $mock->expects($this->exactly(2))
             ->method('set')
             ->withConsecutive(
                 [$this->equalTo('foo'), $this->greaterThan(0)],
                 [$this->equalTo('bar'), $this->greaterThan(0)]
             );

        $mock->set('foo', 21);
        $mock->set('bar', 48);
    }
}
```

Here is a list of methods provided by the `Mock Builder`:
* `setMethods(array $methods)`
* `setMethodsExcept(array $methods)`
* `setConstructorArgs(array $args)`
* `setMockClassName($name)`
* `disableOriginalConstructor()`
* `disableOriginalClone()`
* `disableArgumentCloning()`
* `disallowMockingUnknownTypes()`
* `disableAutoload()`

> Please note that `final`, `private`, and `static` methods cannot be stubbed or mocked. They are ignored by PHPUnit’s test double functionality and retain their original behavior except for `static` methods that will be replaced by a method throwing a `\PHPUnit\Framework\MockObject\BadMethodCallException` exception.

**Prophecy**

You can use phpSpec Prophecy inside phpUnit :heart_eyes:
```php
<?php
use PHPUnit\Framework\TestCase;

class SubjectTest extends TestCase
{
    public function testObserversAreUpdated()
    {
        $subject = new Subject('My subject');

        // Create a prophecy for the Observer class.
        $observer = $this->prophesize(Observer::class);

        // Set up the expectation for the update() method
        // to be called only once and with the string 'something'
        // as its parameter.
        $observer->update('something')->shouldBeCalled();

        // Reveal the prophecy and attach the mock object
        // to the Subject.
        $subject->attach($observer->reveal());

        // Call the doSomething() method on the $subject object
        // which we expect to call the mocked Observer object's
        // update() method with the string 'something'.
        $subject->doSomething();
    }
}
```
Please check the project repo for more information [link](https://github.com/phpspec/prophecy)

**Mocking Traits and Abstract Classes**

The `getMockForTrait()` method returns a mock object that uses a specified trait. All abstract methods of the given trait are mocked. This allows for testing the concrete methods of a trait.

The `getMockForAbstractClass()` method returns a mock object for an abstract class. All abstract methods of the given abstract class are mocked. This allows for testing the concrete methods of an abstract class.
