<?php

namespace App\Table;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Inertia\Response;

class Table
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Collects all properties and sets the default
     * values from the request query.
     *
     * @return array
     */
    public function getTableProps(): array
    {
        $sortBy   = $this->request->input('sortBy');
        $sortDesc = $this->request->input('sortDesc');
        $global   = $this->request->input('global');
        $filters  = $this->request->except(['sortBy','sortDesc','global']);

        return [
            'sortBy'   => $sortBy,
            'sortDesc' => $sortDesc,
            'global'  => $global,
            'filters'  => $filters,
            'url'  => $this->request->url(),
        ];
    }

    /**
     * Give the query builder props to the given Inertia response.
     *
     * @param \Inertia\Response $response
     * @return \Inertia\Response
     */
    public function applyTo(Response $response): Response
    {
        return $response->with('tableProps', $this->getTableProps());
    }

}
