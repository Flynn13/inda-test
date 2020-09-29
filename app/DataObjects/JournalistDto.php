<?php


namespace App\DataObjects;


use App\Models\Journalist;

class JournalistDto {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $alias;

    /**
     * @var string
     */
    public $group_name;

    public function __construct(Journalist $journalist) {
        $this->id           = $journalist->getId();
        $this->name         = $journalist->getName();
        $this->alias        = $journalist->getAlias();
        $this->group_name   = $journalist->getGroupName();
    }
}