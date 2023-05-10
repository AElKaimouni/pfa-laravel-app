<div  @if($wrapper) class="login-wrapper" id="login-content" @endif >
    <div class="login-content">
        <a href="#" class="close">x</a>
        <div class="text-center" style="margin-bottom: 1em">
        <a href="/" ><img class="logo" src="/images/logo-black.svg" width="150" alt=""></a>
        </div>
        
        <h3>Login</h3>
        <form method="post" action="/login">
            @csrf <!-- {{ csrf_field() }} -->
            <div class="row">
                <label for="username">
                    Username:
                    <input type="email" name="email" id="username" placeholder="" required="required" />
                </label>
            </div>
        
            <div class="row">
                <label for="password">
                    Password:
                    <input type="password" name="password" id="password" placeholder="" required="required" />
                </label>
            </div>
            <div class="row">
                <div class="remember">
                    <div>
                        <input type="checkbox" name="remember" value="Remember me"><span>Remember me</span>
                    </div>
                    <a href="/forgot-password">Forget password ?</a>
                </div>
            </div>
            <div class="row" style="margin-bottom: 1em">
                Dont you have account ? <a href="/register">Register Now</a>.
            </div>
        <div class="row">
            <button type="submit">Login</button>

        </div>
        </form>
        <!--
        <div class="row">
            <p>Or via social</p>
            <div class="social-btn-2">
                <a class="fb" href="#"><i class="ion-social-facebook"></i>Facebook</a>
                <a class="tw" href="#"><i class="ion-social-twitter"></i>twitter</a>
            </div>
        </div>
        -->
    </div>
</div>