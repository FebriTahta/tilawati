<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        .grid-container {
          display: grid;
          grid-template-columns: auto;
          grid-gap: 10px;
          width: 100%;
            height: 450px;
            overflow: auto;
        }
        .grid-container > div {
          background-color: rgba(255, 255, 255, 0.8);
          text-align: center;
          font-size: 20px;
        }
        
        .item1 {
          grid-row: 1 / span 2;
        }
        .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        padding: 20px;
        }
        .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }.daftar{
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

    </style>
    <link rel="stylesheet" href="{{ asset('tilawatipusat/newlogin/style.css') }}" />
    <title>Sign in & Sign up Form</title>
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="#" class="sign-in-form grid-container">
                <div class="card">
                    <div class="card-body">
                        <div style="font-size: 16px; text-align:left" class="title item">Diklat <br/> Standarisasi Guru Al Qur'an Level 2 <br /> Cabang Cahaya Amanah - Surabaya 
                            <br />12 Juni 2020 <br/>
                            <button class="daftar btn" style="height: 40px">daftar</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div style="font-size: 16px; text-align:left" class="title item">Diklat <br/> Standarisasi Guru Al Qur'an Level 2 <br /> Cabang Cahaya Amanah - Surabaya 
                            <br />12 Juni 2020 <br/>
                            <div style="text-align: right">
                                <button class="daftar btn" style="height: 40px">daftar</button>
                            </div>
                        </div>
                    </div>
                </div>
          </form>
          <form method="POST" action="{{ route('login') }}" class="sign-up-form">@csrf
            <h2 class="title">Logo NF & Tilawati</h2>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" class="form-control" name="username" placeholder="Username" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="password" placeholder="Password" />
            </div>
            <input type="submit" class="btn" value="Login" />
            <p class="social-text"></p>
          </form>
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3><img src="{{ asset('assets/images/tilawati-white.png') }}" width="150px" alt=""></h3>
            <p>
                Selamat datang di sistem pendaftaran program diklat TILAWATI <br/>
            </p>
            <button class="btn transparent" style="width: 170px" id="sign-up-btn">
              Masuk / Cek Status
            </button>
          </div>
          <img src="{{ asset('tilawatipusat/newlogin/img/register.svg') }}" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Bergabung Mengikuti Diklat ?</h3>
            <p>
              Cek daftar diklat yang akan datang dibawah ini
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Jadwal
            </button>
          </div>
          <img src="{{ asset('tilawatipusat/newlogin/img/register.svg') }}" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="{{ asset('tilawatipusat/newlogin/app.js') }}"></script>
  </body>
</html>
