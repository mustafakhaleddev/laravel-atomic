<?php

namespace MustafaKhaled\AtomicPanel\Fields;


use Carbon\Carbon;

class Date Extends AtomicField
{
    /**
     * field view
     * @var string
     */
    public $FieldView = 'atomic::fields.date';


    /**
     * handle request value for date
     * @param $value
     * @return mixed
     */
    public function HandleRequestValue($value)
    {
        $newDate = Carbon::createFromTimestamp(strtotime($value));
        return $newDate;
    }

}