<?php

namespace MustafaKhaled\AtomicPanel;


use Illuminate\Support\Str;
use MustafaKhaled\AtomicPanel\Fields\ID;
use Illuminate\Support\Facades\Gate;

trait AtomicModel
{

    /**
     * default atomic view for this model
     * @var null
     */
    public static $AtomicView = null;

    /**
     * default atomic title
     * @var string
     */
    public static $AtomicTitle = 'id';

    /**
     * default show in navigation
     * @var bool
     */
    public static $AtomicNavigation = true;

    /**
     * default class
     * @var string
     */
    public static $AtomicClass = 'fa fa-cube';

    /**
     * default fillable array
     * @var array
     */
    public static $AtomicFillArray = [];

    /**
     * atomic model
     * @var
     */
    public static $AtomicViewModel;

    /**
     * register atomic fields for this model
     * @return array
     */
    public static function AtomicFields()
    {
        return [
            ID::make('ID', 'id'),
        ];
    }

    /**
     * Register Atomic Widgets for this model
     * @return array
     */
    public static function AtomicWidgets()
    {
        return [];
    }


    /**
     * Register Atomic Actions for this model
     * @return array
     */
    public static function AtomicActions()
    {
        return [];
    }

    /**
     * set model for this class
     * @param $model
     */
    public static function setModel($model)
    {
        static::$AtomicViewModel = $model;
    }

    /**
     * Navigation Icon Class
     * @return string
     */
    public static function getAtomicClass()
    {
        return static::$AtomicClass;
    }

    /**
     * fill fields with model
     * @param $model
     */
    public static function fillFields($model)
    {
        static::$AtomicFillArray = $model;
    }

    /**
     * Current User Can Add New Model
     * @return bool
     */
    public static function canAdd()
    {
        if(Gate::has('create', static::class)){
            return app()->environment('local') || auth()->user()->can('create', static::class);
        }
        return true;
    }

    /**
     * Current User Can See This Model
     * @return bool
     */
    public static function canSee()
    {
        if(Gate::has('view', static::class)){
            return app()->environment('local') || auth()->user()->can('view', static::class);
        }
        return true;

    }


    /**
     * Current User Can Delete This Model
     * @return bool
     */
    public static function canDelete()
    {
        if(Gate::has('delete', static::class)){
            return app()->environment('local') || auth()->user()->can('delete', static::class);
        }
        return true;

    }

    /**
     * Current User Can Edit This Model
     * @return bool
     */
    public static function canEdit()
    {
        if(Gate::has('update', static::class)){
            return app()->environment('local') || auth()->user()->can('update', static::class);
        }
        return true;
    }

    /*
     * get model label name
    * @return string
    */
    public static function label()
    {
        return Str::plural(class_basename(get_called_class()));
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return Str::singular(static::label());
    }

    /**
     * return model title for relations
     * @return string
     */
    public static function modelTitle()
    {
        return static::$AtomicTitle;
    }


    /**
     * get current model relations fields
     * @return array
     */
    public static function getAtomicRelations()
    {
        return AtomicPanel::fetchRelations(static::AtomicFields());
    }

    /**
     * show relations with model
     * @param $query
     * @return mixed
     */
    public function scopeWithAtomicRelations($query)
    {
        return $query->with(static::getAtomicRelations());
    }


    /**
     * set scopes for query
     * @param $query
     * @param $queries
     * @return mixed
     */
    public function scopeWithAtomicQueries($query, $queries)
    {
        foreach ($queries as $q) {
            call_user_func($q, $query);
        }
        return $query;
    }


    /**
     * get base class name
     * @return mixed
     */
    public function AtomicBaseName()
    {
        return class_basename($this);
    }

    /**
     * return base class name
     * @return mixed
     */
    public static function AtomicBaseClassName()
    {
        return class_basename(static::class);
    }


    /**
     * set other view for index view for this model
     * @return null
     */
    public static function AtomicIndexContentView()
    {
        return null;
    }

    /**
     * set other view for details view for this model
     * @return null
     */
    public static function AtomicDetailsContentView()
    {
        return null;
    }

    /**
     * show on navigation
     * @return bool
     */
    public static function AtomicDisplayInNavigation()
    {
        return static::$AtomicNavigation;
    }
}