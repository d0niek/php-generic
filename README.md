# Prepare for future with php-generic

According to this [article](https://www.sitepoint.com/creating-strictly-typed-arrays-collections-php/)
which shows how to create strictly typed arrays and collections in Php7, php-generic generator was born.

---

There is some [discusion](https://wiki.php.net/rfc/generic-arrays) about generic in Php
but who knows when it comes to us.

It is not exacly what you know from Java or C++ where generic looks like
`Vector<int>()`, `Array<bool>()` or `Vector<\Namespace\Entity\User>()`.

Here generics looks like `VectorInt`, `ArrayBool` and `VectorUser`
so I hope when they come to nativ Php all what you need to do will be:
1. Replace all `VectorType`, `ArrayType` to `Vector<Type>`, `array<Type>`,
2. Delete directory where you store all generated array/vector,
3. Enjoy a nice day.

## What generics are (not)

They are not collections like Doctrine or Laravel Collections. They are like normal php array
which can store values one type. `array<int>` can store only numeric values which will converted to `int`
so you can not push `'some string value'` to it.

## Install

```bash
$ composer require d0niek/php-generic
```

## Generate generic `array<Type>`

There is a bin command that you should find in **vendor/bin**
or somewhere else according to your **composer.json** settings.

To generate a generic array run:

```bash
$ bin/generic generate:array [-s|--save [SAVE]] [--] <type> <namespace>
```
where:
* **-s**|**--saveCollection** - do you want to save generated array for future regenerate (default **true**),
* **type** - is a type of generic array. It can be simple type (bool, int, float, string, array)
or complex type (\\YourApp\\Module\\Repository\\User),
* **namespace** - is a namespace where new generic array will be save.
Remember that namespace's directory have to exists.
To separate namespace parts use **\\\\** or **/** to speed up typing
if your namespace is 1:1 with your directory structure

For example you have project in **/path/to/project** and your **composer.json** contains this kind of entry:
```json
"autoload": {
    "psr-4": {
        "VendorName\\AppName\\": "src/"
    }
}
```
Now, when you call command like this:
```bash
$ bin/generic generate:array int VendorName\\AppName\\Collections
```
new generic array `ArrayInt` will be save to **/path/to/project/src/Collections/** directory.
If this directory does not exists, exceptions will be throw.
> Tip! Store all php-generics in one diretory and add it to **.gitignore**.
When php will start support generics, replace `ArrayInt` to `array<int>` and remove php-generic directory.

## Generate generic `Vector<Type>`

You can alse generate generic [\\Ds\\Vector](http://php.net/manual/en/class.ds-vector.php)
(it is new data structure since Php7,
    [here](https://medium.com/@rtheunissen/efficient-data-structures-for-php-7-9dda7af674cd)
    you can and you should read about it!). To do this just run:
```bash
$ bin/generic generate:vector [-s|--save [SAVE]] [--] <type> <namespace>
```
parameters means exacly the same whats means when you run `generate:array`.

## Regenerate

By defaule generated array/vector are save in **generated-colletions.json** file in your root app path.
Keep this file in repository and ignore all generated php-generics. When you clone repository,
after `composer install` run:
```bash
$ bin/generic collections:regenerate
```
and all your collections will be regenerate.

## Select data from DB

Now you can create in easy way specific generic when you are selecting data from DB
```php
class UserRepository implements UserRepositoryInterface
{
    ...

    /**
     * @inheritDoc
     */
    public function findAll(): VectorUser
    {
        $users = new VectorUser();
        $mysqli = new \mysqli('localhost:3306', 'user', 'password', 'db');

        $mysqliResult = $mysqli->query('SELECT id, name FROM users LIMIT 10');
        if ($mysqliResult !== false) {
            while (($user = $mysqliResult->fetch_object(User::class)) !== null) {
                $users->push($user);
            }
        }

        $mysqli->close();

        return $users;
    }

    ...
}
```

## Test

Before you run tests remember to regenerate collections. Run:
```bash
$ bin/generic collections:regenerate
```
and now you can run
```bash
$ phpunit
```
