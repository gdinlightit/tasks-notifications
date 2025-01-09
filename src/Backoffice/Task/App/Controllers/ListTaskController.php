<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Controllers;

use Illuminate\Http\JsonResponse;

use Lightit\Backoffice\Task\App\Transformers\TaskTransformer;
use Lightit\Backoffice\Task\Domain\Actions\ListTaskAction;

class ListTaskController
{
    public function __invoke(
        ListTaskAction $action,
    ): JsonResponse {
        $task = $action->execute();

        return responder()
            ->success($task, TaskTransformer::class)
            ->respond();
    }
}
