<?php

namespace App\Interfaces;

use App\Http\Requests\TaskRequest;
use App\Http\Requests\UpdateTaskRequest;

interface TaskInterface
{
    public function index($paginationDetails);
    public function store(TaskRequest $taskDetails);
    public function show($id);
    public function update(UpdateTaskRequest $taskDetails, $id);
    public function destroy($id);
}
