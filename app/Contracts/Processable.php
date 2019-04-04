<?php
namespace App\Contracts;

interface Processable
{
    public function process(array $data) : array;
}
