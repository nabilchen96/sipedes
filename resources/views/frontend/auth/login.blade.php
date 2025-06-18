<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="login-form-02/https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="login-form-02/fonts/icomoon/style.css">

  <link rel="stylesheet" href="login-form-02/css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="login-form-02/css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="login-form-02/css/style.css">

  <!-- Favicons -->
  <!-- <link href="{{ url('pandu.jpeg') }}" rel="icon">
  <link href="{{ url('pandu.jpeg') }}" rel="apple-touch-icon"> -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
  <style>
    @media (max-width: 768px) {
      .bg {
        display: none;
      }
    }
  </style>
  <title>SIPEDES</title>
</head>

<body>


  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('{{ asset('kampung.webp') }}');"></div>

    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center" style="margin-top: -50px !important;">
          <div class="col-md-7">
            <h3>Login to <br> Sistem Informasi <strong><span class="text-danger">SIPEDES</span></strong></h3>
            <br>
            <form id="formLogin">
              <div class="form-group first">
                <label>Email</label>
                <input type="text" class="form-control" placeholder="Email" id="nip_email" name="nip_email" required>
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Your Password" id="password"
                  required>
              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked" />
                  <div class="control__indicator"></div>
                </label>
                {{-- <span class="ml-auto"><a href="login-form-02/#" class="forgot-pass">Forgot Password</a></span> --}}
              </div>

              <div class="d-grid">
                <button type="submit" id="btnLogin" class="btn btn-primary btn-lg btn-block">Sign in</button>

                <button style="display: none; background: #0d6efd;" id="btnLoginLoading"
                  class="btn btn-info btn-moodle text-white btn-lg btn-block" type="button" disabled>
                  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>

                </button>
              </div>
              <br>
              Dont Have an account? <a href="{{ url('register') }}" class="text-primary">Register</a> <br>
              Forget Password? <a href="{{ url('reset-password') }}" class="text-primary">Reset Password</a>
            </form>
          </div>
        </div>
      </div>
    </div>


  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.15.7/dist/sweetalert2.all.min.js"></script>
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    formLogin.onsubmit = (e) => {

      e.preventDefault();

      const formData = new FormData(formLogin);
      document.getElementById(`btnLogin`).style.display = "none";
      document.getElementById(`btnLoginLoading`).style.display = "block";

      axios({
        method: 'post',
        url: '/loginProses',
        data: formData,
      })
        .then(function (res) {
          //handle success
          if (res.data.responCode == 1) {

            Swal.fire({
              icon: 'success',
              title: 'Berhasil Login',
              timer: 1000,
              text: 'Anda akan diarahkan ke halaman dashboard',
              showConfirmButton: false,
              // text: res.data.respon
            })

            setTimeout(() => {
              location.reload(res.data.respon);
            }, 1500);

          } else {

            Swal.fire({
              icon: 'warning',
              title: 'Ada kesalahan',
              text: `${res.data.respon}`,
            })
          }
        })
        .catch(function (res) {
          //handle error
          console.log(res);
        }).then(function () {
          // always executed              
          document.getElementById(`btnLogin`).style.display = "block";
          document.getElementById(`btnLoginLoading`).style.display = "none";

        });

    }
  </script>

</body>

</html>