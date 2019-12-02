<?php


class RequestLoginFilter {
    public static function doFilter(){
        session_start();
        $validated = $_SESSION["validated"];
        if (!isset($validated) && $validated == "YES"){
            header('Location: loginForm.php');
            exit;
        }
    }
}