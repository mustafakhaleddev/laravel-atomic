<?php

namespace MustafaKhaled\AtomicPanel\Fields;


class Checkbox Extends AtomicField
{
    /**
     * default field view folders
     * @var string
     */
    public $FieldView = 'atomic::fields.checkbox';


    /**
     * default true value
     * @var string
     */
    public $trueValue = 'true';

    /**
     * default false value
     * @var string
     */
    public $falseValue = 'false';

    /**
     * set true value display
     * @param $value
     * @return $this
     */
    public function trueValue($value)
    {
        $this->trueValue = $value;
        return $this;
    }


    /**
     * set false value display
     * @param $value
     * @return $this
     */
    public function falseValue($value)
    {
        $this->falseValue = $value;
        return $this;
    }

    /**
     * change default display for the field
     * @return \Closure|mixed
     */
    public function defaultDisplay()
    {
        $attribute = $this->attribute;
        $field = $this;
        return function ($model) use ($attribute, $field) {
            $value = $model->$attribute;
            if ($value) {
                $html = $field->trueValue;
            } else {
                $html = $field->falseValue;
            }
            return $html;
        };
    }

}