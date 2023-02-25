<?php
namespace Henrotaym\VersioningPackageTemplate\Tests\Unit;

use Henrotaym\VersioningPackageTemplate\Tests\TestCase;
use Henrotaym\LaravelPackageVersioning\Testing\Traits\InstallPackageTest;
use Henrotaym\VersioningPackageTemplate\Facades\VersioningPackageTemplateFacade;

class InstallingPackageTest extends TestCase
{
    use InstallPackageTest;

    public function test_it_can_instanciate_facade()
    {
        $this->assertInstanceOf(
            VersioningPackageTemplateFacade::class,
            $this->app->make(VersioningPackageTemplateFacade::class)
        );
    }
}