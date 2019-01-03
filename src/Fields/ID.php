<?php

namespace MustafaKhaled\AtomicPanel\Fields;


class ID Extends AtomicField
{

    /**
     * hide field from creation
     * @var bool
     */
    public $showOnCreation = false;
    /**
     * hide field from update form
     * @var bool
     */
    public $showOnUpdate = false;


    /**
     * change default display
     * @return \Closure|mixed
     */
    public function defaultDisplay()
    {
        return function ($model) {
            $html = '<a href="' . route('AtomicPanel.AtomicModelView', [$model->AtomicBaseName(), $model->id]) . '">' . $model->id . '</a>';
            return $html;
        };
    }
}