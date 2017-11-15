<?php

class Html_login {

    public function Login() {
        $html = "
        <form class='form-signin'>
            <h2 class='form-signin-heading'>Login</h2>
            <label for='inputEmail' class='sr-only'>Email</label>
            <input type='email' id='inputEmail' class='form-control' placeholder='Email address' required autofocus>
            <label for='inputPassword' class='sr-only'>Password</label>
            <input type='password' id='inputPassword' class='form-control' placeholder='Password' required>
            
            <button class='btn btn-lg btn-primary btn-block' type='submit'>ENTRA</button>
        </form>
        ";
        echo $html;
    }
}


/*

 */