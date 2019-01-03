<?php

namespace MustafaKhaled\AtomicPanel;


use Illuminate\Support\Str;

class AtomicModelAction
{

    /**
     * default value
     * @var bool
     */
    public $canSee = true;


    /**
     * Current User Can See This Page
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
     * return action path in route
     * @return string
     */
    public static function path()
    {
        return class_basename(get_called_class());
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
     * handle action request
     * @param $model
     * @return null
     */
    public function handle($model)
    {
        return redirect()->back();
    }

}