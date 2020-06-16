<?php

use SierraTecnologia\FormMaker\Fields\Url;
use SierraTecnologia\FormMaker\Fields\Date;
use SierraTecnologia\FormMaker\Fields\File;
use SierraTecnologia\FormMaker\Fields\Text;
use SierraTecnologia\FormMaker\Fields\Time;
use SierraTecnologia\FormMaker\Fields\Week;
use SierraTecnologia\FormMaker\Fields\Color;
use SierraTecnologia\FormMaker\Fields\Email;
use SierraTecnologia\FormMaker\Fields\Field;
use SierraTecnologia\FormMaker\Fields\Image;
use SierraTecnologia\FormMaker\Fields\Month;
use SierraTecnologia\FormMaker\Fields\Radio;
use SierraTecnologia\FormMaker\Fields\Range;
use SierraTecnologia\FormMaker\Fields\HasOne;
use SierraTecnologia\FormMaker\Fields\Hidden;
use SierraTecnologia\FormMaker\Fields\Number;
use SierraTecnologia\FormMaker\Fields\Select;
use SierraTecnologia\FormMaker\Fields\Decimal;
use SierraTecnologia\FormMaker\Fields\HasMany;
use SierraTecnologia\FormMaker\Fields\Checkbox;
use SierraTecnologia\FormMaker\Fields\Password;
use SierraTecnologia\FormMaker\Fields\TextArea;
use SierraTecnologia\FormMaker\Fields\Telephone;
use SierraTecnologia\FormMaker\Fields\Typeahead;
use SierraTecnologia\FormMaker\Fields\CustomFile;
use SierraTecnologia\FormMaker\Fields\RadioInline;
use SierraTecnologia\FormMaker\Fields\DatetimeLocal;
use SierraTecnologia\FormMaker\Fields\CheckboxInline;

class FieldTest extends TestCase
{
    public function testText()
    {
        $field = Text::make('address', [
            'placeholder' => 'address'
        ]);

        $this->assertEquals('address', array_key_first($field));
        $this->assertEquals('address', $field['address']['attributes']['placeholder']);
    }

    public function testEmail()
    {
        $field = Email::make('address', [
            'placeholder' => 'address'
        ]);

        $this->assertEquals('address', array_key_first($field));
        $this->assertEquals('address', $field['address']['attributes']['placeholder']);
    }

    public function testCheckbox()
    {
        $field = Checkbox::make('wants_emails', [
            'placeholder' => 'wants_emails'
        ]);

        $this->assertEquals('wants_emails', array_key_first($field));
        $this->assertEquals('wants_emails', $field['wants_emails']['attributes']['placeholder']);
    }

    public function testCheckboxInline()
    {
        $field = CheckboxInline::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('form-check-input', $field['field']['attributes']['class']);
    }

    public function testColor()
    {
        $field = Color::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('color', $field['field']['type']);
    }

    public function testCustomFile()
    {
        $field = CustomFile::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('custom-file', $field['field']['type']);
    }

    public function testDate()
    {
        $field = Date::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('date', $field['field']['type']);
        $this->assertEquals('Y-m-d', $field['field']['format']);
    }

    public function testDatetimeLocal()
    {
        $field = DatetimeLocal::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('datetime-local', $field['field']['type']);
        $this->assertEquals('Y-m-d\TH:i', $field['field']['format']);
    }

    public function testDecimal()
    {
        $field = Decimal::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('number', $field['field']['type']);
    }

    public function testField()
    {
        $field = Field::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('text', $field['field']['type']);
    }

    public function testFile()
    {
        $field = File::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('file', $field['field']['type']);
    }

    public function testHasMany()
    {
        $field = HasMany::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('relationship', $field['field']['type']);
    }

    public function testHasOne()
    {
        $field = HasOne::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('relationship', $field['field']['type']);
    }

    public function testHidden()
    {
        $field = Hidden::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('hidden', $field['field']['type']);
    }

    public function testImage()
    {
        $field = Image::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('image', $field['field']['type']);
    }

    public function testMonth()
    {
        $field = Month::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('month', $field['field']['type']);
    }

    public function testNumber()
    {
        $field = Number::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('number', $field['field']['type']);
    }

    public function testPassword()
    {
        $field = Password::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('password', $field['field']['type']);
    }

    public function testRadio()
    {
        $field = Radio::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('radio', $field['field']['type']);
    }

    public function testRadioInline()
    {
        $field = RadioInline::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('radio', $field['field']['type']);
        $this->assertEquals('form-check-input', $field['field']['attributes']['class']);
    }

    public function testRange()
    {
        $field = Range::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('range', $field['field']['type']);
    }

    public function testSelect()
    {
        $field = Select::make('field', [
            'options' => [
                'joe' => 'joe',
                'john' => 'john',
                'katie' => 'katie',
            ]
        ]);

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('select', $field['field']['type']);
        $this->assertEquals('joe', $field['field']['options']['joe']);
    }

    public function testTelephone()
    {
        $field = Telephone::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('tel', $field['field']['type']);
    }

    public function testTextarea()
    {
        $field = TextArea::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('textarea', $field['field']['type']);
    }

    public function testTime()
    {
        $field = Time::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('time', $field['field']['type']);
    }

    public function testUrl()
    {
        $field = Url::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('url', $field['field']['type']);
    }

    public function testWeek()
    {
        $field = Week::make('field');

        $this->assertEquals('field', array_key_first($field));
        $this->assertEquals('week', $field['field']['type']);
    }

    public function testTypeahead()
    {
        $field = Typeahead::make('names', [
            'matches' => json_encode(["Alfred", "Jarvis"])
        ]);

        $this->assertEquals('names', array_key_first($field));
        $this->assertEquals(json_encode(["Alfred", "Jarvis"]), $field['names']['attributes']['matches']);
        $this->assertStringContainsString('typeahead__container', $field['names']['template']);
    }
}