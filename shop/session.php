<?php
    class Session {
        function __construct() {
            session_start();
            session_regenerate_id(true);
        }
    }
?>