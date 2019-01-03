<?php

namespace MustafaKhaled\AtomicPanel\Fields;


class Password Extends AtomicField
{
    /**
     * field view
     * @var string
     */
    public $FieldView = 'atomic::fields.password';

    /**
     * hide field from details
     * @var bool
     */
    public $showOnDetail = false;

    /**
     * hide field from index
     * @var bool
     */
    public $showOnIndex = false;

    /**
     * handle request value
     * @param $value
     * @return mixed
     */
    public function HandleRequestValue($value)
    {
        return bcrypt($value);
    }
}