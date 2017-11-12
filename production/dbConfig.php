<?php
$con = new mysqli('localhost', 'root', '',"api_plaas");
if ($con->connect_errno) {
die('Could not connect: ' . $con->connect_error);
}