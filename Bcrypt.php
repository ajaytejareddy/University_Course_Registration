<?php
/**
 * This code will benchmark your server to determine how high of a cost you can
 * afford. You want to set the highest cost that you can without slowing down
 * you server too much. 8-10 is a good baseline, and more is good if your servers
 * are fast enough. The code below aims for ≤ 50 milliseconds stretching time,
 * which is a good baseline for systems handling interactive logins.
 */
$pwd = password_hash("Ajay@1998", PASSWORD_DEFAULT);
$verify = password_verify("Ajay@1998", $pwd);

echo $pwd."\n";
if ($verify) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>