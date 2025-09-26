# Changelog

All notable changes to `filament-nirapotta` will be documented in this file.

## [v1.0.1] - 2025-09-27

### Fixed
- Fixed Filament v4 compatibility issues
- Resolved navigationGroup and navigationIcon property type errors
- Fixed form method signature to use Schema instead of Form
- Added slug field support for permissions table
- Removed description field dependencies to match standard Spatie permission schema

### Added
- Comprehensive test suite for package functionality
- Permission auto-generation command working successfully
- Role Resource properly integrated with Filament admin panel

### Tested
- Package installation and configuration
- Permission creation command (generates permissions for all Filament resources)
- Role management functionality
- Service provider registration
- Filament resource integration

## [v1.0.0] - 2025-09-27

### Added
- Initial release of filament-nirapotta package
- Role and Permission management resources for FilamentPHP admin panel
- Integration with Spatie Permission package
- Custom navigation icons using Heroicon for better UI
- Admin guard configuration for enhanced security

### Changed
- Renamed package from `zeus-permission` to `filament-nirapotta`
- Updated namespace from `Zeus\Permission` to `HassanDev41\FilamentNirapotta`
- Changed configuration references from `zeus-permission` to `filament-nirapotta`
- Updated navigation icons to use proper type declarations
- Fixed type compatibility with Filament v4 icon system

### Fixed
- Resolved type declaration issues for navigationIcon in PermissionResource and RoleResource
- Fixed icon type compatibility using string|BackedEnum|null type hint
- Corrected navigation icon implementation using Heroicon enum
- Ensured proper autoloading configuration in composer.json