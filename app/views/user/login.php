<div class="auth-container">
    <div class="form-container">
        <h1>Qrangga</h1>
        <h4>Silakan masukkan e-mail dan password untuk masuk.</h4>

        
            <form action="<?= URLROOT ?>/user/login" method='post'>

                <div class="input-auth">
                    <input type="text" name="username" id="username" autocomplete='off' >
                    <label for="username">username</label>
                    <br>               
                    <span class='inv-msg'><?= $data['errorUsernameLogin'] ?></span>
                </div>

                <div class="input-auth">
                    <input type="text" name="password" id="password" autocomplete='off' >
                    <label for="password">password</label>
                    <br>
                    <span class='inv-msg'><?= $data['errorPasswordLogin']?></span>
                </div>

                <button class='inp-btn' type="submit" name='submit'>Masuk</button>
            </form>
            
        <p>Belum punya akun? silakan klik <a href="<?= URLROOT ?>/user/register">daftar</a></p>
    </div>
    <div></div>
</div>