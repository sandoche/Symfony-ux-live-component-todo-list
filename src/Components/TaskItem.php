<?php

namespace App\Components;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Psr\Log\LoggerInterface;
use App\Repository\TaskRepository;


#[AsLiveComponent('task_item')]
class TaskItem extends AbstractController
{
  use DefaultActionTrait;

  #[LiveProp]
  public $task;

  public function __construct(TaskRepository $taskRepository)
  {
    $this->taskRepository = $taskRepository;
  }

  #[LiveAction]
  public function toggleDone(LoggerInterface $logger)
  {
    /** @var Task $task */
    $taskId = (int) $this->task;
    $task = $this->taskRepository->findOneById($taskId);
    $this->task = $task;
    $entityManager = $this->getDoctrine()->getManager();
    $task->setIsDone(!$task->getIsDone());
    $entityManager->persist($task);
    $entityManager->flush();

    $this->addFlash('success', 'Task marked as done');
  }
}
