# Laravel Config Class Resolver

A simple Laravel package for resolving classes based on configuration.

## Installation

Install the package via Composer:

composer require danjamesmills/config-class-resolver

## Usage

To resolve a class from the configuration, call the `resolve_class_from_config` function with the appropriate parameters:

resolve_class_from_config('your-package-name', 'class');

In the example above, 'your-package-name' represents the main configuration key, and 'class' represents the specific key within that configuration.

If the configuration exists and the class is found, the function will return the resolved class instance. If the class is not found, it will throw a ClassNotFoundException.

## Example

Ensure that your configuration file ('config/calls.php') contains the necessary entries for the classes you want to resolve. Here's an example configuration file:

```php
return [
    /*
     * Here you can specify which relationship(s) the call model has.
     */
    'associations' => [

        'contact' => [
            'field_key' => 'contact_ids',
            'class' => \DanJamesMills\CRM\Models\Contact::class,
            'relationship_name' => 'contacts',
        ],

        'company' => [
            'field_key' => 'company_ids',
            'class' => \DanJamesMills\CRM\Models\Company::class,
            'relationship_name' => 'companies',
        ],
    ]
]
```

In this example, 'your-package-name' represents the main configuration key. Make sure to replace '\App\Models\YourModel::class' with the appropriate class you want to resolve.

## License

This package is open-source software licensed under the MIT license.
