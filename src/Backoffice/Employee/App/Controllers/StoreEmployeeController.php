<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Employee\App\Controllers;

use Illuminate\Http\JsonResponse;
use Lightit\Backoffice\Employee\App\Requests\StoreEmployeeRequest;
use Lightit\Backoffice\Employee\App\Transformers\EmployeeTransformer;
use Lightit\Backoffice\Employee\Domain\Actions\StoreEmployeeAction;

class StoreEmployeeController
{
    public function __invoke(
        StoreEmployeeRequest $request,
        StoreEmployeeAction $action,
    ): JsonResponse {
        $employee = $action->execute($request->toDto());

        return responder()
            ->success($employee, EmployeeTransformer::class)
            ->respond(JsonResponse::HTTP_CREATED);
    }
}
