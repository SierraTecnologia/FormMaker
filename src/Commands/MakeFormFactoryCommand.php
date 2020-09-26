<?php

namespace SierraTecnologia\FormMaker\Commands;

use Illuminate\Console\Command;

class MakeFormFactoryCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'make:form-factory {form}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a factory based on a form';
}
