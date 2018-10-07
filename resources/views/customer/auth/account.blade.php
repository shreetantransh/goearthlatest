<div class="container login-fancy">
    <div class="row register">
        <div class="col-12 col-md-12 col-sm-12 col-lg-12 mobile-padding">
            <div class="form-area">

                <div class="col-md-12 col-sm-12 col-xs-12 box" id="login-form-container">
                    <div class="commontop text-left">
                        <h4 class="text-center">
                            <i class="icon_star_alt"></i>
                            <i class="icon_star_alt"></i>
                            <i class="icon_star_alt"></i>
                            Sign in
                            <i class="icon_star_alt"></i>
                            <i class="icon_star_alt"></i>
                            <i class="icon_star_alt"></i>
                        </h4>
                    </div>
                    <p>Hello, Welcome to your account</p>
                    <ul class="list-inline">
                        <li>
                            <a href="https://www.facebook.com/" target="_blank">
                                <i class="social_facebook"></i> Facebook
                            </a>
                        </li>
                        <li>
                            <a href="https://plus.google.com/" target="_blank">
                                <i class="social_googleplus"></i> Google +
                            </a>
                        </li>
                    </ul>
                    <form id="login-form" onsubmit="return false;">

                        @foreach ($responseHandlerFields as $fieldName => $fieldValue)
                            <input type="hidden" name="{{ $fieldName }}" value="{{ $fieldValue }}"/>
                        @endforeach

                        <div class="form-group">
                            <label for="email" class="text-uppercase">Email address *</label>
                            <input type="email" class="form-control form-control-sm" id="email" name="email"/>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-uppercase">Password</label>
                            <input type="password" name="password" class="form-control form-control-sm"
                                   id="password"/>
                        </div>
                        <div class="links">
                            <input class="checkclass checkbox-inline" type="checkbox" name="remember">Remember Me!
                            <a href="" class="pull-right">Forgot your account?</a>
                        </div>

                        <button type="submit" class="btn btn-primary">SIGN IN</button>
                        <a href="javascript:void(0)" class="pull-right register-button" id="register_button">Register Now</a>
                    </form>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12" id="registration-form-container" style="display: none">
                    <div class="commontop text-left">
                        <h4>
                            <i class="icon_star_alt"></i>
                            <i class="icon_star_alt"></i>
                            <i class="icon_star_alt"></i>
                            Create account
                            <i class="icon_star_alt"></i>
                            <i class="icon_star_alt"></i>
                            <i class="icon_star_alt"></i>
                        </h4>
                    </div>
                    <p>Create your new account</p>
                    <form id='register-form' onsubmit="return false;">

                        @foreach ($responseHandlerFields as $fieldName => $fieldValue)
                            <input type="hidden" name="{{ $fieldName }}" value="{{ $fieldValue }}"/>
                        @endforeach

                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group form-group-sm">

                                    <label for="first_name">First Name</label>
                                    <input name="first_name" type="text" class="form-control form-control-sm"
                                           id="first_name"/>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group form-group-sm">
                                    <label for="last_name">Last Name</label>
                                    <input name="last_name" type="text" class="form-control form-control-sm"
                                           id="last_name"/>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group form-group-sm">
                                    <label for="mobile">Mobile No.</label>
                                    <input type="text" name="mobile" class="form-control form-control-sm" id="mobile"/>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="form-group form-group-sm">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control form-control-sm"
                                           id="email"/>
                                </div>
                            </div>
                        </div>


                        <div class="form-group form-group-sm">
                            <label for="password">Password</label>
                            <input type="password" name="password" class="form-control form-control-sm"
                                   id="password"/>
                        </div>
                        <button type="submit" class="btn btn-primary">SIGN up</button>

                        <div class="links">
                            <a href="javascript:void(0)" id="already_register">Already Registered?</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

<script type='text/javascript'>
    new CustomerAuth();
</script>

