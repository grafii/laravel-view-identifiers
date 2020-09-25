<?php

namespace Grafii\ViewIdentifier\Identifiers;

use Illuminate\Support\Collection;

/**
 * Class ClassIdentifier
 * @package Grafii\ViewIdentifier\Identifiers
 */
class ClassIdentifier
{
    /**
     * @var Collection
     */
    protected $classes;

    /**
     * Initialize the ClassIdentifier.
     */
    public function __construct()
    {
        $this->classes = new Collection();
    }

    /**
     * @param string $class
     *
     * @return void
     */
    public function push($class): void
    {
        $item = new \Grafii\ViewIdentifier\Identifier((string) $class, 'class');

        $this->classes->push($item->get());
    }

    /**
     * @param array $classes
     *
     * @return void
     */
    public function pushMany(array $classes): void
    {
        foreach ($classes as $class) {
            $this->push($class);
        }
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return trim(implode(' ', ($this->classes->all())));
    }
}
