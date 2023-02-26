# versioning-package-template
## Configuration
In `Installer.php` configure desired values
```php
class Installer
{
    protected string $namespace = "OrganizationName";
    protected string $name = "PackageName";
    protected string $description = "My package description";
    protected string $authorName = "John Doe";
    protected string $authorEmail = "john.doe@test.com";
    protected string $repositoryUrl = "git@github.com:organization/package.git";

    // ...
}
```

## Installation

```shell
./composer install && ./test && ./composer dump-autoload && ./test
```

## Available commands

```shell
./composer [your_command_goes_here]
```

```shell
./php [your_command_goes_here]
```

```shell
./test [your_command_goes_here]
```