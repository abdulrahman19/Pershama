# SOLID Principle Cheat Sheet

* [Single Responsibility](#single-responsibility)
* [Open-Close Principle](#open-close-principle)
* [Liskov Substitution](#liskov-substitution)
* [Interface Segregation](#interface-segregation)
* [Dependency Inversion](#dependency-inversion)

## Single Responsibility
A Class should be responsible for a single task.

```php
// Single Responsibility Principle Violation
class Report
{
    public function getTitle()
    {
        return 'Report Title';
    }

    public function getDate()
    {
        return '2016-04-21';
    }

    public function getContents()
    {
        return [
            'title' => $this->getTitle(),
            'date' => $this->getDate(),
        ];
    }

    public function formatJson()
    {
        return json_encode($this->getContents());
    }
}
```
Refactoring
```php
class Report
{
    public function getTitle()
    {
        return 'Report Title';
    }

    public function getDate()
    {
        return '2016-04-21';
    }

    public function getContents()
    {
        return [
            'title' => $this->getTitle(),
            'date' => $this->getDate(),
        ];
    }
}

interface ReportFormattable
{
    public function format(Report $report);
}

class JsonReportFormatter implements ReportFormattable
{
    public function format(Report $report)
    {
        return json_encode($report->getContents());
    }
}
```

## Open-Close Principle
A Class should be open to extension and close to modification.

```php
// Open Closed Principle Violation
class Programmer
{
    public function code()
    {
        return 'coding';
    }
}

class Tester
{
    public function test()
    {
        return 'testing';
    }
}

class ProjectManagement
{
    public function process($member)
    {
        if ($member instanceof Programmer) {
            $member->code();
        } elseif ($member instanceof Tester) {
            $member->test();
        };
        throw new Exception('Invalid input member');
    }
}
```
Refactoring
```php
interface Workable
{
    public function work();
}

class Programmer implements Workable
{
    public function work()
    {
        return 'coding';
    }
}

class Tester implements Workable
{
    public function work()
    {
        return 'testing';
    }
}

class ProjectManagement
{
    public function process(Workable $member)
    {
        return $member->work();
    }
}
```

## Liskov Substitution
A derived Class can be substituted at places where base Class is used.

```php
// Liskov Substitution Violation
interface UserReopsitory()
{
    public function getUserData();
}

class NormalUserReopsitory implements UserReopsitory
{
    // returns a collection
    public function getUserData($userID)
    {
        return DB::table('users')->where('user_id', '=', $userID);
    }
}

class ThirdPartyUserReopsitory implements UserReopsitory
{
    // returns array
    public function getUserData($userID)
    {
        return FileSystem::getUserInformation($userID);
    }
}
```
Doc blocks can very helpful to make sure that LSP is not violated and made easy to understand what is the type of value returned from function or force returns type if you use  `> PHP 7.0`
```php
interface UserReopsitory()
{
    /**
     * This function should returns collection of users.
     *
     * @return \Collection
    */
    public function getUserData() : \Collection;
}
```


## Interface Segregation
Don’t make FAT Interfaces. i.e. Classes don’t have to override extra agreements that are not needed for that Class simply because it is there in interface.

```php
// Interface Segregation Principle Violation
interface Workable
{
    public function canCode();
    public function code();
    public function test();
}

class Programmer implements Workable
{
    public function canCode()
    {
        return true;
    }
    public function code()
    {
        return 'coding';
    }
    public function test()
    {
        return 'testing in localhost';
    }
}

class Tester implements Workable
{
    public function canCode()
    {
        return false;
    }
    public function code()
    {
         throw new Exception('Opps! I can not code');
    }
    public function test()
    {
        return 'testing in test server';
    }
}

class ProjectManagement
{
    public function processCode(Workable $member)
    {
        if ($member->canCode()) {
            $member->code();
        }
    }
}
```
Refactoring
```php
interface Codeable
{
    public function code();
}

interface Testable
{
    public function test();
}

class Programmer implements Codeable, Testable
{
    public function code()
    {
        return 'coding';
    }
    public function test()
    {
        return 'testing in localhost';
    }
}

class Tester implements Testable
{
    public function test()
    {
        return 'testing in test server';
    }
}

class ProjectManagement
{
    public function processCode(Codeable $member)
    {
        $member->code();
    }
}
```

## Dependency Inversion
Depend on abstractions, not on concretions. Not only high level Classes but low level Classes also depend on the abstractions in order to decouple the code.

```php
// Dependency Inversion Principle Violation
class Mailer
{
}

class SendWelcomeMessage
{
    private $mailer;
    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
}
```
Refactoring
```php
interface Mailer
{
    public function send();
}

class SmtpMailer implements Mailer
{
    public function send()
    {
    }
}

class SendGridMailer implements Mailer
{
    public function send()
    {
    }
}

class SendWelcomeMessage
{
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }
}
```
