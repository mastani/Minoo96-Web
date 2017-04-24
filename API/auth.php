<?php
require_once 'loader.php';

$now = date('Y-m-d H:i:s');

$json = new stdClass();
$json->success = false;
$json->time = date('Y-m-d G:i:s');

$error = false;

$fail = $model->query('SELECT * FROM failed_login WHERE ip = ?', array('s', get_user_ip()));
if (count($fail) > 0) {
    $fail = $fail[0];
    $fail_date = new DateTime($fail['date'], new DateTimeZone('Asia/Tehran'));
    $fail_diff = $fail_date->diff(new DateTime("now", new DateTimeZone('Asia/Tehran')));
    $diff = $fail_diff->format('%d');
    if ($diff >= 3) {
        $model->query(
            'DELETE FROM failed_login WHERE ip = ?',
            array('s', get_user_ip())
        );
    } else if ($fail['count'] >= 50) {
        $error = true;
    }
}

if (!isset($_POST['mobile-email']) ||
    !isset($_POST['password'])
) {
    $error = true;
}

if (!$error) {
    if (empty($_POST['mobile-email']))
        $error = true;
    if (empty($_POST['password']))
        $error = true;
}

if (!$error) {
    $email_mobile = $_POST['mobile-email'];
    $password = $_POST['password'];

    $password = sha1($password);
    $login = $model->query('SELECT * FROM users WHERE (mobile = ? OR email = ?) AND password = ?', array('sss', $email_mobile, $email_mobile, $password));
    if (count($login) > 0) {
        $sessid = 'sess_' . generateRandomString(12);
        $user_id = $login[0]['id'];
        $expire = date('Y-m-d H:i:s', strtotime($now . ' +90 days'));
        $res = $model->query(
            'INSERT INTO app_auth (sess_id, user_id, log_date, expire_date) VALUES (?, ?, ?, ?)',
            array('ssss', $sessid, $user_id, $now, $expire),
            true
        );

        $json->success = true;
        $json->sessid = $sessid;
        unset($login[0]['password']);
        $json->user = $login;
    } else {
        $model->query(
            'INSERT INTO failed_login (ip, count) VALUES (?, 1) ON DUPLICATE KEY UPDATE count = count + 1',
            array('s', get_user_ip()),
            true
        );
    }
}

echo json_encode($json);

function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}