<?php

namespace App\Components;

use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;

#[AsLiveComponent('create_task_form')]
class CreateTaskForm extends AbstractController
{
    use ComponentWithFormTrait;

    /**
     * The initial data used to create the form.
     *
     * Needed so the same form can be re-created
     * when the component is re-rendered via Ajax.
     *
     * The `fieldName` option is needed in this situation because
     * the form renders fields with names like `name="post[title]"`.
     * We set `fieldName: ''` so that this live prop doesn't collide
     * with that data. The value - initialFormData - could be anything.
     */
    #[LiveProp(fieldName: 'initialFormData', dehydrateWith: 'dehydrateTask')]
    public ?Task $task = null;

    /**
     * Used to re-create the PostType form for re-rendering.
     */
    protected function instantiateForm(): FormInterface
    {
        // we can extend AbstractController to get the normal shortcuts
        return $this->createForm(TaskType::class, $this->task);
    }

    function dehydrateTask()
    {
        $this->task = new Task();
    }

    #[LiveAction]
    function save()
    {
        // shortcut to submit the form with form values
        // if any validation fails, an exception is thrown automatically
        // and the component will be re-rendered with the form errors
        $this->submitForm();

        /** @var Task $task */
        $task = $this->getFormInstance()->getData();
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($task);
        $entityManager->flush();

        $this->addFlash('success', 'Post saved!');
    }
}
