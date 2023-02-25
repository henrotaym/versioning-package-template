<?php
namespace Henrotaym\VersioningPackageTemplate;

use Henrotaym\VersioningPackageTemplate\Contracts\VersioningPackageTemplateContract;
use Henrotaym\LaravelPackageVersioning\Services\Versioning\VersionablePackage;

class VersioningPackageTemplate extends VersionablePackage implements VersioningPackageTemplateContract
{
    public static function prefix(): string
    {
        return "versioning_package_template";
    }
}