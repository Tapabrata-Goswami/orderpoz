
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{('Panel | Login')}}</title>

  <link rel="shortcut icon" href="{{asset("back-end/assets/company/favicon.png")}}">

  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&amp;display=swap" rel="stylesheet">

  <link rel="stylesheet" href="{{asset('back-end/assets')}}/back-end/css/vendor.min.css">
  <link rel="stylesheet" href="{{asset('back-end/assets')}}/back-end/vendor/icon-set/style.css">

  <link rel="stylesheet" href="{{asset('back-end/assets')}}/back-end/css/theme.minc619.css?v=1.0">
  <link rel="stylesheet" href="{{asset('back-end/assets')}}/back-end/css/toastr.css">
  <script src="https://www.google.com/recaptcha/api.js" async defer></script>
  <style>
    .login-card {
      /*display: flex;*/
      /*align-items: center;*/
      /*justify-content: center;*/
      width: 100%;
      height: auto;
    }

    .login-card div {
    }

    .center-element {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .input-field {
      border-width: 0;
      border: none;
      background-color: #FFFFFF;
      border-width: 0;
      box-shadow: none;
      border-bottom: 1px solid darkgrey;
    }

    .sign-in-button {
      background-color: #8AC642;
      width: 150px;
      height: 4.5vh;
      border-radius: 20px;
      color:#ffffff;

    }

    @media  only screen and (min-width: 768px) {
      .text-div {
        border-radius: 15px 0 0 15px;
        background-color: #EF3F3E;
      }

      .form-div {
        border-radius: 0 15px 15px 0;
        background-color: #FFFFFF;
      }

      .header-text {
        font-size: 30px;
        font-weight: bold
      }

      .container-div {
        /*width: 50vw;*/
        height: 60vh;
      }
    }

    @media  only screen and (max-width: 768px) {
      .text-div {
        border-radius: 15px 15px 0 0;
        background-color: #EF3F3E;
      }

      .form-div {
        border-radius: 0 0 15px 15px;
        background-color: #FFFFFF;
      }

      .header-text {
        font-size: 25px;
        font-weight: bold
      }
    }

/* for captcha */
.input-icons i {
  position: absolute;
  cursor: pointer;
}

.input-icons {
  width: 100%;
  margin-bottom: 10px;
}

.icon {
  padding: 9% 0 0 0;
  min-width: 40px;
}

.input-field {
  width: 100%;
  padding: 10px 0 10px 10px;
  text-align: center;
  border-right-style: none;
}
</style>
</head>
<body>

  <main id="content" role="main" class="main" style="height:100vh; display: flex; flex-direction: column; justify-content: center;">
    <div class="position-fixed top-0 right-0 left-0 bg-img-hero" style="height: 100%; background-image: url({{asset('back-end/assets')}}/company/login-background.png); opacity: 0.5">
    </div>

    <div class="container py-5 py-sm-7">

      <div class="center-element" style="/*margin-top: 10%*/">
        <div class="row px-1 container-div">
          <div class="col-12 text-div col-md-6 center-element py-4" style="box-shadow: 0 6px 12px rgb(140 152 164 / 50%);">
            <div class="text-center">
              <h1 class="text-white text-uppercase header-text">Welcome to ORDEPOZ</h1>
              <hr class="bg-white" style="width: 40%">
              <div class="text-white text-uppercase">
                <span style="width: 54%;display: inline-block">
                  ORDEPOZ is a secured and user-friendly digital restaurant order booking app
                </span>
              </div>
            </div>
          </div>
          <div class="col-12 form-div col-md-6 center-element py-4" style="box-shadow: 0 6px 12px rgb(140 152 164 / 50%);">

            <form class="" action="{{route('panel.auth.submit')}}" method="post" id="form-id">
              <a class="d-flex justify-content-center mb-3" href="javascript:">
              @php($e_commerce_logo=\App\Models\BusinessSetting::where(['type'=>'company_web_logo'])->first()->value)
                  <img class="z-index-2" src="{{asset("back-end/assets/company/".$e_commerce_logo)}}" alt="Logo"
                      onerror="this.src='{{asset('back-end/assets/back-end/img/400x400/img2.jpg')}}'"
                      style="width: 10rem;">
              </a>
                @csrf 
              <div class="text-center">
                <div class="mb-3">
                  <h2 class="text-capitalize">{{('Sign In')}}</h2>
                  <span class="badge badge-soft-info">( {{('Admin or Subadmin Sign in')}} )</span>
                </div>
              </div>

              <div class="js-form-message form-group px-4">
                <input type="email" class="form-control form-control-lg input-field" name="email" id="email" required tabindex="1" placeholder="Enter your email address" data-msg="Please enter a valid email address.">
              </div>


              <div class="js-form-message form-group px-4">
                <div class="input-group input-group-merge">
                  <input type="password" class="js-toggle-password form-control form-control-lg input-field" name="password" id="signupSrPassword" placeholder="Enter your password" aria-label="8+ characters required" required data-msg="Your password is invalid. Please try again." data-hs-toggle-password-options='{
                   "target": "#changePassTarget",
                   "defaultClass": "tio-hidden-outlined",
                   "showClass": "tio-visible-outlined",
                   "classChangeTarget": "#changePassIcon"
                 }'>
                 <div id="changePassTarget" class="input-group-append">
                  <a class="input-group-text" href="javascript:">
                    <i id="changePassIcon" class="tio-visible-outlined"></i>
                  </a>
                </div>
              </div>
            </div>
            <!-- Checkbox -->
            <div class="mb-1">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="termsCheckbox"
                            name="remember">
                    <label class="custom-control-label text-muted" for="termsCheckbox">
                        {{('Remember me')}}
                    </label>
                </div>
            </div>
            <!-- End Checkbox -->
            <div class="center-element" style="margin-top: 3vh;">
              <button type="submit" class="btn btn-lg btn-block center-element sign-in-button">Sign in</button>
            </div>
          </form>

        </div>
      </div>
    </div>

  </div>

</main>


<script src="{{asset('back-end/assets')}}/back-end/js/vendor.min.js"></script>

<script src="{{asset('back-end/assets')}}/back-end/js/theme.min.js"></script>
<script src="{{asset('back-end/assets')}}/back-end/js/toastr.js"></script>
<script type="text/javascript"></script>
{!! Toastr::message() !!}

@if ($errors->any())
    <script>
        @foreach($errors->all() as $error)
        toastr.error('{{$error}}', Error, {
            CloseButton: true,
            ProgressBar: true
        });
        @endforeach
    </script>
@endif
<script>
  $(document).on('ready', function () {
        // INITIALIZATION OF SHOW PASSWORD
        // =======================================================
        $('.js-toggle-password').each(function () {
          new HSTogglePassword(this).init()
        });

        // INITIALIZATION OF FORM VALIDATION
        // =======================================================
        $('.js-validate').each(function () {
          $.HSCore.components.HSValidation.init($(this));
        });
      });
    </script>
    <script type="text/javascript">
      var onloadCallback = function () {
        grecaptcha.render('recaptcha_element', {
          'sitekey': '6LfMARoeAAAAAAITvA-le6X9IElSWX6CncicwEfY'
        });
      };
    </script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    
    <script>
      function copy_cred() {
            $('#signinSrEmail').val('admin@admin.com');
            $('#signupSrPassword').val('12345678');
            toastr.success('Copied successfully!', 'Success!', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>

    <script>
      if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="https://6cash-admin.6amtech.com/public//assets/admin/vendor/babel-polyfill/polyfill.min.js"><\/script>');
    </script>
  </body>
  </html>
