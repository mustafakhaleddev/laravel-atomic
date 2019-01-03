<?php

namespace MustafaKhaled\AtomicPanel\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use MustafaKhaled\AtomicPanel\AtomicPanel;

class AtomicController extends Controller
{

    /**
     * model class
     * @var
     */
    protected $AtomicModel;

    /**
     * model name
     * @var
     */
    protected $AtomicModelName;

    /**
     * Atomic Dashboard Index View
     * @return mixed
     */
    public function index()
    {
        $data = AtomicPanel::$dashboardData;
        return view('atomic::partials.dashboard')->with('data', $data);
    }


    /**
     * fetch model data
     * @param $AtomicModel
     */
    public function getAtomicModel($AtomicModel)
    {
        $AtomicModelName = $AtomicModel;
        $AtomicModel = AtomicPanel::atomicModel($AtomicModel);
        if (!$AtomicModel) abort(404);
        $this->AtomicModelName = $AtomicModelName;
        $this->AtomicModel = $AtomicModel;
    }
}