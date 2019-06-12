<?php

namespace App\Library;

abstract class BaseUser
{
    /**
     * User ID
     *
     * @var int
     */
    public $id;

    /**
     * User name
     *
     * @var string
     */
    public $name;

    /**
     * Get user id
     *
     * @return int
     */
    public function geId() : int {
        return $this->id;
    }

    /**
     * Set user ID
     *
     * @param int $id
     * @return void
     */
    public function setId(int $id) : void {
        $this->id = $id;
    }

    /**
     * Get user name
     *
     * @return string
     */
    public function getName() : string {
        return $this->name;
    }

    /**
     * Set user name
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name) : void {
        $this->name = $name;
    }
}