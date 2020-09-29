<?php


namespace App\Models;

class Journalist {

    private $id;

    private $name;

    private $alias;

    private $group_name;

    /**
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAlias() {
        return $this->alias;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias) {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getGroupName() {
        return $this->group_name;
    }

    /**
     * @param sting $group_name
     */
    public function setGroupName($group_name) {
        $this->group_name = $group_name;
    }
}