<?php

class Token
{

    private $database;

    public function __construct($database)
    {
        $this->database = $database;


        function generate()
        {
            $token = bin2hex(random_bytes(8))   . "-";
            $token .= bin2hex(random_bytes(4))  . "-";
            $token .= bin2hex(random_bytes(4))  . "-";
            $token .= bin2hex(random_bytes(4))  . "-";
            $token .= bin2hex(random_bytes(12)) .   "-";

            $insert = pg_prepare(
                $database,
                "addUserToken",
                "SELECT * FROM tokens WHERE token = $1"
            );
        /* Execute PostgreSQL query */
            $tokencomparisonresult = pg_execute(
                $database,
                "fetch-token-by-token",
                $filteredToken
            );
        }

        function isValid()
        {

        }

        function exportToJson()
        {

        }

        function suspend()
        {

        }
    }
}