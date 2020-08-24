<?php

class MakeBaseFormCommandTest extends TestCase
{
    protected function setUp(): void: void
    {
        parent::setUp();

        $this->path = __DIR__.'/../vendor/orchestra/testbench-core/laravel/app/Http/Forms/UserInviteForm.php';

        @unlink($this->path);

        $this->artisan('make:base-form', [
            'name' => 'UserInvite'
        ]);
    }

    public function testFileHasBeenGenerated()
    {
        $this->assertTrue(file_exists($this->path));

        $contents = file_get_contents($this->path);

        $this->assertStringContainsString('UserInviteForm', $contents);
    }
}