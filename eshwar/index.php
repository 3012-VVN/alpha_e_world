<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>LOGIN FORM</h1>
    <form action='insert.php' method='POST' enctype="multipart/form-data">
    USERNAME  <input type='text' name='username' value="" placeholder="firstname"><br><br>
    PASSWORD  <input type='text' name='password' value=""  placeholder="password"><br><br>
    MOBILE    <input type='text' name='mobile' value=""  placeholder="mobile No."><br><br>
    EMAIL     <input type='email' name='Email' value=""  placeholder="Email Address"><br><br>
    <button type="submit"  name='submit' >submit</button>
    </form>

</body>
</html>