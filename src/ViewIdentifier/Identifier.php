<?php

namespace Hypnotract\ViewIdentifier;

use Illuminate\Support\Str;

/**
 * Class Identifier
 * @package Hypnotract\ViewIdentifier
 */
class Identifier
{
    /**
     * @var array
     */
    private $validStyles = [
        'kebab',
        'snake',
        'camel',
        'studly',
    ];

    /**
     * @var string
     */
    private $title;

    /**
     * Initialize the Item.
     *
     * @param string $title
     * @param string $configName
     */
    public function __construct(string $title, string $configName)
    {
        if ($title === '') {
            return;
        }

        $config = config("identifiers.$configName");

        if (isset($config['style']) && in_array($config['style'], $this->validStyles)) {
            $style = $config['style'];
        } else {
            $style = $this->defaultStyle();
        }

        $this->title = Str::{$style}(Str::studly($title));
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return (string) $this->title;
    }

    /**
     * @return string
     */
    private function defaultStyle(): string
    {
        return $this->validStyles[0];
    }
}
