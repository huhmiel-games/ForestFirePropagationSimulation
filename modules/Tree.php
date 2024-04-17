<?php
require_once (dirname(__FILE__) . "/State.php");

class Tree
{
    public $pos_x = 0;
    public $pos_y = 0;
    public $state = State::IS_SAFE;

    public function __construct($pos_x, $pos_y)
    {
        $this->pos_x = $pos_x;
        $this->pos_y = $pos_y;
    }

    public function set_is_burning(): void
    {
        $this->state = State::IS_BURNING;
    }

    public function set_has_burn(): void
    {
        $this->state = State::HAS_BURN;
    }

    public function display(): string
    {
        switch ($this->state)
        {
            case State::IS_SAFE:
                return '<div class="tree green"></div>';

            case State::HAS_BURN:
                return '<div class="tree dark"></div>';

            case State::IS_BURNING:
                return '<div class="tree red"></div>';

            default:
                return '';
        }
    }
}
