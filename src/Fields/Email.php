<?php

namespace MustafaKhaled\AtomicPanel\Fields;


class Email Extends AtomicField
{
    /**
     * field view
     * @var string
     */
    public $FieldView = 'atomic::fields.email';

    /**
     * field default rules
     * @var array
     */
    public $fieldRules=['email'];

}