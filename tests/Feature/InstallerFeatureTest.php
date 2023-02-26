<?php
namespace Henrotaym\VersioningPackageTemplate\Tests\Feature;

use Henrotaym\VersioningPackageTemplate\Installer;
use Henrotaym\VersioningPackageTemplate\Tests\TestCase;

class InstallerFeatureTestCopy extends TestCase
{
    public function test_it_can_scaffold_package()
    {
        $this->app->make(Installer::class)->scaffold();
    }
}