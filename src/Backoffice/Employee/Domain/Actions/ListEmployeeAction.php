<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\Domain\Actions;

use Illuminate\Database\Eloquent\Collection;
use Lightit\Backoffice\Employee\Domain\Models\Employee;
use Spatie\QueryBuilder\QueryBuilder;

class ListEmployeeAction
{
    /**
     * @return Collection<int, Employee>
     */
    public function execute(): Collection
    {
        /**
         * @var Collection<int, Employee>
         */
        $employees = QueryBuilder::for(Employee::class)
            ->latest()
            ->get();

        return $employees;
    }
}
