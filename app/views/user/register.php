<div class="auth-container">
    <div class="form-container">
        <h1>Qrangga</h1>
        <h4>Belum punya akun? Silakan daftar akun dulu.</h4>

            <form action="<?= URLROOT ?>/user/register" method='post'>
                <div class="input-auth">
                    <input type="text" name="username" id="username" autocomplete='off' required placeholder='username'>               
                    <span class='inv-msg'><?= $data['errorUsername'] ?></span>
                </div>

                <div class="input-auth">
                    <input type="email" name="email" id="email" autocomplete='off' required placeholder='e-mail'>
                    <span class='inv-msg'><?= $data['errorEmail']?></span>
                </div>

                <div class="input-auth">
                    <input type="text" name="password" id="password" autocomplete='off' required placeholder='password'>
                    <span class='inv-msg'><?= $data['errorPassword']?></span>
                </div>

                <div class="input-auth">
                    <input type="text" name="confirmpassword" id="confirmpassword" autocomplete='off' required placeholder='confirm password'>
                    <span class='inv-msg'><?= $data['errorConfirmpassword']?></span>
                </div>

                <div class="checkbox">
                    <input class='checkbox' type="checkbox" name="agree" id="agree">
                    <p>saya setuju dengan syarat dan kebijakan privasi</p>
                </div>
                <button class='inp-btn' type="submit" name='submit'>Daftar</button>
            </form>

        <p>Sudah punya akun? silakan klik <a href="<?= URLROOT ?>/user/login">masuk</a></p>
    </div>
    <div></div>
    <div></div>
</div>