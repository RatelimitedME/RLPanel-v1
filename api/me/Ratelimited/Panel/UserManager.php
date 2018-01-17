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
}
