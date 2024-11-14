<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Mavie Coffe Shop</title>

  <!-- icon -->
  <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

  <!-- database -->

  <?php
  include("../koneksi.php");

  $result = mysqli_query($koneksi, "SELECT * FROM product ORDER BY id DESC");
  ?>
  <!-- database end -->


  <!-- navbar -->

  <nav class="navbar">

    <div class="alterra">
      <h1><span>Mavie Coffe</span> Shop</h1>
    </div>

    <div class="isi-nav">
      <a href="#">Home</a>
      <a href="about.php">About</a>
      <a href="contact.php">Contact</a>
      <a href="../index.php">Log out</a>
    </div>

    <div class="search-form">
      <form action="#produk" method="post">
        <input type="search" name="search" id="search-box" placeholder="Cari disini..">
        <label for="search-box">
          <button type="submit" name="submit"><i data-feather="search"></i></button>
        </label>
      </form>
    </div>

    <?php
    if (isset($_POST["submit"])) {
      $search = mysqli_real_escape_string($koneksi, $_POST["search"]);
      $query = "SELECT * FROM product WHERE LOWER(judul) LIKE LOWER('%$search%') OR  LOWER(kategori) LIKE LOWER('%$search%') ORDER BY id DESC";
      $result = mysqli_query($koneksi, $query);
    } else {
      // If the form is not submitted, fetch all products
      $result = mysqli_query($koneksi, "SELECT * FROM product ORDER BY id DESC");
    }
    ?>    

    <div class="tombol">
      <a href="#" id="search-icon">
        <i data-feather="search"></i>
      </a>
      <a href="#" id="hamburger-menu">
        <i data-feather="menu"></i>
      </a>
    </div>
    
  </nav>
  <!-- navbar end -->

  <!-- banner -->

  <section class="banner" id="home">
    <main class="teks">
      <p class="quote">Menemani Harimu Dengan Segelas Kopi</p>
      <p class="name">~Raf</p>
      <p class="p">
        Tidak perlu terburu buru jalani, nikmati, syukuri, jika gagal tinggal berjuang lagi.
      </p>
      <a href="#produk">Lihat Produk</a>
    </main>
  </section>

  <!-- banner end -->

  <!-- product -->

  <div class="product" id="produk">

    <div class="judul">
      <h2><span>Produk</span> Tersedia</h2>
      <p>-Disini tersedia berbagai macam menu kopi dengan kualitas terbaik yang bisa anda beli-</p>
    </div>

    <div class="list-product">
      <?php while ($user_data = mysqli_fetch_array($result)) : ?>
        <div class="item">
          <img src="../img-product/<?= $user_data['img']; ?>">
          <h5><?= $user_data['judul']; ?></h5>
          <p><?= "Rp. " . $user_data['harga']; ?></p>
          <a href="checkout.php?id=<?= $user_data['id']; ?>">Beli Sekarang</a>
        </div>
      <?php endwhile; ?>
    </div>



    <!-- product end -->

    <footer class=" footer">

      <div class="sosmed">
        <a href="https://facebook.com">
          <i data-feather="facebook"></i>
        </a>
        <a href="https://instagram.com">
          <i data-feather="instagram"></i>
        </a>
        <a href="https://youtu.be/gG5-ohzSDu8?si=Mtp0vRqfKrtXNCSx">
          <i data-feather="youtube"></i>
        </a>
        <a href="https://twitter.com">
          <i data-feather="twitter"></i>
        </a>
      </div>

      <div class="direction">
        <a href="#">Home</a>
        <a href="about.php">About</a>
        <a href="contact.php">Contact</a>
        <a href="#produk">produk</a>
      </div>

      <div class="copyright">
        Created By | <span class="c">&copy;</span> <span class="n">Rafif Rabbani</span>
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
  background-color:  rgb(105, 102, 102);
}


/* navbar */

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 0.9rem 4%;
  background-color: var(--bg);
  position: fixed;
  top: 0;
  right: 0;
  left: 0;
  z-index: 9999;
  animation: top 1s ease;
}

.navbar .alterra {
  color: var(--head);
  text-shadow: 0 0 1px var(--head);
}

.navbar .alterra span {
  color: var(--cold);
}

.navbar .isi-nav a {
  color: var(--head);
  padding: 0 0.6rem;
}

.navbar .isi-nav a:hover {
  color: var(--warm);
  transition: 0.5s ease;
}

.navbar .tombol a {
  color: var(--head);
  margin: 0 .6rem;
}

#hamburger-menu {
  display: none;
}

/* search box */
.navbar .search-form {
  position: absolute;
  top: 20%;
  right: 7%;
  background-color: white;
  width: 20rem;
  height: 2rem;
  display: flex;
  transition: .3s ease;
  transform: scaleX(0);
  transform-origin: center;
  border-radius: 5px;
}

.navbar .search-form input[type="search"] {
  width: 17rem;
  top: 50%;
}

.navbar .search-form input[type="search"]::-webkit-search-clear-button {

  left: -5rem;
  /* Sesuaikan posisi horizontal sesuai keinginan Anda */
  top: 50%;
  /* Menempatkan di tengah vertikal */
  height: 20px;
  /* Sesuaikan sesuai keinginan Anda */
  width: 20px;
  /* Sesuaikan sesuai keinginan Anda */
}

.navbar .search-form input {
  height: 100%;
  width: 100%;
  padding-left: 5%;
  font-size: 0.8rem;
}

