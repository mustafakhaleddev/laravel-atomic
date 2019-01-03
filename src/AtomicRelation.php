<?php

namespace MustafaKhaled\AtomicPanel;

use Illuminate\Support\Str;

class AtomicRelation
{

    /**
     * relation function name
     * @var
     */
    public $relationType;
    /**
     * relation model name
     * @var
     */
    public $relationModel;

    /**
     * relation id value
     * @var
     */
    public $relationID;

    /**
     * relation foreign key
     * @var
     */
    public $relationKey;

    /**
     * AtomicRelation constructor.
     * @param $relationType
     * @param $relationModel
     * @param $relationID
     */
    public function __construct($relationType, $relationModel, $relationID, $atomicModel)
    {
        $this->relationType = $relationType;
        $this->relationModel = $relationModel;
        $this->relationID = $relationID;
        $this->authorize($atomicModel);

    }

    /**
     * get relation foreign key
     * @param $atomicModel
     */
    public function authorize($atomicModel)
    {
        $atomicModel = Str::plural($atomicModel);
        if (isset(AtomicPanel::$atomicModels[$this->relationModel])) {
            $AtomicRelationModel = AtomicPanel::$atomicModels[$this->relationModel];
            $AtomicCheck = $AtomicRelationModel::find($this->relationID);
            if ($AtomicCheck) {
                $relation = $AtomicCheck->$atomicModel();
                $this->relationKey = $relation->getForeignKeyName();
                $this->relationID=$relation->getParentKey();
            }
        }
    }

    /**
     * build relation query
     * @return \Closure
     */
    public function buildQuery()
    {
        return function ($query) {
            $query->where($this->relationKey, $this->relationID);
        };
    }

    /**
     * fetch data
     * @param $data
     * @param $model
     * @return bool|AtomicRelation
     */
    public static function fetch($data, $model)
    {
        if (count($data) >= 3) {
            return new static($data[0], $data[1], $data[2], $model);
        }
        return false;
    }


}