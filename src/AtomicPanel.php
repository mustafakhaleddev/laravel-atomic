<?php

namespace MustafaKhaled\AtomicPanel;


use MustafaKhaled\AtomicPanel\Events\ServingAtomic;
use MustafaKhaled\AtomicPanel\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Event;
use Symfony\Component\Finder\Finder;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;
use Illuminate\Support\Str;

class AtomicPanel
{
    use AuthorizesRequests;

    /**
     * Reset passwords for atomic users
     * @var bool
     */
    public static $resetsPasswords = false;

    /**
     * All Atomic models registered to application
     * @var array
     */
    public static $atomicModels = [];

    /**
     * All Atomic scripts registered to application
     * @var array
     */
    public static $atomicScripts = [];

    /**
     * All atomic styles registered to application
     * @var array
     */
    public static $atomicStyles = [];

    /**
     * Atomic dashboard view data
     * @var array
     */
    public static $dashboardData = [];

    /**
     * All atomic pages registered to application
     * @var array
     */
    public static $pages = [];


    /**
     * Rtl Dashboard
     * @var bool
     */
    public static $rtl = false;

    /**
     * register atomic routes
     * @return PendingRouteRegistration
     */
    public static function routes()
    {
        Route::aliasMiddleware('AtomicPanel.guest', RedirectIfAuthenticated::class);

        return new PendingRouteRegistration;
    }

    /**
     * return atomic path
     * @return mixed
     */
    public static function path()
    {
        return config('AtomicPanel.path');

    }


    /**
     * return atomic application name
     * @return mixed
     */
    public static function name()
    {
        return config('AtomicPanel.name', 'Atomic Panel');

    }

    /**
     * Register an event listener for  "serving" event.
     * @param $callback
     * @throws \ReflectionException
     */
    public static function serving($callback)
    {
        static::AtomicModelFetch();
        Event::listen(ServingAtomic::class, $callback);
    }


    /**
     * get all models in application that`s use atomic model
     * @param $directory
     * @throws \ReflectionException
     */
    public static function modelsIn($directory)
    {
        $namespace = app()->getNamespace();

        $models = [];

        foreach ((new Finder)->in($directory)->files() as $model) {
            $modelName = str_replace(
                ['/', '.php'],
                ['\\', ''],
                Str::after($model->getPathname(), app_path() . DIRECTORY_SEPARATOR)
            );
            $model = $namespace . $modelName;

            if (is_subclass_of($model, Model::class) &&
                !(new ReflectionClass($model))->isAbstract() && in_array(AtomicModel::class, class_uses($model, AtomicModel::class))) {

                $singleName = explode("\\", $modelName);
                $models[$singleName[count($singleName) - 1]] = $model;
            }
        }

        static::models(
            collect($models)->sort()->all()
        );
    }


    /**
     * fetch atomic models
     * @throws \ReflectionException
     */
    public static function AtomicModelFetch()
    {
        $path = app_path();
        static::modelsIn($path);
    }

    /**
     * Register the given models.
     *
     * @param  array $models
     * @return static
     */
    public static function models(array $models)
    {
        static::$atomicModels = array_merge(static::$atomicModels, $models);

        return new static;
    }

    /**
     * return atomic model by model name
     * @param $model
     * @return bool|mixed
     */
    public static function atomicModel($model)
    {
        if (isset(static::$atomicModels[$model])) {
            return static::$atomicModels[$model];
        }
        return false;
    }


    /**
     * render field form view file
     * @param $field
     * @return mixed
     */
    public static function renderFieldFormView($field)
    {
        return view($field->FieldView . '.create', compact('field'));
    }


    /**
     * render field details view file
     * @param $field
     * @param $AtomicModel
     * @param $model
     * @return mixed
     */
    public static function renderFieldDetailView($field, $AtomicModel, $model)
    {
        if (isset($AtomicModel::$AtomicFillArray[$field->attribute])) {
            $field->fill($AtomicModel::$AtomicFillArray[$field->attribute]);
        }
        return view($field->FieldView . '.details', compact('field', 'AtomicModel', 'model'));
    }


