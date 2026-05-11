<?php include 'navbar.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login Manajement UMKM Desa Gandoang</title>

    <style>


        body {
            height: 100%;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .pembungkus {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        form {
            width: 90%;
            max-width: 400px;
            border: 1px solid black;
            padding: 2rem;
            box-sizing: border-box;
        }

        label {
            display: block;
            margin-top: 1rem;
        }

        input,
        button {
            width: 100%;
            padding: 0.8rem;
            box-sizing: border-box;
            cursor: pointer;
        }

        .butuh_bantuan {
            color: blue;
            text-decoration: underline;
            font-size: clamp(12px, 1.2vw, 14px);
        }

        form .lupa_password {
            display: block;
            margin-top: 1rem;
            color: blue;
            text-decoration: underline;
            font-size: clamp(12px, 1.2vw, 14px);
        }

        .daftar{
            margin-bottom:1rem;
            font-size: clamp(12px, 1.2vw, 14px);
        }

        .daftar a{
            color: blue;
            text-decoration: underline;
            font-size: clamp(12px, 1.2vw, 14px);
        }

        
    </style>
</head>

<body>

    <div class="pembungkus">
        <form action="proses_login.php" method="post">

            <center>
                <h1>Masuk</h1>
            </center>

            <label for="email">email</label>
            <input type="email" placeholder="Masukan Email" id="email"><br>

            <label for="password">kata sandi</label>
            <input type="email" placeholder="Masukan Kata Sandi" id="password"><a href="#" class="butuh_bantuan">
                Butuh Bantuan?</a><br><br>

            <button type="submit">Masuk</button>

            <center><a href="#" class="lupa_password">Lupa Password</a></center>
        </form>

    </div>

    <center> <p class="daftar">Belum Punya Akun? <a href="#">Daftar</a></p></center>

</body>

</html>

<?php include 'footer.php'; ?>