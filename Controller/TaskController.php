<?php

namespace CRUD_Sample\Controller;

use CRUD_Sample\Helper\TaskHelper;
use CRUD_Sample\Model\Actions;
use CRUD_Sample\Model\Task;

class TaskController
{
    public function switcher($uri, $request)
    {
        switch ($uri) {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request);
                break;
            case Actions::HISTORY:
                $this->readAction($request);
                break;
                // case Actions::READ_ALL:
                //     $this->readAllAction($request);
                //     break;
            case Actions::DELETE:
                $this->deleteAction($request);
                break;
            default:
                break;
        }
    }

    public function createAction($request)
    {
        $task = new Task();
        $task->setTitle($_POST['title']);
        $task->setDescription($_POST['description']);
        $task->setStatus($_POST['status']);

        $taskHelper = new TaskHelper();
        $taskHelper->insert($task);
        echo "tamam";
    }

    public function updateAction($request)
    {
        $task = new Task();
        $task->setTitle($_POST['title']);
        $task->setDescription($_POST['description']);
        $task->setStatus($_POST['status']);

        $taskHelper = new TaskHelper();
        $taskHelper->update($task);
    }

    public function readAction($request)
    {
        $taskHelper = new TaskHelper();
        $body = "<table>
                  <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>description</th>
                    <th>status</th>
                  </tr>";

        /** @var task $task */
        $task = $taskHelper->fetch($request['id']);
        $body = $body . "  <tr>
            <td>" . $task->getId() . "</td>
            <td>" . $task->getTitle() . "</td>
            <td>" . $task->getDescription() . "</td>
            <td>" . $task->getStatus() . "</td>
          </tr>";

        $body = $body . "</table>";
        echo $body;
    }

    // public function readAllAction($request)
    // {
    //     $taskHelper = new TaskHelper();
    //     $body = "<table>
    //               <tr>
    //                 <th>id</th>
    //                 <th>title</th>
    //                 <th>description</th>
    //                 <th>status</th>
    //               </tr>";

    //     /** @var task $task */
    //     foreach ($taskHelper->fetchAll() as $task) {
    //         $body = $body . "  <tr>
    //         <td>" . $task->getId() . "</td>
    //         <td>" . $task->getTitle() . "</td>
    //         <td>" . $task->getDescription() . "</td>
    //         <td>" . $task->getStatus() . "</td>
    //       </tr>";
    //     }
    //     $body = $body . "</table>";
    //     echo $body;
    // }

    public function deleteAction($request)
    {
        $taskHelper = new TaskHelper();
        $taskHelper->delete($request['id']);
    }
}
