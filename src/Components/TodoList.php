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

  #[LiveProp(writable: true)]
  public string $newTask = '';

  public $task;

  public $form;

  private TaskRepository $taskRepository;

  public function __construct(TaskRepository $taskRepository)
  {
      $this->taskRepository = $taskRepository;
  }

  public function getTasks(): array
  {
    return $this->taskRepository->findAll();
  }
}
