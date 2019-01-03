<?php

namespace MustafaKhaled\AtomicPanel\Events;

use Illuminate\Http\Request;
use Illuminate\Foundation\Events\Dispatchable;

class ServingAtomic
{
    use Dispatchable;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    public $request;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
