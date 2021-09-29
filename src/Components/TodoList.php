<?php

namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use App\Repository\TaskRepository;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\LiveAction;

#[AsLiveComponent('todo_list')]
class TodoList
{
  use DefaultActionTrait;

  public $task;

  public $form;

  private $tasks;

  #[LiveProp(writable: true)]
  public $filter;

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
    if ($this->filter == 'all') {
      $this->tasks = $this->taskRepository->findAll();
    } else {
      $this->tasks = $this->taskRepository->findBy(
        ['isDone' => $this->filter == 'done' ? true : false]
      );
    }
  }
}
