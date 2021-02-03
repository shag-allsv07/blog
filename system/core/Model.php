<?php


namespace system\core;


class Model
{
    protected $db;
    protected $table;

    public function __construct()
    {
        $this->db = DB::instance();
    }
}