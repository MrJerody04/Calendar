<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>

    .mobile_login{
        display: none;
    }

    @media screen and (max-width: 992px) {
        .desktop_login {
            display: none;
        }

        .mobile_login{
            display: block;
        }

        .form-control {
            font-size: 3rem !important;
            padding: 1rem 1.75rem;
        }

        .checkbox {
            font-size: 3rem;
        }
    }

</style>
<main class="login-form" style="height: 100vh;background: #262626;color: red">
    <div class="cotainer d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="row desktop_login"
             style="background: black;padding: 40px;border-radius: 15px;box-shadow: black 0px 0px 20px 5px">
            <h1 class="text-center mb-3">Login</h1>
            <form method="POST" action="{{ route('login.custom') }}">
                @csrf
                <div class="form-group mb-3">
                    <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                           autofocus>
                </div>

                <div class="form-group mb-3">
                    <input type="password" placeholder="Password" id="password" class="form-control" name="password"
                           required>
                    @if ($errors->has('emailPassword'))
                        <span class="text-danger">{{ $errors->first('emailPassword') }}</span>
                    @endif
                </div>

                <div class="form-group mb-3">
                    <div class="checkbox" style="text-align: center">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>

                <div class="d-grid mx-auto">
                    <button type="submit" class="btn btn-dark btn-block">Přihlásit</button>
                </div>
            </form>
        </div>
        <div class="row mobile_login"
             style="background: black;padding: 40px;border-radius: 15px;box-shadow: white 0px 0px 10px;width: 100%;margin: 50px;">
            <h2 class="text-center mb-5" style="font-size: 4rem;">Login</h2>
            <form method="POST" action="{{ route('login.custom') }}">
                @csrf
                <div class="form-group mb-4">
                    <input type="text" placeholder="Email" id="email" class="form-control" name="email" required
                           autofocus>
                </div>

                <div class="form-group mb-4">
                    <input type="password" placeholder="Password" id="password" class="form-control" name="password"
                           required>
                    @if ($errors->has('emailPassword'))
                        <span class="text-danger">{{ $errors->first('emailPassword') }}</span>
                    @endif
                </div>

                <div class="form-group mb-4">
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" style="width: 3rem;height: 3rem"> Remember Me
                        </label>
                    </div>
                </div>

                <div class="d-grid mx-auto">
                    <button type="submit" class="btn btn-dark btn-block" style="font-size: 3rem">Přihlásit</button>
                </div>
            </form>
        </div>
    </div>
</main>
