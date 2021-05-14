<?php

declare(strict_types=1);

namespace App\Service;

use Illuminate\Http\Request;

class FiltersFormatter
{
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function format(array $filtersNames, array $default = []): array
    {
        $filters = $this->request->only($filtersNames);

        $formatted = [];
        foreach ($filtersNames as $name) {
            if (isset($filters[$name])) {
                $formatted[$name] = $filters[$name];
            } else {
                $formatted[$name] = isset($default[$name]) ? $default[$name] : null;
            }
        }

        return $formatted;
    }
}