    /**
     * render field update form view file
     * @param $field
     * @param $AtomicModel
     * @param $model
     * @return mixed
     */
    public static function renderFieldUpdateView($field, $AtomicModel, $model)
    {
        if (isset($AtomicModel::$AtomicFillArray[$field->attribute])) {

            $field->fill($AtomicModel::$AtomicFillArray[$field->attribute]);
        }
        return view($field->FieldView . '.update', compact('field', 'AtomicModel', 'model'));
    }

    /**
     * render field index view file
     * @param $field
     * @param $AtomicModel
     * @return mixed
     */
    public static function renderFieldIndexView($field, $AtomicModel)
    {
        return view($field->FieldView . '.index', compact('field', 'AtomicModel'));
    }


    /**
     * validate field creation rules
     * @param $fields
     * @return array
     */
    public static function validateCreationFields($fields)
    {
        $rules = [];
        foreach ($fields as $field) {
            if (!$field->showOnCreation) continue;
            if(!$field->canSee) continue;

            $fieldRules = [];
            foreach ($field->rules as $rule) {
                if (is_callable($rule)) continue;
                $fieldRules[] = $rule;
            }
            foreach ($field->fieldRules as $rule) {
                if (is_callable($rule)) continue;
                $fieldRules[] = $rule;
            }

            foreach ($field->creationRules as $rule) {
                if (is_callable($rule)) continue;
                $fieldRules[] = $rule;
            }
            $rules[$field->attribute] = implode('|', $fieldRules);
        }
        return $rules;
    }

    /**
     * @param $fields
     * @param null $id
     * @param null $column
     * @return array
     */
    public static function validateUpdateFields($fields, $id = null)
    {
        $rules = [];
        foreach ($fields as $field) {
            if (!$field->showOnUpdate) continue;

            if(!$field->canSee) continue;

            $fieldRules = [];
            foreach ($field->rules as $rule) {
                if (is_callable($rule)) continue;
                $fieldRules[] = $rule;
            }

            foreach ($field->fieldRules as $rule) {
                if (is_callable($rule)) continue;
                $fieldRules[] = $rule;
            }

            foreach ($field->updateRules as $rule) {
                if (is_callable($rule)) continue;
                $fieldRules[] = $rule;
            }

            $fieldRules = str_replace('{{modelID}}', $id, $fieldRules);
            $rules[$field->attribute] = implode('|', $fieldRules);
        }

        return $rules;
    }


    /**
     * create model for atomic model and requests
     * @param $model
     * @param $request
     * @param $route
     * @return mixed
     */
    public static function createAtomicModel($model, $request, $route)
    {
        try {

            $newModel = new $model();
            foreach ($model::AtomicFields() as $field) {
                if (!$field->showOnCreation || $field->ListingField()) continue;
                if(!$field->canSee) continue;

                $attribute = $field->attribute;
                $newModel->$attribute = $field->HandleRequestValue($request->$attribute);
            }
            $newModel->save();
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->back()->withInput($request->input());
        }
        flash($model::singularLabel() . __("atomic::main.Has been created successfully"))->success();
        if ($request->submit == 'save') {
            return redirect(route('AtomicPanel.AtomicModelView', [$route, $newModel->id]));

        } elseif ($request->submit == 'create') {
            return redirect(route('AtomicPanel.NewAtomicModel', [$route]));

        }

    }

    /**
     * update atomic model by model and request
     * @param $AtomicModel
     * @param $request
     * @param $route
     * @param $model
     * @return mixed
     */
    public static function updateAtomicModel($AtomicModel, $request, $route, $model)
    {
        try {
            foreach ($AtomicModel::AtomicFields() as $field) {
                if (!$field->showOnUpdate || $field->ListingField()) continue;
                if(!$field->canSee) continue;

                $attribute = $field->attribute;
                if (!isset($request->$attribute)) continue;
                $model->$attribute = $field->HandleRequestValue($request->$attribute);
            }
            $model->save();
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->withInput($request->input());
        }
        flash($model::singularLabel() . __("atomic::main.Has been updated successfully"))->success();
        return redirect(route('AtomicPanel.AtomicModelView', [$route, $model->id]));

    }

