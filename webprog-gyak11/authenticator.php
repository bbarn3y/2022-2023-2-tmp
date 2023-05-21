<?php

include 'util.php';


class UserStorage {

    // @note The password is password
    function findUser($username, $password): array {
        return array_filter($this->getUsers(), fn($user) => $user['username'] == $username && $user['password'] == md5($password));
    }

    function getUsers(): array {
        return json_decode(file_get_contents('users.json'), true);
    }
}

function check_user($user_storage, $username, $password) {
    $user = $user_storage->findUser($username, $password);
    return count($user) == 1 ? array_shift($user) : NULL;
}

function login($user) {
    session_start();
    $_SESSION['user'] = $user;
}

$userStorage = new UserStorage();
$data = [];
if ($_POST && $_POST['username'] != null && $_POST['password'] != null) {
    $user = check_user($userStorage, $_POST['username'], $_POST['password']);
    if ($user) {
        login($user);
        redirect('authenticated.php');
    } else {
        redirect('login.php');
    }
}
