# Filament Nirapotta

A comprehensive role and permission management package for FilamentPHP admin panel, built on top of Spatie Permission.

## Features

- Role and Permission management resources
- Integration with Spatie Permission package
- Custom navigation icons using Heroicon
- Admin guard configuration
- Easy to use and extend

## Installation

You can install the package via composer:

```bash
composer require hassan-dev41/filament-nirapotta
```

## Development Setup

When developing this package locally, follow these steps:

1. Add the package to your project's composer.json as a path repository:

```json
{
    "repositories": [
        {
            "type": "path",
            "url": "packages/filament-nirapotta"
        }
    ],
    "require": {
        "hassan-dev41/filament-nirapotta": "@dev"
    }
}
```

2. Run composer update to symlink the package:

```bash
composer update hassan-dev41/filament-nirapotta
```

3. Clear composer cache if changes are not reflecting:

```bash
composer clear-cache
```

4. After making changes to the package, you may need to:
   - Clear Laravel configuration cache: `php artisan config:clear`
   - Clear Laravel view cache: `php artisan view:clear`
   - Run `composer dump-autoload`

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on recent changes.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Hassan Dev](https://github.com/hassan-dev41)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.