    /**
     * register atomic scripts
     * @param $scripts
     */
    public static function serveScripts($scripts)
    {
        static::$atomicScripts = array_merge(static::$atomicScripts, $scripts);
    }


    /**
     * register atomic styles
     * @param $styles
     */
    public static function serveStyles($styles)
    {
        static::$atomicStyles = array_merge(static::$atomicStyles, $styles);
    }


    /***
     * return resets password value
     * @return bool
     */
    public static function resetsPasswords()
    {
        return static::$resetsPasswords;
    }


    /**
     * fetch relations fields for model
     * @param $fields
     * @return array
     */
    public static function fetchRelations($fields)
    {
        $relations = [];
        foreach ($fields as $field) {
            if (isset($field->relationField) && !$field->listingField()) {
                $relations[] = $field->relationName;
            }
        }
        return $relations;
    }

    /**
     * render index for datatable columns
     * @param $fields
     * @return array
     */
    public static function getDatatableAtomicColumns($fields)
    {
        $columns = [];
        foreach ($fields as $field) {
            if ($field->indexDisplayCallback != null) {
                $columns[$field->getAttribute()] = $field->indexDisplayCallback;
            }
        }
        return $columns;
    }


    /**
     * register atomic pages
     * @param $pages
     * @throws \ReflectionException
     */
    public static function registerPages($pages)
    {
        $pagesArray = [];
        foreach ($pages as $page) {
            if (is_subclass_of($page, AtomicPage::class) &&
                !(new ReflectionClass($page))->isAbstract()) {
                if(!$page->canSee) continue;
                $pagesArray[$page::routePath()] = $page;
            }
        }
        static::$pages = $pagesArray;
    }

    /**
     * validate pages routes
     * @param $name
     * @return bool|mixed
     */
    public static function checkPageRoute($name)
    {
        $routeName = explode('.', $name);
        $routeName = $routeName[0] . '.' . $routeName[1];
        if (isset(static::$pages[$routeName])) {
            return static::$pages[$routeName];
        }
        return false;
    }

    /**
     * register dashboard data
     * @param $data
     */
    public static function registerDashboardData($data)
    {
        if (is_array($data)) static::$dashboardData = $data;
    }

    /**
     * return base index view name
     * @return string
     */
    public static function indexViewName()
    {
        return 'atomic::atomicModel.index';
    }


    /**
     * return atomic route path
     * @return string
     */
    public static function routePath()
    {
        return 'AtomicPanel';
    }


    /**
     * fetch class namespace
     * @param $page
     * @return string
     */
    public static function classNamespace($page)
    {
        $page = explode("\\", $page);
        return $page[0] . '\\' . $page[1];
    }

    /**
     * register routes functions
     * @param $routes
     */
    public static function registerRoutes($routes)
    {
        if (is_callable($routes)) call_user_func($routes);
    }

    /**
     * register views function
     * @param $views
     */
    public static function registerViews($views)
    {
        if (is_callable($views)) call_user_func($views);
    }


    /**
     * get atomic actions for model
     * @param $model
     * @return array
     */
    public static function modelHasActions($model)
    {
        $actions = [];
        foreach ($model::AtomicActions() as $action) {
            if ($action->canSee) {
                $actions[] = $action;
            }
        }
        return $actions;
    }

    /**
     * get action for model
     * @param $model
     * @param $atomicAction
     * @return bool
     */
    public static function getModelAction($model, $atomicAction)
    {
        foreach ($model::AtomicActions() as $action) {
            if ($action->path() == $atomicAction) {
                return $action;
            }
        }
        return false;

    }


    /**
     * Set RTL For Dashboard
     */
    public static function setRTL()
    {
        static::$rtl = true;
    }
}