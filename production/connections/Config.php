<?php
$con = new mysqli('localhost', 'root', '',"plaas_data");
if ($con->connect_errno) {
die('Could not connect: ' . $con->connect_error);
}