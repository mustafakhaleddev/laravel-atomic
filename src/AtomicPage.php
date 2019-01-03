<?php

namespace MustafaKhaled\AtomicPanel;


use Illuminate\Support\Str;

class AtomicPage
{

    /**
     * default page class
     * @var string
     */
    public static $AtomicClass = 'fa fa-cube';

    /**
     * default show in navigation
     * @var bool
     */
    public static $AtomicNavigation = true;



    /**
     * default value
     * @var bool
     */
    public $canSee = true;

    /**
     * get the class for navigation
     * @return string
     */
    public static function getAtomicClass()
    {
        return static::$AtomicClass;
    }

    /*
     * return page navigation label
     * @return string
     */
    public static function label()
    {
        return Str::plural(class_basename(get_called_class()));
    }

    /**
     * Get the displayable singular label of the page.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return Str::singular(static::label());
    }


    /**
     * Current User Can See This widget
     * @param $callback
     * @return string
     */
    public function canSee($callback)
    {
        if (is_callable($callback)) {

            $this->canSee = call_user_func($callback);
        }
        return $this;
    }

    /**
     * change display in navigation value
     * @return bool
     */
    public static function AtomicDisplayInNavigation()
    {
        return static::$AtomicNavigation;
    }


    /**
     * return page path in route
     * @return string
     */
    public static function path()
    {
        return class_basename(get_called_class());
    }


    /**
     * page route name
     * @param null $route
     * @return string
     */
    public static function routePath($route = null)
    {
        return AtomicPanel::routePath() . '.' . static::path() . ($route != null ? '.' . $route : '');
    }


}