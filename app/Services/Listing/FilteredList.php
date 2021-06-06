<?php

declare(strict_types=1);

namespace App\Services\Listing;

use Illuminate\Pagination\LengthAwarePaginator;

abstract class FilteredList
{
    protected array $acceptableFilters;
    protected array $defaultFiletrs;

    protected array $filters;
    protected array $chosenFilters;

    abstract public function filter(): LengthAwarePaginator;

    public function setFilters(array $filters): self
    {
        $this->filters = $filters;

        return $this;
    }

    public function qualifyFilters(array $chosenFilters): self
    {
        $this->chosenFilters = $chosenFilters;

        return $this;
    }

    public function filters(): array
    {
        return $this->filters;
    }

    protected function prepareFilters(): void
    {
        $expectedFilters = $this->extractExpectedFiltersNames($this->chosenFilters);

        foreach ($expectedFilters as $name) {

            if (!array_key_exists($name, $this->filters)) {
                $this->filters[$name] = $this->defaultFiletrs[$name] ?? null;
            } else {
                $this->filters[$name] = $this->filters[$name];
            }
        }
    }

    protected function extractExpectedFiltersNames(array $expectedFilters): array
    {
        return array_intersect_key($expectedFilters, $this->acceptableFilters);
    }
}
