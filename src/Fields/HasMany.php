<?php

namespace MustafaKhaled\AtomicPanel\Fields;


class HasMany Extends AtomicRelationField implements ListingField
{
    /**
     * field view
     * @var string
     */
    public $FieldView = 'atomic::fields.hasMany';

    /**
     * the relation model class
     * @var string
     */
    public $relationModel;

    /**
     * relation function name
     * @var string
     */
    public $relationType = 'HasMany';


    /**
     * HasMany constructor.
     * @param string $name
     * @param null|string $attribute
     * @param null $relationName
     * @param null $model
     */
    public function __construct(string $name, ?string $attribute = null, $relationName = null, $model = null)
    {
        parent::__construct($name);
        $this->relationName = $attribute;
        $this->relationModel = $relationName;
    }


}