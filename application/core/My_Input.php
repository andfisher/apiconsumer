<?php

class My_Input extends CI_Input
{
    public function stream(): array
    {
        return (array) json_decode(file_get_contents('php://input'));
    }
}