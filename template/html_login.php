<?php

class Html_login {

    public function Login($csrf, $csrfname) {
        // onkeydown='if (event.keyCode == 13) { formhash(this.form, this.form.password); this.form.submit(); return false; }'
        // onclick='formhash(this.form, this.form.password);'
        $html = "
        <form class='form-signin' name='login_form' onsubmit='formhash(this.form, this.form.password);'>
            <h2 class='form-signin-heading'>Login</h2>
            <label for='email' class='sr-only'>Email</label>
            <input type='email' id='email' name='email' class='form-control' placeholder='Email address' required autofocus>
            <label for='password' class='sr-only'>Password</label>
            <input type='password' id='password' name='password' class='form-control' placeholder='Password' required>
            <input type='hidden' name='$csrfname' value='$csrf'>
            <button class='btn btn-lg btn-primary btn-block' type='submit'>ENTRA</button>
        </form>
        ";
        echo $html;
    }

    public function errors($notices) {
        $html = "<div class='form-signin'>";
        echo $html;

        foreach ($notices as $not) {
            echo $not."<br>";
        }

        $html = "</div>";
        echo $html;
    }

    public function CaricaJS($file) {
        $html = "
            <script src='js/script_$file.js'></script>
        ";
        echo $html;
    }
}
