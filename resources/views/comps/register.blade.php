<div @if($wrapper) class="login-wrapper"  id="signup-content" @endif>
    <div class="login-content">
        <a href="#" class="close">x</a>
        <h3>sign up</h3>
        <form method="post" action="/register">
            @csrf <!-- {{ csrf_field() }} -->

            <div class="row">
                <label for="username-2">
                    Username:
                    <input type="text" name="name" id="username-2" placeholder="" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{8,20}$" required="required" />
                </label>
            </div>
        
            <div class="row">
                <label for="email-2">
                    your email:
                    <input type="email" name="email" id="email-2" placeholder="" required="required" />
                </label>
            </div>
            <div class="row">
                <label for="password-2">
                    Password:
                    <input type="password" name="password" id="password-2" placeholder="" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" />
                </label>
            </div>
            <div class="row">
                <label for="repassword-2">
                    re-type Password:
                    <input type="password" name="password" id="repassword-2" placeholder="" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required="required" />
                </label>
            </div>
        <div class="row">
            <button type="submit">sign up</button>
        </div>
        </form>
    </div>
</div>