<?php

include("../../Core/Database.php");
$sql = "select * from users insert into users(number) values(123456789)";

$result = $this->connection->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
