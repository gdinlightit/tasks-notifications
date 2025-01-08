<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Lightit\Backoffice\Task\App\Notifications\TaskAssignmentNotification;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDto;
use Lightit\Backoffice\Task\Domain\Models\Task;

class StoreTaskAction
{
    public function execute(TaskDto $dto): Task
    {
        $task = Task::create($dto->toArray());
        $task->employee->notify(new TaskAssignmentNotification($task));

        return $task;
    }
}
