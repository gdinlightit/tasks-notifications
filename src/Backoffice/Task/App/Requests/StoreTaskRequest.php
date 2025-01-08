<?php

declare(strict_types=1);

namespace Lightit\Backoffice\Task\App\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Lightit\Backoffice\Employee\Domain\Models\Employee;
use Lightit\Backoffice\Task\Domain\DataTransferObjects\TaskDto;
use Lightit\Backoffice\Task\Domain\Enums\TaskStatus;
use Lightit\Backoffice\Task\Domain\Models\Task;

class StoreTaskRequest extends FormRequest
{
    public const TITLE = 'title';

    public const DESCRIPTION = 'description';

    public const STATUS = 'status';

    public const EMPLOYEE_ID = 'employee_id';

    public function rules(): array
    {
        return [
            self::TITLE => [
                'required',
                'string',
                Rule::unique(Task::class, self::TITLE)->ignore($this->task),
            ],
            self::DESCRIPTION => ['sometimes', 'string', 'max:1024'],
            self::STATUS => [
                'sometimes',
                Rule::enum(type: TaskStatus::class),
            ],
            self::EMPLOYEE_ID => ['required', 'integer', Rule::exists(Employee::class, 'id')],
        ];
    }

    public function toDto(): TaskDto
    {
        return new TaskDto(
            title: $this->string(self::TITLE)->toString(),
            description: $this->string(self::DESCRIPTION)->toString(),
            status: TaskStatus::from($this->string(self::STATUS)->toString()),
            employee_id: $this->integer(self::EMPLOYEE_ID),
        );
    }
}
