<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Keterangan Diterima - Telkom University</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }

    .container {
      width: 80%;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    header {
      text-align: center;
      margin-bottom: 20px;
    }

    header img {
      max-width: 100px;
      height: auto;
    }

    h1,
    h3 {
      color: #333;
    }

    p {
      color: #555;
      line-height: 1.6;
    }

    .student-photo {
      text-align: center;
      margin-top: 20px;
    }

    .student-photo img {
      max-width: 150px;
      height: auto;
      border: 3px solid #333;
    }
  </style>
</head>

<body>
  <center>
    <div class="container">
      <header>
        <img src="https://upload.wikimedia.org/wikipedia/commons/0/03/Logo_Telkom_University_potrait.png" alt="Telkom University Logo">
        <h1>Telkom University</h1>
        <h3>Surat Keterangan Diterima</h3>
      </header>
      <p> Dengan ini, kami umumkan bahwa:</p>
      <h2>{{ $user->nama_lengkap }}</h2>
      <div class="student-photo">
        <img src="http://sertifikasi.test:8080/{{ $user->foto }}" alt="Foto Mahasiswa">
      </div>
      <p>
        Telah diterima sebagai mahasiswa Telkom University pada Program Studi <strong>Contoh Program Studi</strong> untuk semester awal tahun akademik 2023/2024.
      </p>
      <p>
        Surat keterangan ini dapat digunakan untuk keperluan administrasi dan validasi pendaftaran.
      </p>
      <p>
        Demikian surat keterangan ini dibuat untuk digunakan sebagaimana mestinya.
      </p>
      <footer>
        <p>
          Hormat kami,
          <br>
          Rektor Telkom University
        </p>
      </footer>
    </div>
  </center>
</body>
</html>
