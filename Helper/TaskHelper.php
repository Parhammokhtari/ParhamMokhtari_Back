<?php

namespace CRUD_Sample\Helper;

use CRUD_Sample\Model\Task;

class TaskHelper
{
    public function insert(Task $task)
    {
        /** @var DBConnector $dbHelper */

        $dbHelper = new DBConnector();

        $dbHelper->connect();
        $sql = "INSERT INTO task (title, description, status ) VALUES ('" . $task->getTitle() . "', '" . $task->getDescription() . "', '" . $task->getStatus() . "')";

        // $res = $dbHelper->execQuery($sql);
        if ($dbHelper->execQuery($sql)) {
            echo "task added successfully";
            // $last_Id = $res->insert;
            // echo $last_Id;
            $sql3 = "INSERT INTO history (task_id,title, description, status ) VALUES ( LAST_INSERT_ID() ,'" . $task->getTitle() . "', '" . $task->getDescription() . "', '" . $task->getStatus() . "')";
            if ($dbHelper->execQuery($sql3)) {
                echo "task added successfully to history1";
            }
        } else {
            echo "An Error Occurred";
        }
    }

    public function fetch(int $id)
    {
        $task = new Task();
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $result = $dbHelper->execQuery("SELECT * FROM task WHERE id =" . $id);
        $row = $result->fetch_all(MYSQLI_ASSOC);
        $task->setId($row[0]['id']);
        $task->setTitle($row[0]['title']);
        $task->setDescription($row[0]['description']);
        $task->setStatus($row[0]['status']);

        return $task;
    }
    public function fetchHistory($taskId)
    {






        $tasks = array();
        $tasks['history'] = array();
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $result = $dbHelper->execQuery("SELECT * FROM history where task_id=$taskId");
        // $rows = $result->fetch_all(MYSQLI_ASSOC);
        if ($result) {
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_array()) {
                    extract($data);
                    $task = array(
                        'task_id' => $taskId,
                        'title' => $title,
                        'description' => $description,
                        'status' => $status

                    );
                    array_push($tasks['history'], $task);
                }
                echo json_encode($tasks);
            } else
                echo json_encode($tasks);
        } else
            echo json_encode($tasks);
    }

    public function fetchAll()
    {






        $tasks = array();
        $tasks['data'] = array();
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $result = $dbHelper->execQuery("SELECT * FROM task ");
        // $rows = $result->fetch_all(MYSQLI_ASSOC);
        if ($result) {
            if ($result->num_rows > 0) {
                while ($data = $result->fetch_array()) {
                    extract($data);
                    $task = array(
                        'id' => $id,
                        'title' => $title,
                        'description' => $description,
                        'status' => $status

                    );
                    array_push($tasks['data'], $task);
                }
                echo json_encode($tasks);
            } else
                echo json_encode($tasks);
        } else
            echo json_encode($tasks);
    }

    public function update(task $task)
    {
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $sql = "UPDATE task SET title = '" . $task->getTitle() . "', description = '" . $task->getDescription() .  "', status = '" . $task->getStatus() . "' WHERE id = '" . $task->getId() . "'";
        $sql2 = "INSERT INTO history (task_id,title, description, status ) VALUES ('" . $task->getId() . "','" . $task->getTitle() . "', '" . $task->getDescription() . "', '" . $task->getStatus() . "')";

        if ($dbHelper->execQuery($sql) && $dbHelper->execQuery($sql2)) {
            echo "task updated successfully";
        } else {
            echo "An Error Occurred";
        }
    }


    public function delete($id)
    {
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $sql = "DELETE FROM task WHERE id = '" . $id . "'";
        if ($dbHelper->execQuery($sql)) {
            echo "task deleted successfully";
        } else {
            echo "An Error Occurred";
        }
    }
}
