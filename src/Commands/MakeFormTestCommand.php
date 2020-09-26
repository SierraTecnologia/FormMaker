<?php

namespace SierraTecnologia\FormMaker\Commands;

use Illuminate\Console\Command;

class MakeFormTestCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:form-test {form}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a factory based on a form';
}
