<?php

namespace me\Ratelimited\Panel;

class UserManager extends Database
{
    public function getInt($name)
    {
        switch (htmlentities($name)) {
            case("SIGNUP_USERS"):
                $query = pg_query($this->database, "SELECT * FROM signups WHERE status ='Pending'");
                return pg_num_rows($query);
                break;
            case("USERS"):
                $query = pg_query($this->database, "SELECT * FROM users");
                return pg_num_rows($query);
                break;
            case("BLOCKED"):
                $query = pg_query($this->database, "SELECT * FROM users WHERE is_blocked = true");
                return pg_num_rows($query);
                break;
            case("EMAILS"):
                $query = pg_query($this->database, "SELECT * FROM mail");
                return pg_num_rows($query);
                break;
        }
    }

    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param $table The table to fetch
     * @return array table in json
     **/
    public function fetchTable($table)
    {
        switch($table) {
            case("SIGNUP_USERS"):
                $query = pg_query($this->database, "SELECT * FROM signups WHERE status = 'Pending'");
                $result = pg_fetch_all($query);
                return json_encode($result); 
                break;

            case("USERS"):
                $query = pg_query($this->database, "SELECT * FROM users");
                $result = pg_fetch_all($query);
                return json_encode($result); 
                break;

            case("BLOCKED"):
                $query = pg_query($this->database, "SELECT * FROM users WHERE is_blocked = true");
                $result = pg_fetch_all($query);
                return json_encode($result); 
                break;
            case("EMAILS"):
                $query = pg_query($this->database, "SELECT * FROM mail");
                $result = pg_fetch_all($query);
                return json_encode($result); 
                break;
    }
}
}