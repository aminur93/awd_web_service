<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Change Password</title>
</head>
<body>
<table>

    <tr>
        <td>
            Your Password reset Link. Please click link on reset password text<br>
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>
            @if(isset($token))
                <a href="http://localhost:8080/reset_password/<?= $token; ?>">Reset Password</a>
            @endif
        </td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>

    <tr>
        Thanks & Regards<br>
        Develop Team BARC
    </tr>
</table>
</body>
</html>
