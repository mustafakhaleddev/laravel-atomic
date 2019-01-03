<?php

namespace MustafaKhaled\AtomicPanel\Fields;


class Number Extends AtomicField
{
    /**
     * field view
     * @var string
     */
    public $FieldView = 'atomic::fields.number';


    /**
     * field min numbers
     * @param $min
     * @return Number
     */
    public function min($min)
    {
        $this->withMeta(['min' => $min]);
        return $this;
    }


    /**
     * field max numbers
     * @param $max
     * @return Number
     */
    public function max($max)
    {
        $this->withMeta(['max' => $max]);
        return $this;
    }
}