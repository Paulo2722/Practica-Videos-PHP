<?php
include("../../Core/Database.php");
$sql = "delete token from tokens where user_id is not null";

$result = $this->connection->query($sql);

$data = [];

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

