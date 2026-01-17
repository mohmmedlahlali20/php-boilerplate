<?php

namespace App\Application\Services;

interface ServiceInterface
{
    /**
     * Common method to handle basic data retrieval or processing
     */
    public function execute(array $data = []);
}