<?php

function logout_user()
{
    session_start();
    
    if (isset($_SESSION['user'])) {
        session_unset();
        session_destroy();
    }
}
