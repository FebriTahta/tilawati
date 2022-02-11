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
      select {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
      }
      </style>
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
    <title>tilawati pusat</title>
    
  </head>
  <body>
    <div class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="POST" action="{{ route('login') }}" class="sign-up-form">@csrf
            <h2 class="title">
              <img src="{{ asset('assets/images/tilawati-blue.png') }}" width="150px" alt="">
            </h2>
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

          <form method="POST" action="{{route('download.template')}}" target="_blank" class="sign-in-form">@csrf
            <label for="" style="text-transform: uppercase; margin-top: 0px">Apabila ada pertanyaan seputar Sistem</label>
            <span>Hubungi no 081329146514</span>
            {{-- <div class="input-field">
              <span>Hubungi no 081329146514</span>
              <i class="fas fa-book"></i>
              <select name="jenis" class="form-control" style="text-transform: capitalize" id="" required>
                <option value="">pilih template</option>
                <option value="guru">Import (Guru / Standarisasi)</option>
                <option value="santri">Import (Santri / Munaqosyah, Munaqisy, Tahfidz)</option>
                <option value="training_of_trainer">Import (Training Of Trainer)</option>
              </select>
            </div> --}}
            {{-- <input type="submit" style="width: 200px" class="btn" value="Download Template" /> --}}
            <a href=" https://wa.me/081329146514?text=Assalamualaikum%20saya%ada%beberapa%pertanyaan%yang%ingin%saya%tanyakan" class="btn" ><i class="fa fa-whatsapp" style="margin-top: 15px; margin-left: 15px"></i> Whatsapp</a>
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
              Masuk
            </button>
          </div>
          <img src="{{ asset('assets/images/gedung.png') }}" class="image" alt="" />
          {{-- <img src="{{ asset('tilawatipusat/newlogin/img/register.svg') }}" class="image" alt="" /> --}}
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>Download Template Data Import Peserta Diklat ?</h3>
            <p>
              Cek daftar template peserta diklat berikut ini
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Template
            </button>
          </div>
          {{-- <img src="{{ asset('tilawatipusat/newlogin/img/register.svg') }}" class="image" alt="" /> --}}
          <img src="{{ asset('assets/images/gedung.png') }}" class="image" alt="" />
        </div>
      </div>
    </div>
    <script src="{{ asset('tilawatipusat/newlogin/app.js') }}"></script>
  </body>
</html>
