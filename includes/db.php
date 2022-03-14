<?php

/**
 * Create Database object
 * @return connection to db
 */
$db = new Database();
return $db->getConnection();