<?php
namespace Henrotaym\VersioningPackageTemplate;

use ReflectionClass;
use Illuminate\Support\Str;
use Illuminate\Support\Composer;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\SplFileInfo;
use Henrotaym\VersioningPackageTemplate\Tests\Feature\InstallerFeatureTest;
use Henrotaym\VersioningPackageTemplate\Facades\VersioningPackageTemplateFacade;
use Henrotaym\VersioningPackageTemplate\Contracts\VersioningPackageTemplateContract;
use Henrotaym\VersioningPackageTemplate\Providers\VersioningPackageTemplateServiceProvider;

class Installer
{
    public function __construct(protected Composer $composer)
    {}

    protected string $namespace = "Testastos";
    protected string $name = "MyAwesomePackage";
    protected string $description = "awesome";
    protected string $authorName = "test test";
    protected string $authorEmail = "test@test.com";
    protected string $repositoryUrl = "testastos.com";

    public function scaffold()
    {
        $this->recursivelyScaffold($this->getStubsPath())
            ->removeScaffoldingClasses()
            ->dumpAutoload();
    }

    protected function dumpAutoload(): self
    {
        $this->composer->dumpAutoloads();
        $this->composer->dumpOptimized();

        return $this;
    }

    protected function recursivelyScaffold(string $path): self
    {
        foreach(File::directories($path) as $directoryPath):
            $this->recursivelyScaffold($directoryPath);
        endforeach;

        foreach(File::files($path) as $filePath):
            $this->createFileFromStub($filePath);
        endforeach;

        return $this;
    }

    public function removeScaffoldingClasses(): self
    {
        $this->getScaffoldingClasses()->each(fn (string $className) => $this->removeScaffoldingClass($className));

        return $this;
    }

    protected function removeScaffoldingClass(string $className): void
    {
        File::delete((new ReflectionClass($className))->getFileName());
    }

    protected function createFileFromStub(SplFileInfo $file): void
    {
        File::put(
            $this->getCorrectPath($file->getRealPath()),
            $this->getCorrectContent($file->getContents())
        );
    }

    protected function getCorrectContent(string $content): string
    {
        return $this->replaceVariables($content);
    }

    protected function getCorrectPath(string $path): string
    {
        return Str::replace(["/stubs", ".stub"], "", $this->replaceVariables($path));
    }

    protected function replaceVariables(string $value): string
    {
        return $this->getVariableAssociations()
            ->reduce(
                fn (string $replaced, string $value, string $variableName) => 
                    Str::replace("{{$variableName}}", $value, $replaced)
                ,
                $value
            );
    }

    protected function getVariableAssociations(): Collection
    {
        return collect([
            "namespace" => $this->namespace,
            "name" => $this->name,
            "description" => $this->description,
            "kebabNamespace" => Str::kebab($this->namespace),
            "kebabName" => Str::kebab($this->name),
            "snakeName" => Str::snake($this->name),
            "repositoryUrl" => $this->repositoryUrl,
            "authorName" => $this->authorName,
            "authorEmail" => $this->authorEmail,
        ]);
    }

    protected function getStubsPath(): string
    {
        return __DIR__ . "/../stubs";
    }

    protected function getScaffoldingClasses(): Collection
    {
        return collect([
            VersioningPackageTemplate::class,
            VersioningPackageTemplateContract::class,
            VersioningPackageTemplateFacade::class,
            VersioningPackageTemplateServiceProvider::class,
            InstallerFeatureTest::class,
            self::class
        ]);
    }
}