<?php


class Todo extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getTodo()
    {
        $conn = $this->connect();
        $sqlStr = "SELECT * FROM todos ORDER BY id ASC";
        $getUsers = $conn->query($sqlStr);
        $getUsers->setFetchMode(PDO::FETCH_ASSOC);
        $users = $getUsers->fetchAll();
        $conn = null;

        return $users;
    }

    public function add($startAt, $endAt, $eventName)
    {
        $data = [
            ':start_at' => $startAt,
            ':end_at' => $endAt,
            ':event_name' => $eventName,
        ];

        try {
            $conn = $this->connect();
            $sqlStr = "INSERT INTO todos (start_at, end_at, event_name) VALUES (:start_at, :end_at, :event_name)";
            $stmt= $conn->prepare($sqlStr);
            $stmt->execute($data);
        } catch (Exception $exception) {
            return false;
        }

        return true;
    }
}