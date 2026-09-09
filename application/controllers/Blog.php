<?php

class Blog extends CI_Controller{
    public function index($name, $blood_type, $address) {
        echo "Nama : $name <br>";
        echo "Golongan darah : $blood_type <br>";
        echo "Alamat : $address <br>";
    }
}