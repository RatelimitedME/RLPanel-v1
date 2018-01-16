<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * The base class that defines database credentials, used by
 * every other object in the application.
 *
 * PHP version 5
 *
 * @category  Authentication
 * @package   me\Ratelimited\Panel
 * @author    Samuel Simão <samuel@pomaire.com.br>
 * @copyright 2017-2018 RATELIMITED, LLC
 * @license   Copyright - All rights reserved
 * @version   GIT: <git_id>
 * @link      https://ratelimited.me
 * @see       PDO
 * @since     File available since RLPanel 0.1
 */

namespace me\Ratelimited\Panel;

/**
 * Token Class Doc Comment
 *
 * @category Class
 * @package  me\Ratelimited\Panel
 * @author   Samuel Simão <samuel@pomaire.com.br>
 * @license  Copyright - All rights reserved
 * @link     https:/ratelimited.me
 */

class Database
{

    /**
     * Database object
     *
     * @var mixed
     */
    protected $database;

    /**
     * Create database object with the
     * default credentials, and pass it
     * to class->db.
     *
     * @access public
     * @static
     * @see    pg_*
     * @since  Method available since RLPanel Light 0.1
     */
    public function __construct()
    {

        // Create connection
        $database = pg_Connect("host=localhost dbname=samuelsimao user=samuelsimao");

        // Add to class variable
        $this->database = $database;

        return true;
    }
}