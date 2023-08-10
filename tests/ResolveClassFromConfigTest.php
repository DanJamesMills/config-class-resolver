<?php

namespace DanJamesMills\ConfigClassResolver\Tests;

use DanJamesMills\ConfigClassResolver\Tests\Models\Company;
use InvalidArgumentException;
use ClassNotFoundException;
use Config;

class ResolveClassFromConfigTest extends TestCase
{
    /**
     * @test
     */
    public function class_is_resolved_correctly_from_valid_configuration()
    {
        $modelClass = resolve_class_from_config('config-class-resolver', 'company');

        $this->assertInstanceOf(Company::class, $modelClass);
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_configuration_file_does_not_exist()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Configuration file 'non-existent-config' not found.");

        resolve_class_from_config('non-existent-config', 'company');
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_main_configuration_key_does_not_exist()
    {
        Config::set('config-class-resolver', []);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Configuration key 'associations.company' not found in 'config-class-resolver.php'.");

        resolve_class_from_config('config-class-resolver', 'company');
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_specific_configuration_key_does_not_exist()
    {
        Config::set('config-class-resolver.associations', []);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Configuration key 'associations.non-existent-key' not found in 'config-class-resolver.php'.");

        resolve_class_from_config('config-class-resolver', 'non-existent-key');
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_class_configuration_key_does_not_exist()
    {
        Config::set('config-class-resolver.associations.company', []);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Configuration key 'associations.company.class' not found in 'config-class-resolver.php'.");

        resolve_class_from_config('config-class-resolver', 'company');
    }

    /**
     * @test
     */
    public function it_throws_an_exception_if_specified_class_does_not_exist_in_codebase()
    {
        Config::set('config-class-resolver.associations.company.class', 'NonExistentClass');

        $this->expectException(ClassNotFoundException::class);
        $this->expectExceptionMessage("Class 'NonExistentClass' not found.");

        resolve_class_from_config('config-class-resolver', 'company');
    }
}
