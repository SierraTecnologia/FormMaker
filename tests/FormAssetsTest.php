<?php

use SierraTecnologia\FormMaker\Fields\Tags;
use SierraTecnologia\FormMaker\Fields\Quill;
use SierraTecnologia\FormMaker\Forms\BaseForm;
use SierraTecnologia\FormMaker\Services\FormAssets;

class UserHistoryForm extends BaseForm
{
    public $route = 'user.history';

    public $buttons = [
        'submit' => 'Save'
    ];

    public function fields()
    {
        return [
            Quill::make('history'),
            Tags::make('qualities'),
        ];
    }
}

class FormAssetsTest extends TestCase
{
    protected $formAssets;

    public function setUp(): void
    {
        parent::setUp();

        $this->formAssets = app(FormAssets::class);

        $this->session([
            'token' => 'tester',
        ]);

        Route::post('user/history')->name('user.history');

        $this->form = app(UserHistoryForm::class);
    }

    public function testMake()
    {
        $form = $this->form->make();

        $this->assertStringContainsString('http://localhost/user/history', $form);
        $this->assertStringContainsString('method="POST"', $form);

        $this->assertStringContainsString('History', $form);
    }

    public function testAssetCounts()
    {
        $this->form->make();

        $this->assertEquals(3, count($this->formAssets->stylesheets));
        $this->assertEquals(2, count($this->formAssets->scripts));
        $this->assertEquals(2, count($this->formAssets->styles));
        $this->assertEquals(2, count($this->formAssets->js));
    }

    public function testAssetContents()
    {
        $this->form->make();

        $assets = $this->formAssets->render();

        $this->assertStringContainsString('script', $assets);
        $this->assertStringContainsString('link', $assets);
        $this->assertStringContainsString('Quill', $assets);
        $this->assertStringContainsString('--tags-border-color', $assets);
        $this->assertStringContainsString('Tagify', $assets);
    }
}
