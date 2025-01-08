<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\Domain\Actions;

use Lightit\Backoffice\Task\App\Notifications\TaskAssignmentNotification;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDto;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpdateTaskAction
{
    public function execute(Task $task, TaskDto $dto): Task
    {
        $previousEmployeeId = $task->employee_id;
        $previousEmployee = $task->employee;

        $task->fill($dto->toArray());

        if ($task->isDirty('employee_id') && $previousEmployeeId !== $task->employee_id) {
            // notify the newly assigned employee
            $newEmployee = $task->employee()->firstOrFail();

            $newEmployee->notify(
                new TaskAssignmentNotification(
                    task: $task,
                    isReassignment: true,
                    previousEmployee: $previousEmployee
                )
            );
        }

        $task->saveOrFail();

        return $task;
    }
}