.navbar .search-form.active {
  transform: scaleY(1);
}

.navbar .search-form label {
  cursor: pointer;
}

.navbar .search-form label button {
  position: absolute;
  top: 8%;
  right: 3%;
  background-color: rgb(177, 177, 177);
}

/* search box end */

/* navbar end */


/* banner */

.banner {
  margin-top: 120px;
  margin-bottom: 50px;
  margin-left: 15vw;
  height: 70vh;
  width: 70vw;
  background-image: url(../bg-img/snataiii.jpg);
  background-repeat: no-repeat;
  background-size: cover;
  border-radius: 20px;
  align-items: center;
  display: flex;
  animation: zoom 1s ease alternate;
}


.banner .teks {
  padding-left: 1.3rem;
  color: white;
}

.quote {
  font-size: 2rem;
  width: 35vw;
  font-weight: 600;
  font-family: Arial, Helvetica, sans-serif;
  animation: left 0.5s ease;
}

.name {
  margin: 7px 0;
  font-style: italic;
  color: rgba(0, 0, 0, 0.693);
  font-weight: 500;
}

.p {
  width: 23vw;
  margin-top: 1rem;
}

.big {
  color: var(--warm);
}

.kcl {
  color: var(--cold);
}

.banner a {
  display: inline-block;
  padding: 10px 20px;
  color: white;
  margin-top: 30px;
  background-color: var(--warm);
  font-weight: 500;
  font-size: 1rem;
  border-radius: 10px;
}

.banner a:hover {
  transform: scale(1.1);
  transition: 0.4s ease-in;
}

/* banner end */


/* product */

.product {
  padding-top: 40px;
  text-align: center;
}

.product .judul {
  margin-top: 1.3rem;
  margin-right: 2rem;
  margin-left: 2rem;
  margin-bottom: 0;
  font-style: italic;
  max-width: 25vw;
  margin-left: 37vw
}

.product .judul h2 {
  text-shadow: 0 0 2px black;
  color: white;
}

.product .judul h2 span {
  color: var(--cold);
}

.product .judul p {
  margin-top: 10px;
  margin-left: 5px;
  font-weight: 300;
  color: white;
}

.list-product {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  padding-top: 20px;
}

.list-product .item {
  margin: 1.2rem 1.5rem;
}

.item {
  width: 200px;
  height: 380px;
  background-color: white;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0px 0px 10px 3px rgb(255, 174, 0);
}

.item img {
  width: 180px;
  height: 200px;
  margin-top: 10px;
  border-radius: 5px;
}

.item h5 {
  text-align: center;
  word-spacing: 2px;
  letter-spacing: 0.5px;
  width: 200px;
  height: 25px;
  margin-top: 10px;
}

.list-product .item p {
  width: 200px;
  height: 20px;
  margin-top: 5px;
  margin-bottom: 10px;
  color: var(--warm);
  font-weight: 400;
}

.item a {
  background-color: var(--cold);
  color: var(--head);
  padding: 5px 15px;
  border-radius: 4px;
  display: inline-block;

}

.item a:hover {
  transform: scale(1.1);
  border-radius: 6px;
  transition: 0.3s ease-in;
  cursor: pointer;
}

.list-product .item img:hover {
  transform: scale(1.11);
  transition: 0.5s ease;
  border-radius: 20px;
}

/* best item 

.list-product .item-best img:hover {
  transform: scale(1.11);
  transition: 0.5s ease;
  border-radius: 14px ;
}

.list-product .item-best {
  margin: 25px 15px;
}

.item-best {
  width: 200px;
  height: 380px;
  background-color: white;
  border-radius: 10px;
  text-align: center;
  box-shadow: 0px 0px 10px 3px var(--cold);
  
}

.item-best img {
  width: 180px;
  height: 250px;
  margin-top: 10px;
  border-radius: 5px;
}

.item-best h5 {
  width: 200px;
  height: 20px;
  margin-top: 10px;
}

.item-best p {
  width: 200px;
  height: 20px;
  margin-top: 5px;
  margin-bottom: 10px;
  color: var(--warm);
  font-weight: 300;
}

.item-best a {
  background-color: var(--cold);
  color: var(--head);
  padding: 5px 15px;
  border-radius: 4px;
  display: inline-block;
}

.item-best a:hover {
  transform: scale(1.1);
  border-radius: 6px;
  transition: 0.3s ease-in;
}
best item end */

/* product end */


/* footer */

.footer {
  background-color: var(--bg);
  height: 18vh;
  width: 100%;
  text-align: center;
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
  0% {
    transform: scale(0.2, .2);
  }

  100% {
    transform: scale(1, 1);
  }
}

@keyframes left {
  from {
    left: -1000px;
  }

  to {
    left: 0;
  }
}

/* keyframe end */


/* resposif */

@media (max-width: 450px) {
  html {

    left: 0;
    right: 0;
  }

  .navbar h1 {
    font-size: 70%;
    width: auto;
    position: relative;
  }

  #hamburger-menu {
    display: inline-block;
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

  .navbar .search-form {
    width: 70%;
    height: 60%;
    right: 27%;
    top: 100%;
    box-shadow: 0 0 2px gray;
  }

  /* banner */
  .banner {
    font-size: 65%;
  }

  .banner .teks .quote {
    width: 70%;
    font-size: 170%;
  }

  /* banner end */

  /* product */

  .product .judul {
    min-width: 100vw;
    margin-left: 0;

  }

  /* product end */
}

/* responsif end */
</style>