<!DOCTYPE html>
<html>

<head>
    <title>Task Assignment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .content {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
        }

        .info-row {
            margin-bottom: 10px;
        }

        .label {
            font-weight: bold;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 0.9em;
            color: white;
            background-color: #6c757d;
        }

        .status-pending {
            background-color: #ffc107;
        }

        .status-in_progress {
            background-color: #17a2b8;
        }

        .status-completed {
            background-color: #28a745;
        }

        .footer {
            margin-top: 20px;
            font-size: 0.9em;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="header">
        <h2>{{ $title }}</h2>
    </div>

    <div class="content">
        <div class="info-row">
            <span class="label">Task Title:</span>
            <span>{{ $task->title }}</span>
        </div>

        <div class="info-row">
            <span class="label">Description:</span>
            <p>{{ $task->description }}</p>
        </div>

        <div class="info-row">
            <span class="label">Status:</span>
            <span class="status status-{{ $task->status }}">{{ str_replace('_', ' ', ucfirst($task->status)) }}</span>
        </div>

        @if ($isReassignment)
            <div class="info-row">
                <span class="label">Previously Assigned To:</span>
                <span>{{ $previousEmployee->name }}</span>
            </div>
        @endif

        <div class="info-row">
            <span class="label">Assigned To:</span>
            <span>{{ $task->employee->name }}</span>
        </div>

        <div class="info-row">
            <span class="label">Date:</span>
            <span>{{ $task->updated_at->format('F j, Y, g:i a') }}</span>
        </div>
    </div>

    <div class="footer">
        <p>This is an automated message from the Task Management System. Please do not reply to this email.</p>
    </div>
</body>

</html>
