<?php

function check_confirm_password ($password, $confirm_password) {
    if (strcmp($password, $confirm_password) == 0) {
        return true;
    }
    else {
        return false;
    }
}