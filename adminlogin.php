<html>
    <body>
    <script>
    </script>
    <h1>Admin Dashboard</h1>
    <p>Login to the dashboard by providing details:</p>
    
    <form action="/login" method="POST">
        Username: <input type=text name=user_name id="user_name" required>
        <br/><br/>
        Password: <input type=password name=password id="password" minlength=6 required>
        <br><br/>
        <input type="submit" value="Login" name="submit" id="loginButton"/>
    </form>

    <form action="/register">
        <input type="submit" value="Register" name="submit" id="registerButton"/>
    </form>
    </body>
</html>