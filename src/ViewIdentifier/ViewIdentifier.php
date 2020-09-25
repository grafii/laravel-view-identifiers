<?php

namespace Hypnotract\ViewIdentifier;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use Hypnotract\ViewIdentifier\Identifiers;

/**
 * Class ViewIdentifier
 * @package Hypnotract\ViewIdentifier
 */
class ViewIdentifier
{
    /**
     * @var Identifiers\IdIdentifier
     */
    protected $id;

    /**
     * @var Identifiers\ClassIdentifier
     */
    protected $class;

    /**
     * Initialize the ViewIdentifier manager.
     */
    public function __construct()
    {
        $this->id = new Identifiers\IdIdentifier();
        $this->class = new Identifiers\ClassIdentifier();

        $this->autoDiscover();
    }

    /**
     * @return Identifiers\IdIdentifier
     */
    public function id(): Identifiers\IdIdentifier
    {
        return $this->id;
    }

    /**
     * @return Identifiers\ClassIdentifier
     */
    public function class(): Identifiers\ClassIdentifier
    {
        return $this->class;
    }

    /**
     * @return void
     */
    private function autoDiscover(): void
    {
        if (config('identifiers.auto_discovery')) {
            $keywords = $this->getKeywords();

            $this->class->pushMany($keywords);

            $this->id->set(implode('', $keywords));
        }
    }

    /**
     * @return array
     */
    private function getKeywords(): array
    {
        $keywords = $this->getControllerParts();
        $keywords[] = $this->getActionName();

        $keywords = array_map([Str::class, 'studly'], $keywords);

        return array_values(array_unique(array_filter($keywords)));
    }

    /**
     * @return array
     */
    private function getControllerParts(): array
    {
        $parts = explode('\\', (string) $this->getControllerName());

        foreach ($parts as &$part) {
            $part = str_replace('Controller', '', $part);
        }

        return $parts;
    }

    /**
     * @return string
     */
    private function getActionName(): string
    {
        $method = explode('@', Route::currentRouteAction());

        return $method[1] ?? '';
    }

    /**
     * @return string
     */
    private function getControllerName(): string
    {
        $method = explode('@', Route::currentRouteAction());

        if (isset($method[0])) {
            $namespace = config('identifiers.controllers');

            $controllerName = str_replace($namespace . '\\', '', $method[0]);
        }

        return $controllerName ?? '';
    }
}
