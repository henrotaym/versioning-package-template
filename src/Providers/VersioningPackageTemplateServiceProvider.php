<?php
namespace Henrotaym\VersioningPackageTemplate\Providers;

use Henrotaym\VersioningPackageTemplate\VersioningPackageTemplate;
use Henrotaym\LaravelPackageVersioning\Providers\Abstracts\VersionablePackageServiceProvider;

class VersioningPackageTemplateServiceProvider extends VersionablePackageServiceProvider
{
    public static function getPackageClass(): string
    {
        return VersioningPackageTemplate::class;
    }

    protected function addToRegister(): void
    {
        //
    }

    protected function addToBoot(): void
    {
        //
    }
}