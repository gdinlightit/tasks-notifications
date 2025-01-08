<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Task\App\Requests\UpdateTaskRequest;
use Lightit\Backoffice\Task\App\Transformers\TaskTransformer;
use Lightit\Backoffice\Task\Domain\Actions\UpdateTaskAction;
use Lightit\Backoffice\Task\Domain\Models\Task;

class UpdateTaskController
{
    public function __invoke(
        Task $task,
        UpdateTaskRequest $request,
        UpdateTaskAction $action,
    ): JsonResponse {
        $task = $action->execute($task, $request->toDto());

        return responder()
            ->success($task, TaskTransformer::class)
            ->respond();
    }
}
