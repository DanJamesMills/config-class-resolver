<?php

namespace DanJamesMills\ConfigClassResolver\Tests;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
        $this->setupConfig();
    }
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.key', 'base64:6Cu/ozj4gPtIjmXjr8EdVnGFNsdRqZfHfVjQkmTlg4Y=');
    }

    protected function setupConfig()
    {
        $this->app['config']->set('config-class-resolver', [
            'associations' => [
                'company' => [
                    'field_key' => 'company_ids',
                    'class' => \DanJamesMills\ConfigClassResolver\Tests\Models\Company::class,
                    'relationship_name' => 'companies',
                ]
            ],
        ]);
    }

}