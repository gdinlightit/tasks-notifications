<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Task\App\Requests\StoreTaskRequest;
use Lightit\Backoffice\Task\App\Transformers\TaskTransformer;
use Lightit\Backoffice\Task\Domain\Actions\StoreTaskAction;

class StoreTaskController
{
    public function __invoke(
        StoreTaskRequest $request,
        StoreTaskAction $action,
    ): JsonResponse {
        $task = $action->execute($request->toDto());

        return responder()
            ->success($task, TaskTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
