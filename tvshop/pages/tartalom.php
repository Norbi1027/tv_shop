<?php

switch ($menu) {
    case 'kilepes':
        require_once './pages/kilepes.php';
        break;
    case 'login':
        require_once './pages/login.php';
        break;
    case 'registracio':
        require_once './pages/registracio.php';
        break;
    case 'home':
        require_once './pages/home.php';
        break;
    case 'termekek':
        require_once './pages/termekek.php';
        break;
        case 'termekekGuest':
        require_once './pages/termekekGuest.php';
        break;
    case 'rolunk':
        require_once './pages/rolunk.php';
        break;
    default:
        require_once './index.php';
        break;
}