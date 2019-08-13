# Laravel PHPUnit Functions Cheat Sheet

> Please hover over the function name to see the arguments or special cases for the same function, don't click : )

> If you define your own `setUp` method within a test class, be sure to call `parent::setUp()`.

* [HTTP Tests](#http-tests)
* [Database Testing](#database-testing)
* [Mocking](#mocking)

## HTTP Tests
Laravel contains a variety of assertions for inspecting the response headers, content, JSON structure, and more.
```php
// get
$response = $this->get('/');

// post
$response = $this->post('/', ['name' => 'Sally'], ['X-Header' => 'Value']);

// put
$response = $this->put('/', ['name' => 'Sally'], ['X-Header' => 'Value']);

// delete
$response = $this->delete('/', ['name' => 'Sally'], ['X-Header' => 'Value']);

// withHeaders
$response = $this->withHeaders([
                'X-Header' => 'Value',
            ])->json('POST', '/user', ['name' => 'Sally']);

$response = $this->postJson('/user', ['name' => 'Sally'], ['X-Header' => 'Value']);

// session
$response = $this->withSession(['foo' => 'bar'])
                ->get('/');

// authentication
$response = $this->actingAs($user)
                ->withSession(['foo' => 'bar'])
                ->get('/');

$this->actingAs($user, 'api');

// JSON
$response = $this->json('POST', '/user', ['name' => 'Sally']);
$response = $this->postJson('/user', ['name' => 'Sally']);
```

**Cookies & Sessions**

* [assertCookie](# "$cookieName, $value = null")
* [assertCookieExpired](# "$cookieName")
* [assertCookieNotExpired](# "$cookieName")
* [assertCookieMissing](# "$cookieName")
* [assertPlainCookie](# "$cookieName, $value = null")
* [assertSessionHas](# "$key, $value = null")
* [assertSessionHasAll](# "array $data")
* [assertSessionHasErrors](# "array $keys, $format = null, $errorBag = 'default'")
* [assertSessionHasErrorsIn](# "$errorBag, $keys = [], $format = null")
* [assertSessionHasNoErrors](# "")
* [assertSessionMissing](# "$key")

**Response Strings**

* [assertSee](# "$value")
* [assertDontSee](# "$value")
* [assertSeeText](# "$value")
* [assertDontSeeText](# "$value")
* [assertSeeInOrder](# "array $values")
* [assertSeeTextInOrder](# "array $values")

**Headers & Codes**

* assertForbidden
* assertNotFound
* assertOk
* assertSuccessful
* [assertStatus](# "$code")
* [assertHeader](# "$headerName, $value = null")
* [assertHeaderMissing](# "$headerName")
* [assertLocation](# "$uri")
* [assertRedirect](# "$uri")

**JSON**

* [assertJson](# "array $data")
* [assertExactJson](# "array $data")
* [assertJsonCount](# "$count, $key = null")
* [assertJsonFragment](# "array $data")
* [assertJsonMissing](# "array $data")
* [assertJsonMissingExact](# "array $data")
* [assertJsonStructure](# "array $structure")
* [assertJsonValidationErrors](# "$keys")

**Views**

* [assertViewHas](# "$key, $value = null")
* [assertViewHasAll](# "array $data")
* [assertViewIs](# "$value")
* [assertViewMissing](# "$key")

**Authentication**

* [assertAuthenticated](# "$guard = null")
* [assertGuest](# "$guard = null")
* [assertAuthenticatedAs](# "$user, $guard = null")
* [assertCredentials](# "array $credentials, $guard = null")
* [assertInvalidCredentials](# "array $credentials, $guard = null")

## Database Testing
* [assertDatabaseHas](# "$table, array $data")
* [assertDatabaseMissing](# "$table, array $data")
* [assertSoftDeleted](# "$table, array $data")

## Mocking


**Bus Fake**
* fake
* [assertDispatched](# "$command, $callback = null")
* [assertNotDispatched](# "$command")

**Event Fake**
* [fake](# "$eventsToFake = []")
* [fakeFor](# "callable $callable, array $eventsToFake = []")
* [assertDispatched](# "$command, $callback = null")
* [assertNotDispatched](# "$command")

**Mail Fake**
* fake
* [assertSent](# "$command, $callback = null")
* [assertQueued](# "$command, $callback = null")
* [assertNotSent](# "$command")
* [assertNotQueued](# "$command")

**Notification Fake**
* fake
* [assertSentTo](# "$notifiable, $notification, $callback = null")
* [assertNotSentTo](# "$notifiable, $notification, $callback = null")

**Queue Fake**
* fake
* [assertPushed](# "$job, $callback = null")
* [assertPushedOn](# "$queue, $job, $callback = null")
* [assertNotPushed](# "$job, $callback = null")
* [assertPushedWithChain](# "$job, $expectedChain = [], $callback = null")

**Storage Fake**
* [fake](# "$disk = null")
* [assertExists](# "$path")
* [assertMissing](# "$path")

**Facades**
* [shouldReceive](# "$command")
