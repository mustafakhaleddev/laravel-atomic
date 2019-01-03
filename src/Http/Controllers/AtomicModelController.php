<?php

namespace MustafaKhaled\AtomicPanel\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MustafaKhaled\AtomicPanel\AtomicPanel;
use MustafaKhaled\AtomicPanel\AtomicRelation;

class AtomicModelController extends AtomicController
{

    /**
     * @param $AtomicModel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function AtomicModelIndex($AtomicModel)
    {
        $this->getAtomicModel($AtomicModel);
        $AtomicModel = $this->AtomicModel;
        if (!$AtomicModel::canSee()) abort(403);
        $AtomicModelName = $this->AtomicModelName;
        return view(AtomicPanel::indexViewName(), compact('AtomicModel', 'AtomicModelName'));
    }


    /**
     * Handle Action For Model
     * @param $AtomicModel
     * @param $id
     * @param $action
     * @return mixed
     */
    public function AtomicModelAction($AtomicModel, $id, $action)
    {
        $this->getAtomicModel($AtomicModel);
        $AtomicModel = $this->AtomicModel;
        if (!$AtomicModel::canSee()) abort(403);
        $model = $AtomicModel::where('id', $id)->first();
        if (empty($model)) abort(404);
        $atomicAction = AtomicPanel::getModelAction($AtomicModel, $action);
        if (!$atomicAction) {
            flash(__("atomic::main.Wrong Action"))->error();
            return redirect()->back();
        }
        return $atomicAction->handle($model);
    }

    /**
     * @param $AtomicModel
     * @param $id
     * @return mixed
     */
    public function AtomicModelView($AtomicModel, $id)
    {
        $this->getAtomicModel($AtomicModel);
        $AtomicModel = $this->AtomicModel;
        $AtomicModelName = $this->AtomicModelName;
        if (!$AtomicModel::canSee()) abort(403);
        $model = $AtomicModel::where('id', $id)->first();
        if (empty($model)) abort(404);
        $AtomicModel::fillFields($model->toArray());
        $AtomicModel::setModel($model);
        return view('atomic::atomicModel.details', compact('AtomicModel', 'AtomicModelName', 'id', 'model'));
    }


    /**
     * @param $AtomicModel
     * @param $id
     * @return mixed
     */
    public function AtomicModelEdit($AtomicModel, $id)
    {
        $this->getAtomicModel($AtomicModel);
        $AtomicModel = $this->AtomicModel;
        if (!$AtomicModel::canEdit()) abort(403);
        $AtomicModelName = $this->AtomicModelName;
        $model = $AtomicModel::where('id', $id)->first();
        if (empty($model)) abort(404);
        $AtomicModel::fillFields($model->toArray());
        return view('atomic::atomicModel.update', compact('AtomicModel', 'AtomicModelName', 'id', 'model'));
    }


