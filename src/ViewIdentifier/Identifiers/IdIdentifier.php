<?php

namespace Grafii\ViewIdentifier\Identifiers;

/**
 * Class IdIdentifier
 * @package Grafii\ViewIdentifier\Identifiers
 */
class IdIdentifier
{
    /**
     * @var string
     */
    private $id;

    /**
     * @param string  $id
     * @param boolean $reset
     *
     * @return void
     */
    public function set($id, bool $reset = false): void
    {
        if (!isset($this->id) || $reset) {
            $item = new \Grafii\ViewIdentifier\Identifier((string) $id, 'id');

            $this->id = $item->get();
        }
    }

    /**
     * @return string
     */
    public function get(): string
    {
        return (string) $this->id;
    }
}
