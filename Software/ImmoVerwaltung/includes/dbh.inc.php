<?php

$servername="localhost";
$dBusername ="propra1";
$dBpassword="FelixEduardFrancisOli.123";
$dBname="immoverwaltung";

$conn = mysqli_connect($servername,$dBusername,$dBpassword,$dBname);

if(!$conn){
    die("Connection failed!". mysqli_connect_error());
}