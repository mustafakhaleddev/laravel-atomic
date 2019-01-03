<?php

namespace MustafaKhaled\AtomicPanel\Fields;

use Illuminate\Support\Str;


abstract class AtomicField extends AtomicFieldElement
{
    /**
     * current user can see this field
     * @var bool
     */
    public $canSee = true;

    /**
     * The displayable name of the field.
     *
     * @var string
     */
    public $name;

    /**
     * The displayable name of the field.
     *
     * @var string
     */
    public $model;
    /**
     * The displayable name of the field.
     *
     * @var string
     */
    public $relationName;

    /**
     * The attribute / column name of the field.
     *
     * @var string
     */
    public $attribute;

    /**
     * The field's resolved value.
     *
     * @var mixed
     */
    public $value;

    /**
     * The validation rules for creation and updates.
     *
     * @var array
     */
    public $rules = [];


    /**
     * Field rules collection
     * @var array
     */
    public $fieldRules = [];

    /**
     * The validation rules for creation.
     *
     * @var array
     */
    public $creationRules = [];

    /**
     * The validation rules for updates.
     *
     * @var array
     */
    public $updateRules = [];


    /**
     * @var array
     */
    public $meta = [];

    /**
     * Indicates if the field should be sortable.
     *
     * @var bool
     */
    public $sortable = false;

    /**
     * Indicates if the field should be searchable.
     *
     * @var bool
     */
    public $searchable = false;


    /**
     * field rendering callback
     * @var
     */
    public $indexDisplayCallback;

    /**
     * Create a new field.
     *
     * @param  string $name
     * @param  string|null $attribute
     * @param  mixed|null $resolveCallback
     * @return void
     */
    public function __construct($name, $attribute = null, $relationName = null, $model = null)
    {
        $this->name = $name;
        $this->model = $model;
        $this->relationName = $relationName;
        $this->attribute = $attribute ?? str_replace(' ', '_', Str::lower($name));
        $this->setDefaultDisplay();
    }

    /**
     * Set the help text for the field.
     *
     * @param  string $helpText
     * @return $this
     */
    public function help($helpText)
    {
        return $this->withMeta(['helpText' => $helpText]);
    }


    /**
     * Set the sortable field for the field.
     *
     * @return $this
     */
    public function sortable()
    {
        $this->sortable = true;
        return $this;
    }

    /**
     * Set the sortable field for the field.
     *
     * @return $this
     */
    public function searchable()
    {
        $this->searchable = true;
        return $this;
    }


    /**
     * Get additional meta information to merge with the element payload.
     *
     * @return array
     */
    public function meta()
    {
        return $this->meta;
    }

    /**
     * Set additional meta information for the element.
     *
     * @param  array $meta
     * @return $this
     */
    public function withMeta(array $meta)
    {
        $this->meta = array_merge($this->meta, $meta);

        return $this;
    }

    /**
     * Set the validation rules for the field.
     *
     * @param  callable|array|string $rules
     * @return $this
     */
    public function rules($rules)
    {
        $this->rules = is_string($rules) ? func_get_args() : $rules;

        return $this;
    }


    /**
     * Set the creation validation rules for the field.
     *
     * @param  callable|array|string $rules
     * @return $this
     */
    public function creationRules($rules)
    {
        $this->creationRules = is_string($rules) ? func_get_args() : $rules;

        return $this;
    }


    /**
     * @param $rule
     * @return bool
     */
    public function hasCreationRule($rule)
    {
        $check = array_search($rule, $this->creationRules);
        $checkRules = array_search($rule, $this->rules);
        if (isset($this->creationRules[$check]) || isset($this->rules[$checkRules])) {
            if ($this->rules[$checkRules] == $rule || $this->creationRules[$check] == $rule) {

                return true;
            }
        }
        return false;
    }

    /**
     * @param $rule
     * @return bool
     */
    public function hasUpdateRule($rule)
    {
        $check = array_search($rule, $this->updateRules);
        $checkRules = array_search($rule, $this->rules);
        if (isset($this->updateRules[$check]) || isset($this->rules[$checkRules])) {
            if ($this->rules[$checkRules] == $rule || $this->updateRules[$check] == $rule) {
                return true;
            }
        }
        return false;
    }

    /**
     * Set the creation validation rules for the field.
     *
     * @param  callable|array|string $rules
     * @return $this
     */
    public function updateRules($rules)
    {
        $this->updateRules = is_string($rules) ? func_get_args() : $rules;

        return $this;
    }

    /**
     * check if the field of listing kind
     * @return bool
     */
    public function ListingField()
    {
        $class = $this;
        if ($class instanceof ListingField) {
            return true;
        }
        return false;
    }

    /**
     * fill the field with model value
     * @param $value
     */
    public function fill($value)
    {
        $this->value = $value;
    }

    /**
     * get field attribute
     * @return mixed|null|string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }


    /**
     * fields display
     * @param $callback
     * @return $this
     */
    public function indexDisplay($callback)
    {
        $this->indexDisplayCallback = $callback;
        return $this;
    }

    /**
     * set default display
     * @return $this
     */
    public function setDefaultDisplay()
    {

        $this->indexDisplayCallback = $this->defaultDisplay();

        return $this;
    }

    /**
     * default display for the field
     * @return mixed
     */
    public function defaultDisplay()
    {
        $attribute = $this->attribute;
        return function ($model) use ($attribute) {
            if ($model->$attribute == null) {
                return '__';
            }
            $html = $model->$attribute;
            return $html;
        };
    }

    /**
     * render display for given model
     * @param $model
     * @return mixed
     */
    public function renderDisplay($model)
    {
        return call_user_func($this->indexDisplayCallback, $model);
    }

    /**
     * Current User Can See This Field
     * @param $callback
     * @return $this
     */
    public function canSee($callback)
    {
        if (is_callable($callback)) {

            $this->canSee = call_user_func($callback);
        }
        return $this;
    }
}