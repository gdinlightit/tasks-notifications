<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Transformers;

use Flugg\Responder\Transformers\Transformer;
use Lightit\Backoffice\Employee\App\Transformers\EmployeeTransformer;
use Lightit\Backoffice\Task\Domain\Models\Task;
use Lightit\Shared\App\FormattedTimestamps;

class TaskTransformer extends Transformer
{
    use FormattedTimestamps;

    protected $relations = [
        'employee' => EmployeeTransformer::class,
    ];

    public function transform(Task $task): array
    {
        return [
            'id' => $task->id,
            'title' => $task->title,
            'description' => $task->description,
            'status' => $task->status,
            'employee' => $task->employee,
            ...$this->timestamps($task),
        ];
    }
}
