# Limit Your Instance Variables

Usually <code>Users</code> class or <code>UsersController</code> class be the main class you throw in it everything you don't know where else to put them. <br>
After months or years It'll be a **hell** place to access it.

Look at this small example
```php
class UsersController
{
    # for service user class by other helpers.
    protected $userService; 
    # for register stuff for every user.
    protected $registrationService;
    # for access to database.
    protected $userRepository;
    # for build things to user when sign-up like billing or something.
    protected $stripe;
    # for sending mails.
    protected $mailer;
    # for run events for users.
    protected $userEventRepository;
    # for log data.
    protected $logger;

    function __construct(
        UserService $userService,
        RegistrationService $registrationService,
        UserRepository $userRepository,
        Stripe $stripe,
        Mailer $mailer,
        UserEventRepository $userEventRepository,
        Logger $logger,
    )
    {
        # code...
    }
}
```
So messy!

So you need this rule **Limit Your Instance Variables**, and the acceptable number for this limitation is **5** instances at maximum. <br>
Instance variables like <code>$logger</code> or <code>$mailer</code> or any other variable carry object inside it.

At first look you can figure out that class responsible about many things doesn't belong to it, like <code>$logger</code> or <code>$mailer</code> for example, so we need to apply very important principle here, It's **Single responsibility**, every class must responsible about one job one task.

Now let's break this up. <br>
```php
class UsersController
{
    protected $userService;
    protected $registrationService;
    protected $stripe;
    protected $mailer;
    protected $logger;

    function __construct(
        UserService $userService,
        RegistrationService $registrationService,
        Stripe $stripe,
        Mailer $mailer,
        Logger $logger,
    )
    {
        # code...
    }
}

class UserService
{
    protected $userRepository;
    protected $userEventRepository;

    function __construct(UserRepository $userRepository, UserEventRepository $userEventRepository)
    {
        # code...
    }
}
```
We have <code>UserService</code> already so let's make it responsible about <code>UserRepository</code> and <code>UserEventRepository</code> stuff also. <br>
You can break this also, but for now that's fine.

Next you can move <code>RegistrationService</code> and <code>Stripe</code> classes to other logical class like <code>AuthController</code> for example.
```php
class UsersController
{
    protected $userService;
    protected $mailer;
    protected $logger;

    function __construct(
        UserService $userService,
        Mailer $mailer,
        Logger $logger,
    )
    {
        # code...
    }
}

class AuthController
{
    protected $registrationService;
    protected $stripe;

    function __construct(RegistrationService $registrationService, Stripe $stripe)
    {
        # code...
    }
}
```
Now you can mange those things for every user form <code>AuthController</code>.

Now <code>mailer</code> and <code>logger</code> looks like events stuff, when user do this log it or when user do that email him. <br>
So let's clear it up.
```php
class UsersController
{
    protected $userService;

    function __construct(UserService $userService)
    {
        # code...
    }
}

class UserEventRepository
{
    protected $mailer;
    protected $logger;

    function __construct(Mailer $mailer,Logger $logger)
    {
        # code...
    }
}
```
Now you end up with this.
```php
class UsersController
{
    protected $userService;

    function __construct(UserService $userService)
    {
        # code...
    }
}
```
So clean...Right!!
