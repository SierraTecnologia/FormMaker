<?php

namespace SierraTecnologia\FormMaker\Html;

use Exception;
use Illuminate\Support\Str;

class HtmlSnippet
{
    /**
     * @param array|null $options
     */
    public static function content(?array $options = [])
    {
        return null;
    }

    /**
     * @return (mixed|string)[][]
     *
     * @psalm-return array<string, array{type: string, content: mixed}>
     */
    public static function make($content = null): array
    {
        if (is_array($content) || is_null($content)) {
            $content = static::content($content);
        }

        throw_if(is_null($content), new Exception('Content cannot be null'));

        $name = 'html-snippet-'.Str::uuid();

        return [
            $name => [
                'type' => 'html',
                'content' => $content,
            ]
        ];
    }
}
