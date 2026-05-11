<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    nav {
        padding: 1vw 3vw;
        width: 100%;
        background-color: red;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .logo img {
        width: 10vw;
        min-width: 80px;
        max-width: 180px;
        height: auto;
    }

    .menu,
    .auth {
        display: flex;
        gap: 2vw;
    }

    a {
        text-decoration: none;
        color: white;
        font-size: 1.2vw;
    }
</style>


<!-- popins -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">

<nav>
    <div class="logo">
        <a href="#">
            <img src="asset/images/logo.png" alt="logo"></a>
    </div>
    <div class="menu">
        <a href="#">Lihat Product</a>
    </div>
    <div class="auth">
        <a href="#">Masuk</a>
        <a href="#">Daftar</a>
    </div>
</nav>