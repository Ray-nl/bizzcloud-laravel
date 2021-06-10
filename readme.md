# Bizzcloud for Laravel

---
This package makes it easy to communicate with Bizzcloud.
[![Latest Version](https://img.shields.io/github/release/spatie/laravel-medialibrary.svg?style=flat-square)](https://github.com/spatie/laravel-medialibrary/releases)

[![Latest Version](https://img.shields.io/github/release/raynl/bizzcloud-laravel.svg?style=flat-square)](https://github.com/Ray-nl/bizzcloud-laravel/releases/)
[![Total Downloads](https://img.shields.io/packagist/dt/raynl/bizzcloud-laravel.svg?style=flat-square)](https://packagist.org/packages/raynl/bizzcloud-laravel)

# Setup

---
Install the package in your Laravel project using composer:

```
composer require raynl/bizzcloud-laravel
```

### Env
After the package is installed you need to set the following env variables:
#### BIZZ_URL
The server url is the instance’s domain (e.g. https://mycompany.bizzcloud.nl).
#### BIZZ_DB
the database name is the name of the instance (e.g. mycompany)/

#### BIZZ_USERNAME
You can create or use a existing user with enough rights to access the different documents.
#### BIZZ_PASSWORD
Password of the user.

Here's and example:
```
BIZZ_URL="https://example.bizzcloud.nl/xmlrpc/2"
BIZZ_DB="example"
BIZZ_USERNAME="example@example.nl"
BIZZ_PASSWORD="Password
```
### Publish configuration
If you want to edit the configuration file you can publish it.

```composer log
php artisan vendor:publish --provider="Raynl\Bizzcloud\BizzcloudServiceProvider" --tag="config
```

# How it works

---
You create a new instance of Bizzcloud.
```composer log
$bizzcloud = new Bizzcloud();
```
After that you can use different methods.

## Available methods

### List records
Records can be listed and filtered via search().

search() takes a mandatory domain filter (possibly empty), and returns the database identifiers of all records matching the filter. To list customer companies for instance.

If you want with pagination add $offset and $limit.
```composer log
search(string $model, array $search, int $offset = null, int $limit = null): array
```

### Count records
Rather than retrieve a possibly gigantic list of records and count them, searchCount() can be used to retrieve only the number of records matching the query. It takes the same domain filter as search() and no other parameter.

If you want with pagination add $offset and $limit.
```composer log
searchCount(string $model, array $search, int $offset = null, int $limit = null): array
```

### Read records
Record data is accessible via the read() method, which takes a list of ids (as returned by search()) and optionally a list of fields to fetch. By default, it will fetch all the fields the current user can read, which tends to be a huge amount.
```composer log
read(string $model, array $ids, array $parameters_keyword = []): array
```

### Listing record fields
getFields() can be used to inspect a model’s fields and check which ones seem to be of interest.

Because it returns a large amount of meta-information (it is also used by client programs) it should be filtered before printing, the most interesting items for a human user are string (the field’s label), help (a help text if available) and type (to know which values to expect, or to send when updating a record)
```composer log
getFields(string $model, array $attributes = ['string', 'help', 'type']): array
```

### Search and read
Because it is a very common task, BizzCloud provides a searchAndRead() shortcut which as its name suggests is equivalent to a search() followed by a read(), but avoids having to perform two requests and keep ids around.

Its arguments are similar to search()‘s, but it can also take a list of fields (like read(), if that list is not provided it will fetch all fields of matched records)
```composer log
searchAndRead(string $model, array $search, array $parameters_keyword = []): array
```

### Create records
Records of a model are created using create(). The method will create a single record and return its database identifier.

create() takes a mapping of fields to values, used to initialize the record. For any field which has a default value and is not set through the mapping argument, the default value will be used.
```composer log
create(string $model, $values): array
```

### Update records
Records can be updated using update(), it takes a list of records to update and a mapping of updated fields to values similar to create().

Multiple records can be updated simultanously, but they will all get the same values for the fields being set. It is not currently possible to perform “computed” updates (where the value being set depends on an existing value of a record).

- **Date**, **Datetime** and **Binary** fields use string values

```composer log
update(string $model, int $id, array $values): array
```

### Delete records
Records can be deleted in bulk by providing their ids to delete().
```composer log
delete(string $model, array $ids): array
```

## Products
If you have products there is a class only for products.

```composer log
$bizzcloud_products = new Products();
```

There are two methods available.

### Get all products
Get all of the products. It use the model **product.template**.

```
 getAllProducts(array $parameters_keyword = []): array
```

Get specified fields:
```
 getAllProducts(['fields' => ['field1', 'field2']]): array
```

Get offset and limit:
```
 getAllProducts(['offset' => 0, 'limit' => 10]): array
```

Get specified fields, offset and limit
```
 getAllProducts(['offset' => 0, 'limit' => 10, 'fields' => ['field', 'field']]): array
```
### Get a specific product of it's id
Get a specific product of it's id. It use the model **product.template**.

```
getProduct(int $id): array
```



