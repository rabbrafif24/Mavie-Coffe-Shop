<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About</title>
    <link rel="stylesheet" href="../css/about.css">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

    <nav class="navbar">
        <h1>Alterra Shop</h1>
        <div class="isi-nav">
            <a href="home.php">Home</a>
            <a href="#">About</a>
            <a href="contact.php">Contact</a>
            <a href="../index.php">Log out</a>
        </div>

        <div class="ham">
            <a href="#" id="hamburger-menu">
                <i data-feather="menu"></i>
            </a>
        </div>
    </nav>

    <div class="tentang">
        <div class="perkenalan">
            <h2>Apa Itu <span>Mavie Coffe Shop </span> ?</h2>
            <div class="text">
                <p>
                    L'AMOUR DE MAVIE adalah sebuah kata berbahasa prancis yang memiliki arti cinta sejatiku. Cinta sejati disini merujuk
            kepada secangkir kopi yang bisa kita nikmati kapanpun dan dimanapun. Kata kata itu terinspirasi dari clip sebuah film
            yang diupload di tiktok. Film itu menceritakan tentang sebuah pasangan yang sangat setia, tidak peduli ketika marabahaya
            datang mereka selalu menghadapinya secara bersama. Sama seperti kopi dan penikmatnya yang tidak akan pernah bosan saat meminumnya walau rasa kopi tersebut tidak berubah
            sedikitpun. dari situlah nama L'AMOUR DE MAVIE atau MAVIE COFFE tercipta. penikmat kopi bisa mengorder segelas kopi dari
            rumah tanpa harus pergi ke kedai kopi atau cafe
                </p>
            </div>
        </div>
    </div>

    <footer class="footer">

        <div class="sosmed">
            <a href="https://facebook.com">
                <i data-feather="facebook"></i>
            </a>
            <a href="https://instagram.com">
                <i data-feather="instagram"></i>
            </a>
            <a href="https://youtube.com">
                <i data-feather="youtube"></i>
            </a>
            <a href="https://twitter.com">
                <i data-feather="twitter"></i>
            </a>
        </div>

        <div class="direction">
            <a href="home.php">Home</a>
            <a href="#">About</a>
            <a href="contact.php">Contact</a>
            <a href="home.php#produk">produk</a>
        </div>

        <div class="copyright">
            Created By | <span class="c">&copy;</span> <span class="n">M.Adrian Kurniawan</span>
        </div>

    </footer>

    <script>
        feather.replace();
    </script>

    <script src="../script.js"></script>

</body>

</html>

<style>
    :root {
  --head: rgb(255, 255, 255);
  --bg: rgba(0, 0, 0, 0.781);
  --warm: rgb(255, 85, 0);
  --cold: rgb(0, 187, 255);
}

* {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  text-decoration: none;
  outline: none;
  box-sizing: border-box;
  border: none;
  scroll-behavior: smooth;
}

body {
  font-family: helvetica;
}

/* navbar */

.navbar {
  animation: top 1.5s ease;
  height: 10vh;
  display: flex;
  align-items: center;
  padding: 1rem 3%;
  color: var(--head);
  background-color: var(--bg);
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 2014;
}

.navbar h1 {
  color: var(--warm);
  width: 20vw;
  margin-right: 10vw;
  margin-left: 1.093vw;
}

.navbar .isi-nav {
  width: 25vw;
  margin-left: 5vw;
}

.navbar .isi-nav a {
  padding: 0 10px;
  color: var(--head);
}

.navbar .isi-nav a:hover {
  color: var(--warm);
  transition: 0.3s;
}

.navbar .ham a {
  color: var(--head);
}

#hamburger-menu {
  display: none;
}

/* navbar end */

/* isi */

.tentang {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  margin-top: 20vh;
}

.perkenalan {
  height: 70vh;
  width: 70vw;
  background-image: url(../bg-img/snataiii.jpg);
  background-size: cover;
  border-radius: 20px;
  text-align: center;
  animation: zoom 1s alternate;
}

.perkenalan h2 {
  margin-top: 1rem;
  color: white;
  text-shadow: 0 0 2px white;
}

.perkenalan h2 span {
  color: var(--warm);
}

.perkenalan .text {
  width: 40vw;
  margin: 1.5rem 2rem;
  word-spacing: 0.15rem;
  line-height: 130%;
  text-align: left;
  color: white;
}

.perkenalan,
.pendalaman .text span {
  color: var(--cold);
  text-shadow: 0 0 1px black;
}

.

/* isi end */

/* keyframe */
@keyframes top {
  from {
    top: -100px;
  }

  to {
    top: 0;
  }
}

@keyframes zoom {
  from {
    transform: scale(0.2);
  }

  to {
    transform: scale(1);
  }
}

/* keyframe end */

/* footer */

.footer {
  background-color: var(--bg);
  text-align: center;
  height: 18vh;
  margin-top: 10vh;
  padding: 1rem 0;
  color: var(--bg);
}

footer .direction {
  margin-top: 0.6rem;
  margin-bottom: 0.2544rem;
}

footer .copyright {
  font-size: 0.7rem;
}

footer .copyright .n {
  font-weight: bold;
}

.footer a {
  color: var(--head);
}

.footer .direction a {
  padding: 10px;
}

footer .copyright .c {
  color: var(--head);
}

.footer .sosmed a {
  padding: 7px;
}

.footer .sosmed :hover {
  color: var(--cold);
}

.footer .direction a:hover {
  color: var(--warm);
}

/* footer end */


/* responsif */

@media (max-width: 450px) {
  html {
    font-size: 70%;
    padding: 0 1rem;
    left: 0;
    right: 0;
  }

  .navbar h1 {
    width: 30vh;
    position: relative;
  }

  #hamburger-menu {
    display: inline-block;
    margin: 0 20px;
    margin-left: 20vh;
  }

  .navbar .isi-nav {
    top: 0;
    right: -100%;
    position: absolute;
    width: 100px;
    height: 100vh;
    font-weight: bolder;
    background: var(--bg);
    transition: 0.3s;
  }

  .navbar .isi-nav a {
    display: list-item;
    margin-top: 15px;
    justify-content: center;
    list-style: none;
  }

  .navbar .isi-nav.active {
    right: 0;
  }

  .pendalaman .text {
    width: 100%;
    margin: 0;
    margin-left: 0;
    mix-blend-mode: initial;
  }

  .perkenalan .text {
    width: 100%;
    margin: 0;
    margin-left: 0;
    text-align: center;
  }

  .tujuan .text {
    width: 90%;
    margin: 0;
    margin-left: 0;
    text-align: center;
  }

}

/* responsif end */
</style>