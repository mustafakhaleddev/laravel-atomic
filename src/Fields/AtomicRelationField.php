<?php

namespace MustafaKhaled\AtomicPanel\Fields;

use Illuminate\Support\Str;


abstract class AtomicRelationField extends AtomicField
{
    /**
     * define that`s the field is relations kind
     * @var bool
     */
    public $relationField = true;

}