<?php

namespace MustafaKhaled\AtomicPanel;


class ActionMessage
{
    public $message;

    /**
     * ActionMessage constructor.
     * @param $message
     */
    public function __construct($message)
    {
        $this->message = $message;
    }


    /**
     * make new message
     * @param $message
     * @return ActionMessage
     */
    public static function make($message)
    {
        return new static($message);
    }


    /**
     * register success message
     */
    public function success()
    {
        flash($this->message)->success();
    }

    /**
     * register danger message
     */
    public function danger()
    {
        flash($this->message)->warning();
    }

    /**
     * register error message
     */
    public function error()
    {
        flash($this->message)->error();
    }


}