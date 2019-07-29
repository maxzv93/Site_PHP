<?php


namespace App\Services;


class TestService
{
    private $kurs=60;
    public function convert($rub)
    {
        return $rub/$this->kurs;
    }
}