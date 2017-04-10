# Prepere for future with GenericCollection

According to this [article](https://www.sitepoint.com/creating-strictly-typed-arrays-collections-php/) which shows how to create strictly typed arrays and collections in PHP, GenericCollection generator was born.

---

It is not exaly what you know from Java or C++ where generic looks like `Vector<int>()`, `Array<bool>()` or `Vector<\Namespace\Entity\User>()`.

Here generics looks like `VectorInt`, `ArrayBool` and `VectorUser` so I hope when they come to nativ Php all what you need to do will be:
1. Replace all `VectorType`, `ArrayType` to `Vector<Type>`, `Array<Type>`,
2. Delete directory where you store all generated collections,
3. Enjoy a nice day.

## Generate collection

There is bin command that you should find it in **vendor/bin** or somewhere else according to your **composer.json** settings.

To generate generic array run:

```bash
$ bin/gCollection generate:array <type> <namespace>
```
where:
* **type** - is a type of generic collection. It can be simple type (bool, int, float, string, array) or complex type (\\YourApp\\Module\\Repository\\User),
* **namespace** - is a namespace where new generic collection will be save. Remember that namespace's directory have to exists.

For example you have project in **/path/to/project** and your **composer.json** contains this kind od entry:
```json
"autoload": {
    "psr-4": {
        "VendorName\\AppName\\": "src/"
    }
}
```
Now, when you call command like this:
```bash
$ bin/gCollection generate:array int VendorName\\AppName\\Collections
```
new generic array `ArrayInt` will be save to **/path/to/project/src/Collections/** directory. If this directory does not exists, exceptions will be throw.
> Tip! Store all collections in one place. When php will start suport generic collections, replace `ArrayInt` to `array<int>` and remove collections directory.

You can alse generate generic [\\Ds\\Vector](http://php.net/manual/en/class.ds-vector.php) (it is new data structure since Php7, [here](https://medium.com/@rtheunissen/efficient-data-structures-for-php-7-9dda7af674cd) you can and you should read about it!). To do this just run:
```bash
$ bin/gCollection generate:vector <type> <namespace>
```
`type` and `namespace` means exacly the same whats means when you run `generate:array`.

## Select data from DB

Now you create in easy way specific generic collection when you are selecting data from DB
```php
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
```
