<?php

class Html_login {

    public function Login() {
        $html = "
        <form class='form-signin'>
            <h2 class='form-signin-heading'>Login</h2>
            <label for='email' class='sr-only'>Email</label>
            <input type='email' id='email' name='email' class='form-control' placeholder='Email address' required autofocus>
            <label for='password' class='sr-only'>Password</label>
            <input type='password' id='password' name='password' class='form-control' placeholder='Password' required>
            
            <button class='btn btn-lg btn-primary btn-block' type='submit'>ENTRA</button>
        </form>
        ";
        echo $html;
    }
}
