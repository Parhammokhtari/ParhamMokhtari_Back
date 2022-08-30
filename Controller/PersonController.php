<?php

namespace CRUD_Sample\Controller;



use CRUD_Sample\Helper\PersonHelper;
use CRUD_Sample\Model\Actions;
use CRUD_Sample\Model\Person;
use CRUD_Sample\Helper\TaskHelper;
use CRUD_Sample\Model\Task;

include("Model/Task.php");
include("Helper/TaskHelper.php");

class PersonController
{
    public function switcher($uri, $request)
    {
        switch ($uri) {
            case Actions::CREATEUSER:
                $this->createPerson($request);
                break;
            case Actions::VALIDATION:
                $this->validation($request);
                break;
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request);
                break;
            case Actions::HISTORY:
                $this->seeHistory($request);
                break;
            case Actions::READ_ALL:
                $this->readAllAction($request);
                break;
            case Actions::DELETE:
                $this->deleteAction($request);
                break;
            default:
                break;
        }
    }

    public function createPerson($request)
    {
        echo "parhaam";
        $person = new Person();
        $person->setFirstName($_POST['firstName']);
        $person->setLastName($_POST['lastName']);
        $person->setUsername($_POST['username']);
        $person->setPassword($_POST['password']);
        $person->setRole(0);
        $personHelper = new PersonHelper();
        $personHelper->insert($person);
    }
    public function createAction($request)
    {
        echo ("mobiin");
        $task = new Task();
        $task->setTitle($_POST['title']);
        $task->setDescription($_POST['description']);
        $task->setStatus($_POST['status']);

        $taskHelper = new TaskHelper();
        $taskHelper->insert($task);
        // $taskHelper->addhistory($task);
    }

    public function updateAction($request)
    {
        $task = new Task();
        $task->setTitle($_POST['title']);
        $task->setDescription($_POST['description']);
        $task->setStatus($_POST['status']);
        $task->setId($_POST['id']);
        $taskHelper = new TaskHelper();
        $taskHelper->update($task);
    }

    public function seeHistory($request)
    {
        $taskHelper = new TaskHelper();
        $taskHelper->fetchHistory($request['id']);
    }

    public function validation($request)
    {

        $personHelper = new personHelper();


        $personHelper->fetch($request['username'], $request['password']);
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

    public function readAllAction($request)
    {
        $taskHelper = new TaskHelper();
        $taskHelper->fetchAll();
    }

    public function deleteAction($request)
    {
        $taskHelper = new TaskHelper();
        $taskHelper->delete($request['id']);
    }
}
