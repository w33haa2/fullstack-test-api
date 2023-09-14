<?php

namespace App\Repositories;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Interfaces\TaskInterface;
use App\Models\Task;

class TaskRepository implements TaskInterface
{
    public function index($paginationDetails)
    {
        $queryParams = $paginationDetails->only([
            'limit',
            'search',
        ]);
        $title = $queryParams['search'] ?? '';
        return Task::where([
            ['title', 'LIKE', '%'. $title .'%'],
            ['user_id', '=', auth('sanctum')->user()->id],
        ])->paginate($queryParams['limit']);

    }

    public function store(TaskRequest $taskDetails)
    {
        return Task::create($taskDetails->all());
    }

    public function show($id)
    {
        return Task::where([
            ['id', '=', $id],
            ['user_id', '=', auth('sanctum')->user()->id],
        ])->firstOrFail();
    }

    public function update(UpdateTaskRequest  $taskDetails, $id)
    {

        $task = Task::where([
            ['id', '=', $id],
            ['user_id', '=', auth('sanctum')->user()->id],
        ])->firstOrFail();
        $task->update($taskDetails->all());
        return $task;

        // TODO: Implement update() method.
    }

    public function destroy($id)
    {
       $task = Task::where([
           ['id', '=', $id],
           ['user_id', '=', auth('sanctum')->user()->id],
       ])->firstOrFail();
       $task->destroy($id);
       return $task;
    }
}
