<?php

namespace App\Support;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use ReflectionClass;
use ReflectionMethod;

final class Filter
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Mapear chave da requisição.
     *
     * @var string
     */
    protected $searchKey = 'q';

    /**
     * Lista de filtros disponiveis.
     *
     * @var array
     */
    protected $filters = [];

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var User
     */
    protected $user;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Model|Builder $model
     * @return void
     */
    public function setModel($model): void
    {
        $this->model = $model;
    }

    /**
     * @param User $user
     * @return Filter
     */
    public function setUser(User $user): Filter
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Aplicar filtro.
     *
     * @return mixed
     */
    public function response()
    {
        # obter filtros disponiveis
        $this->loadFilters();

        # filtro
        $filter = $this->request->input($this->searchKey);

        # paginação
        $paginate = $this->request->input('paginate', 10);

        $query = null;

        if ($filter && $filter !== 'all' && in_array($filter, $this->filters)) {
            # escopo
            $method = lcfirst($filter);
            # aplicar escopo
            $query = $this->model->{$method}();
        } else {
            $query = $this->model;
        }

        if ($this->user) {
            $query->where('user_id', $this->user->id);
        }

        return $query->paginate($paginate);
    }

    /**
     * Carregar escopos disponiveis na model.
     *
     * @return void
     */
    private function loadFilters()
    {
        $root = new ReflectionClass($this->model);

        $filtered = array_filter(
            $root->getMethods(ReflectionMethod::IS_PUBLIC),
            function ($method) use ($root) {
                return $method->class === $root->name && preg_match('/^scope\B/', $method->name);
            }
        );

        foreach ($filtered as $method) {
            $this->filters[] = str_replace('scope', '', $method->name);
        }
    }
}
