<?php

namespace MustafaKhaled\AtomicPanel;


use Illuminate\Support\Str;

class AtomicWidget
{

    /**
     * widget bootstrap columns
     * @var int
     */
    public $widgetCols = 4;

    /**
     * default value
     * @var bool
     */
    public $canSee = true;

    /**
     * Current User Can See This widget
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


    /**
     * set widget columns for view
     * @param $cols
     * @return $this
     */
    public function widgetCols($cols)
    {
        $this->widgetCols=$cols;
        return $this;
    }

    /**
     * return widget path in route
     * @return string
     */
    public static function path()
    {
        return class_basename(get_called_class());
    }


    /**
     * widget route path
     * @param null $route
     * @return string
     */
    public static function routePath($route = null)
    {
        return AtomicPanel::routePath() . '.' . static::path() . ($route != null ? '.' . $route : '');
    }


    /**
     * render widget view
     * @param null $AtomicModel
     * @return null
     */
    public function render($AtomicModel = null)
    {
        return null;
    }

}