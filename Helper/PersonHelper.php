<?php

namespace CRUD_Sample\Helper;

use CRUD_Sample\Model\Person;

class PersonHelper
{
    public function insert(Person $person)
    {
        /** @var DBConnector $dbHelper */

        $dbHelper = new DBConnector();

        $dbHelper->connect();
        $sql = "INSERT INTO person (first_name, last_name, username , password, role) VALUES ('" . $person->getFirstName() . "', '" . $person->getLastName() . "', '" . $person->getUsername() . "','" . $person->getPassword() . "','" . $person->getRole() . "')";
        if ($dbHelper->execQuery($sql)) {
            echo "Record added successfully";
        } else {
            echo "An Error Occurred";
        }
    }

    public function fetch(string $username, string $password)
    {
        $persons = array();
        $persons['person'] = array();
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $result = $dbHelper->execQuery("SELECT * FROM person WHERE username ='$username' and password='$password'");
        // $row = $result->fetch_all(MYSQLI_ASSOC);

        if ($result->num_rows > 0) {
            while ($data = $result->fetch_array()) {
                extract($data);
                $person = array(
                    'id' => $id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'username' => $username,
                    'password' => $password,
                    'role' => $role

                );
                array_push($persons['person'], $person);
            }
            echo json_encode($persons);
        } else {
            http_response_code(401);
            // echo "user not valid";
            // echo json_encode($persons);
        }
    }

    // if (count($row) > 0) {
    //     echo "parham";
    //     $person->setId($row[0]['id']);
    //     $person->setUsername($row[0]['username']);
    //     $person->setPassword($row[0]['password']);
    //     $person->setFirstName($row[0]['first_name']);
    //     $person->setLastName($row[0]['last_name']);
    // }


    // return $person;



    public function fetchAll()
    {
        $persons = [];
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $result = $dbHelper->execQuery("SELECT * FROM person ORDER BY ID");
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        foreach ($rows as $row) {
            $person = new Person();
            $person->setId($row['id']);
            $person->setUsername($row['username']);
            $person->setFirstName($row['first_name']);
            $person->setLastName($row['last_name']);
            $persons[] = $person;
        }
        return $persons;
    }

    public function update(Person $person)
    {
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $sql = "UPDATE person SET first_name = '" . $person->getFirstName() . "', last_name = '" . $person->getLastName() . "' WHERE username = '" . $person->getUsername() . "'";
        if ($dbHelper->execQuery($sql)) {
            echo "Record updated successfully";
        } else {
            echo "An Error Occurred";
        }
    }

    public function delete($username)
    {
        /** @var DBConnector $dbHelper */
        $dbHelper = new DBConnector();
        $dbHelper->connect();
        $sql = "DELETE FROM person WHERE username = '" . $username . "'";
        if ($dbHelper->execQuery($sql)) {
            echo "Record deleted successfully";
        } else {
            echo "An Error Occurred";
        }
    }
}
