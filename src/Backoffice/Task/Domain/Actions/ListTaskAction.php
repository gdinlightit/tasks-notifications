<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Illuminate\Database\Eloquent\Collection;
use Lightit\Backoffice\Task\Domain\Models\Task;
use Spatie\QueryBuilder\QueryBuilder;

class ListTaskAction
{
    /**
     * @return Collection<int, Task>
     */
    public function execute(): Collection
    {
        /**
         * @var Collection<int, Task>
         */
        $tasks = QueryBuilder::for(Task::class)
            ->latest()
            ->get();

        return $tasks;
    }
}
