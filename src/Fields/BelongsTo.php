<?php

namespace MustafaKhaled\AtomicPanel\Fields;


class BelongsTo Extends AtomicRelationField
{
    /**
     * field view
     * @var string
     */
    public $FieldView = 'atomic::fields.BelongsTo';

    /**
     * field default relation display key
     * @var string
     */
    public $displayKey = 'id';

    /**
     * field default foreign key for relation
     * @var string
     */
    public $foreignKey = 'id';


    /**
     * field nullable attribute
     * @var bool
     */
    public $nullable = false;

    /**
     * set display key
     * @param $key
     * @return $this
     */
    public function displayKey($key)
    {
        $this->displayKey = $key;
        $this->setDefaultDisplay();
        return $this;
    }

    /**
     * set nullable for field
     * @return $this
     */
    public function nullable()
    {
        $this->nullable = true;
        return $this;
    }

    /**
     * set foreign key
     * @param $key
     * @return $this
     */
    public function foreignKey($key)
    {
        $this->foreignKey = $key;
        return $this;
    }


    /**
     * get field attribute
     * @return mixed|null|string
     */
    public function getAttribute()
    {

        return strtolower($this->relationName) . '.' . $this->displayKey;
    }


    /**
     * change default display
     * @return \Closure|mixed
     */
    public function defaultDisplay()
    {
        $relationModel = $this->model;
        $relationName = $this->relationName;
        $attribute = $this->attribute;
        $displayKey = $this->displayKey;

        return function ($model) use ($relationModel, $relationName, $displayKey, $attribute) {
            if ($model->$attribute == null || empty($model->$relationName)) {
                return '__';
            }
            $html = '<a href="' . route('AtomicPanel.AtomicModelView', [$relationModel::AtomicBaseClassName(), $model->$relationName->id]) . '">' . $model->$relationName->$displayKey . '</a>';

            return $html;
        };
    }

}