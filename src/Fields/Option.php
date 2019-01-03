<?php

namespace MustafaKhaled\AtomicPanel\Fields;


class Option Extends AtomicField
{
    /**
     * default field view folders
     * @var string
     */
    public $FieldView = 'atomic::fields.option';

    /**
     * default field options array
     * @var array
     */
    public $options = [];


    /**
     * define field options
     * @param array $options
     * @return $this
     */
    public function options(array $options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * change default display for the field
     * @return \Closure|mixed
     */
    public function defaultDisplay()
    {
        $options = $this->options;
        $attribute = $this->attribute;
        return function ($model) use ($options, $attribute) {
            $value = $model->$attribute;
            if (isset($options[$model->$attribute])) {
                $value = $options[$model->$attribute];
            }
            $html = $value;
            return $html;
        };
    }

}