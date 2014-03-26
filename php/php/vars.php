<?php
    function get_env_or_fail($env_var) {
        if ($var = getenv($env_var)) {
            return $var;
        }
        die("Environment variable '$env_var' not set");
    }
 
    $API_KEY_MANDRILL = get_env_or_fail("API_KEY_MANDRILL");