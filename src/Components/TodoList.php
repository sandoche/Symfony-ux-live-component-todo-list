<?php

namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use App\Repository\TaskRepository;


#[AsLiveComponent('todo_list')]
class TodoList
{
  use DefaultActionTrait;

  public $task;

  public $form;

  private $tasks;

  private TaskRepository $taskRepository;

  public function __construct(TaskRepository $taskRepository)
  {
    $this->taskRepository = $taskRepository;
  }

  public function getTasks(): array
  {
    $this->loadTasks();
    return $this->tasks;
  }

  private function loadTasks()
  {
    $this->tasks = $this->taskRepository->findAll();
  }
}