    /**
     * @param $AtomicModel
     * @param $id
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function AtomicModelUpdate($AtomicModel, $id, Request $request)
    {
        $this->getAtomicModel($AtomicModel);
        $AtomicModel = $this->AtomicModel;
        $AtomicModelName = $this->AtomicModelName;
        if (!$AtomicModel::canEdit()) abort(403);
        $model = $AtomicModel::find($id);
        if (empty($model)) abort(404);
        $this->validate($request, AtomicPanel::validateUpdateFields($AtomicModel::AtomicFields(),$id));
        return AtomicPanel::updateAtomicModel($AtomicModel, $request, $AtomicModelName, $model);
    }


    /**
     * Unset Model Column
     * @param $AtomicModel
     * @param $id
     * @param $column
     * @return mixed
     */
    public function AtomicUnsetModelColumn($AtomicModel, $id, $column)
    {
        $this->getAtomicModel($AtomicModel);
        $AtomicModel = $this->AtomicModel;
        if (!$AtomicModel::canEdit()) abort(403);
        $model = $AtomicModel::find($id);
        if (empty($model)) abort(404);
        try {
            $model->$column = null;
            $model->save();

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return redirect()->back();
    }

    /**
     * @param $AtomicModel
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function NewAtomicModel($AtomicModel)
    {
        $this->getAtomicModel($AtomicModel);
        $AtomicModel = $this->AtomicModel;
        if (!$AtomicModel::canAdd()) abort(403);
        $AtomicModelName = $this->AtomicModelName;
        return view('atomic::atomicModel.create', compact('AtomicModel', 'AtomicModelName'));

    }


    /**
     * @param $AtomicModel
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    public function AtomicModelStore($AtomicModel, Request $request)
    {
        $this->getAtomicModel($AtomicModel);
        $AtomicModel = $this->AtomicModel;
        $AtomicModelName = $this->AtomicModelName;
        if (!$AtomicModel::canAdd()) abort(403);
        $this->validate($request, AtomicPanel::validateCreationFields($AtomicModel::AtomicFields()));
        return AtomicPanel::createAtomicModel($AtomicModel, $request, $AtomicModelName);
    }

    public function AtomicModelDelete($AtomicModel, $id)
    {
        $this->getAtomicModel($AtomicModel);
        $AtomicModel = $this->AtomicModel;
        $AtomicModelName = $this->AtomicModelName;
        if (!$AtomicModel::canDelete()) abort(403);
        $model = $AtomicModel::find($id);
        if (empty($model)) abort(404);
        $model->delete();
        flash(__($AtomicModel::singularLabel() . __(" Deleted Successfully")))->success();
        return redirect(route('AtomicPanel.AtomicModelIndex', [$AtomicModelName]));
    }

    /**
     * @param $AtomicModel
     * @return mixed
     * @throws \Exception
     */
    public function ModelDatatable($AtomicModel)
    {
        $this->getAtomicModel($AtomicModel);
        $AtomicModel = $this->AtomicModel;
        if (!$AtomicModel::canSee()) abort(403);

        $AtomicModelName = $this->AtomicModelName;
        $atomicQueries = [];
        if (isset($_GET['AtomicRelation'])) {
            $AtomicRelation = AtomicRelation::fetch($_GET['AtomicRelation'], $AtomicModelName);
            if ($AtomicRelation != false && $AtomicRelation->relationKey != null) {
                $atomicQueries[] = $AtomicRelation->buildQuery();
            }
        }
        $datatable = datatables()->of($AtomicModel::withAtomicRelations()->withAtomicQueries($atomicQueries)->get());
        $AtomicColumns = AtomicPanel::getDatatableAtomicColumns($AtomicModel::AtomicFields());
        $rawColoumns = [];
        $rawColoumns[] = __('atomic::main.actions');
        foreach ($AtomicColumns as $name => $callback) {
            $datatable->addColumn($name, $callback);
            $rawColoumns[] = $name;
        }
        $datatable->addColumn(__('atomic::main.actions'), function ($model) use ($AtomicModelName, $AtomicModel) {
            $data = '<a href="' . route("AtomicPanel.AtomicModelView", [$AtomicModelName, $model->id]) . '" style="    margin-right: 10px;" class="btn btn-sm btn-default"><i class="fa fa-eye"></i> ' . __("atomic::main.View") . '</a>';
            if ($model->canEdit()) {

                $data .= '<a href="' . route("AtomicPanel.AtomicModelEdit", [$AtomicModelName, $model->id]) . '" style="    margin-right: 10px;" class="btn btn-sm btn-success"><i class="fa fa-pencil"></i> ' . __("atomic::main.Edit") . '</a>';
            }
            if ($model->canDelete()) {

                $data .= '<a href="#"  data-atomic-delete-url="' . route("AtomicPanel.AtomicModelDelete", [$AtomicModelName, $model->id]) . '" style="    margin-right: 10px;" class="atomic-delete-row btn btn-sm btn-danger"><i class="fa fa-trash"></i> ' . __("atomic::main.Delete") . '</a>';

            }

            $actions = AtomicPanel::modelHasActions($AtomicModel);
            if (count($actions) > 0) {

                $actionBtn = '<div style="display: inline-flex;margin-right: 10px;" class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">' . __("atomic::main.actions") . '
  <span class="caret"></span></button><ul class="dropdown-menu">';

                foreach ($actions as $action) {
                    $actionBtn .= '  <li><a href="' . route("AtomicPanel.AtomicModelAction", [$AtomicModelName, $model->id, $action->path()]) . '">' . $action->label() . '</a></li>';
                }
                $actionBtn .= '</ul>
</div>';

                $data .= $actionBtn;
            }
            return $data;
        });

        return $datatable->rawColumns($rawColoumns)->toJson();

    }
}