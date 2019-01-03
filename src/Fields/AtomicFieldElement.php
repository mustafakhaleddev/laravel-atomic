<?php
/**
 * Created by PhpStorm.
 * User: LENOVO
 * Date: 12/25/2018
 * Time: 6:57 AM
 */

namespace MustafaKhaled\AtomicPanel\Fields;


use MustafaKhaled\AtomicPanel\AtomicPanel;

abstract class AtomicFieldElement
{

    /**
     * Indicates if the element should be shown on the index view.
     *
     * @var bool
     */
    public $showOnIndex = true;

    /**
     * Indicates if the element should be shown on the detail view.
     *
     * @var bool
     */
    public $showOnDetail = true;

    /**
     * Indicates if the element should be shown on the creation view.
     *
     * @var bool
     */
    public $showOnCreation = true;

    /**
     * Indicates if the element should be shown on the update view.
     *
     * @var bool
     */
    public $showOnUpdate = true;


    /**
     * default field view files
     * @var string
     */
    public $FieldView = 'atomic::fields.default';

    /**
     * Create a new element.
     *
     * @return static
     */
    public static function make(...$arguments)
    {

        return new static(...$arguments);
    }

    /**
     * Specify that the element should be hidden from the index view.
     *
     * @return $this
     */
    public function hideFromIndex()
    {
        $this->showOnIndex = false;

        return $this;
    }

    /**
     * Specify that the element should be hidden from the detail view.
     *
     * @return $this
     */
    public function hideFromDetail()
    {
        $this->showOnDetail = false;

        return $this;
    }

    /**
     * Specify that the element should be hidden from the creation view.
     *
     * @return $this
     */
    public function hideWhenCreating()
    {
        $this->showOnCreation = false;

        return $this;
    }

    /**
     * Specify that the element should be hidden from the update view.
     *
     * @return $this
     */
    public function hideWhenUpdating()
    {
        $this->showOnUpdate = false;

        return $this;
    }

    /**
     * Specify that the element should only be shown on the index view.
     *
     * @return $this
     */
    public function onlyOnIndex()
    {
        $this->showOnIndex = true;
        $this->showOnDetail = false;
        $this->showOnCreation = false;
        $this->showOnUpdate = false;

        return $this;
    }

    /**
     * Specify that the element should only be shown on the detail view.
     *
     * @return $this
     */
    public function onlyOnDetail()
    {
        parent::onlyOnDetail();

        $this->showOnIndex = false;
        $this->showOnDetail = true;
        $this->showOnCreation = false;
        $this->showOnUpdate = false;

        return $this;
    }

    /**
     * Specify that the element should only be shown on forms.
     *
     * @return $this
     */
    public function onlyOnForms()
    {
        $this->showOnIndex = false;
        $this->showOnDetail = false;
        $this->showOnCreation = true;
        $this->showOnUpdate = true;

        return $this;
    }

    /**
     * Specify that the element should be hidden from forms.
     *
     * @return $this
     */
    public function exceptOnForms()
    {
        $this->showOnIndex = true;
        $this->showOnDetail = true;
        $this->showOnCreation = false;
        $this->showOnUpdate = false;

        return $this;
    }


    /**
     * render field create form view
     * @return mixed
     */
    public function renderFormView()
    {
        return AtomicPanel::renderFieldFormView($this);
    }

    /**
     * render field details view
     * @param $AtomicModel
     * @param $model
     * @return mixed
     */
    public function renderDetailView($AtomicModel, $model)
    {
        return AtomicPanel::renderFieldDetailView($this, $AtomicModel, $model);
    }

    /**
     * render field update form view
     * @param $AtomicModel
     * @param $model
     * @return mixed
     */
    public function renderUpdateView($AtomicModel, $model)
    {
        return AtomicPanel::renderFieldUpdateView($this, $AtomicModel, $model);
    }


    /**
     * render field index view
     * @param $AtomicModel
     * @return mixed
     */
    public function renderIndexView($AtomicModel)
    {
        return AtomicPanel::renderFieldIndexView($this, $AtomicModel);
    }

    /**
     * handle request value
     * @param $value
     * @return mixed
     */
    public function HandleRequestValue($value)
    {
        return $value;
    }


}