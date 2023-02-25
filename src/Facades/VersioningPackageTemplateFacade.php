<?php
namespace Henrotaym\VersioningPackageTemplate\Facades;

use Henrotaym\VersioningPackageTemplate\VersioningPackageTemplate;
use Henrotaym\LaravelPackageVersioning\Facades\Abstracts\VersionablePackageFacade;

class VersioningPackageTemplateFacade extends VersionablePackageFacade
{
    public static function getPackageClass(): string
    {
        return VersioningPackageTemplate::class;
    }
}