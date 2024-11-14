<?php
include("../koneksi.php");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Mavie Coffe Shop</title>
    <link rel="stylesheet" href="../css/checkout.css">

    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

    <nav class="nav">
        <h1>Checkout</h1>
    </nav>

    <div class="checkout">

        <div class="checkout-pro">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $query = mysqli_query($koneksi, "SELECT * FROM product WHERE id = '$id'");
                $productData = mysqli_fetch_assoc($query);

                if ($productData) {
            ?>

                    <div class="pro-img">
                        <img src="../img-product/<?= $productData['img'] ?>">
                    </div>
                    <form action="checkout.php" method="post" name="formCheckout">
                        <div class="product">
                            <h1>Checkout Product<span></span></h1>
                            <h3>Nama Produk</h3>
                            <p><?= $productData['judul']; ?></p>
                            <h3>Stok Tersisa</h3>
                            <p id="stokTersisa"><?= $productData['stok']; ?></p>
                            <!-- Harga -->
                            <h3>Harga</h3>
                            <p id="harga"><?= $productData['harga']; ?></p>
                            <!-- Jumlah -->
                            <h3>Jumlah</h3>
                            <input type="number" value="1" min="1" name="quantity" id="jumlah">
                            <!-- Harga Total -->
                            <h3>Harga Total</h3>
                            <p id="hargaTotal"><?= $productData['harga']; ?></p>
                        </div>
                <?php
                } else {
                    echo '<p>Produk tidak ditemukan</p>';
                }
            } else {
                echo '<p>Data produk tidak valid</p>';
            }
                ?>
        </div>

        <div class="checkout-bill">
            <h1><span>Checkout </span> Bill</h1>

            <input type="hidden" name="id" value="<?= $id ?>">
            <h4>Nama lengkap</h4>
            <input type="text" class="name" name="nama" placeholder="username.." required="required">

            <h4>E-MAIL</h4>
            <input type="email" class="email" name="email" placeholder="email.." required="required">

            <h4>Alamat Lengkap</h4>
            <input type="text" class="alamat" name="alamat" placeholder="Alamat anda.." required="required" autocomplete="off">

            <h4>Nomor Dana</h4>
            <input type="text" class="no" name="nomor" id="nom" placeholder="Nomor Dana anda.." required="required" autocomplete="off">

            <input type="hidden" name="judul" value="<?= $productData['judul']; ?>">

            <input type="submit" name="submit" value="BELI">
        </div>
        </form>
    </div>

    <img src="../bg-img/dana.jpg" class="img">

    <?php

    if (isset($_POST['submit'])) {

        // Mengambil nilai input dari form
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $alamat = $_POST['alamat'];
        $nomor = $_POST['nomor'];
        $id = $_POST['id'];
        $judul = $_POST['judul'];

        $stokAwal = $_POST['quantity'];

        // Menghubungkan ke Database
        include_once("../koneksi.php");

        // Ambil stok saat ini dari database
        $query_select = "SELECT stok FROM product WHERE id = '$id'";
        $result_select = $koneksi->query($query_select);

        if ($result_select->num_rows > 0) {
            $row = $result_select->fetch_assoc();
            $stokSaatIni = $row['stok'];

            // Menghitung stok setelah pengurangan
            $stokAkhir = $stokSaatIni - $stokAwal;

            if ($stokAkhir < 0) {
                echo '<script>alert("Stok tidak mencukupi!");</script>';
            } else {
                // Menyimpan data ke Database
                $checkout = mysqli_query(
                    $koneksi,
                    "INSERT INTO checkout (nama, email, alamat, nomor, judul) VALUES ('$nama', '$email', '$alamat', '$nomor', '$judul')"
                );

                if ($checkout) {
                    // Perbarui stok di database
                    $resultUpdate = mysqli_query($koneksi, "UPDATE product SET stok = $stokAkhir WHERE id = '$id'");

                    if ($resultUpdate) {
                        echo '<script>alert("Pembelian SUKSES"); window.location.href = "home.php";</script>';
                    } else {
                        echo "Error updating stok: " . mysqli_error($koneksi);
                    }
                } else {
                    echo "Error: " . mysqli_error($koneksi);
                }
            }
        } else {
            echo "Data tidak ditemukan.";
        }

        // Tutup koneksi ke database
        $koneksi->close();
    }


    ?>


    <script>
        feather.replace();
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var jumlahInput = document.getElementById("jumlah");
            var hargaProdukElement = document.getElementById("harga");
            var hargaTotalElement = document.getElementById("hargaTotal");
            var stokTersisaElement = document.getElementById("stokTersisa");

            var hargaAwal = parseFloat(
                hargaProdukElement.textContent.replace("Rp ", "").replace(",", "")
            );

            // Ambil nilai stok dari elemen HTML
            var stokTersisa = parseInt(stokTersisaElement.textContent);

            // Fungsi untuk membatasi nilai input agar tidak melebihi stok
            function limitQuantity() {
                var quantity = parseInt(jumlahInput.value);

                // Validasi agar nilai tidak melebihi stok
                if (quantity > stokTersisa) {
                    alert("Jumlah Pembelian telah mencapai angka maksimum");
                    jumlahInput.value = stokTersisa;
                }

                // Panggil fungsi untuk mengupdate nilai Harga Total
                updateHargaTotal();
            }

            // Fungsi untuk mengupdate nilai Harga Total
            function updateHargaTotal() {
                var quantity = parseInt(jumlahInput.value);
                var hargaAwal = parseInt(hargaProdukElement.textContent);
                var hargaTotal = hargaAwal * quantity;
                hargaTotal = hargaTotal.toLocaleString(); // Menetapkan jumlah angka desimal
                hargaTotalElement.textContent = "Rp " + hargaTotal.toLocaleString('id-ID');
                console.log("Harga Total diupdate:", hargaTotal);

            }

            // Event listener untuk memanggil fungsi saat nilai input berubah
            jumlahInput.addEventListener("input", limitQuantity);

            // Panggil fungsi untuk menetapkan nilai awal Harga Total
            updateHargaTotal();
        });
    </script>


</body>

</html>

<style>
    * {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

nav {
    background-color: rgba(0, 0, 0, 0.651);
    height: 3rem;
    display: flex;
    text-align: center;
    align-items: center;
    justify-content: center;
    color: white;

}

.checkout {
    display: flex;
}



.checkout .checkout-pro {
    display: flex;
    height: 90.5vh;
    width: 58vw;
    border: none;
    background: linear-gradient(to top, orangered, rgb(255, 196, 0));
    box-shadow: 0 1rem 2rem black;
    border-bottom-right-radius: 16rem;
    border-top-right-radius: 16rem;
}

.checkout .checkout-pro .pro-img img {
    width: 25rem;
    height: 27.5rem;
    box-shadow: 0 0 7px rgb(255, 254, 254);
    border-radius: 5px;
    margin-top: 1.5rem;
    margin-left: .5rem;
    animation: zoom 1s ease;
}

/* product */

.checkout .checkout-pro .product {
    margin-left: 1.5rem;
    margin-top: 2rem;
}

.checkout .checkout-pro .product h1 {
    text-align: center;
    font-size: 1.5rem;
    color: white;
    text-shadow: 0 0 2px black;
}

.checkout .checkout-pro .product h1 span {
    color: rgb(15, 165, 224);
}

.checkout .checkout-pro .product h3 {
    margin-top: 1rem;
}

.checkout .checkout-pro .product p {
    height: .9rem;
    width: 15rem;
    border-radius: 3px;
    padding: .5rem;
    font-size: .8rem;
    margin-top: .5rem;
    font-weight: bold;
    color: white;
    text-shadow: 0 0 1px black;
    box-shadow: 0 0 3px white;
    background-color: rgba(0, 0, 0, 0.216);
}

.checkout .checkout-pro .product input {
    height: .9rem;
    width: 15rem;
    padding: .5rem;
    font-size: .8rem;
    background-color: rgba(0, 0, 0, 0.403);
    border: none;
    border-radius: 3px;
    margin-top: 0.5rem;
    color: white;
    font-weight: bolder;
}

/* product end */


/* bill */

.checkout .checkout-bill {
    margin-top: 1rem;
    margin-left: 3rem;
}

.checkout .checkout-bill h1 {
    font-size: 1.5rem;
    text-align: center;
    color: white;
    text-shadow: 0 0 2px black;
}

.checkout .checkout-bill h1 span {
    color: rgb(251, 160, 32);
    text-shadow: none;
}

.checkout .checkout-bill h4 {
    margin-top: .7rem;
    color: black;
    text-shadow: 0 0 2px rgb(118, 224, 248);
}

.checkout .checkout-bill input {
    height: 1.2rem;
    width: 15rem;
    padding: 5px;
    margin-top: .3rem;
    font-size: .7rem;
    outline: none;
}

.checkout .checkout-bill input:last-child {
    height: 3rem;
    width: 16rem;
    margin-top: 2rem;
    font-size: 1.5rem;
    font-weight: bold;
    color: #fff;
    background-color: orangered;
    border: none;
    border-radius: 10px;
    cursor: pointer;
}

.checkout .checkout-bill input:last-child:hover {
    transition: .5s ease;
    transform: scale(1.1);
}

.img {
    top: 49.5%;
    left: 60.5%;
    height: 2rem;
    width: 4.5rem;
    position: absolute;
}

.checkout .checkout-bill .name {
    animation: zoom 1.5s ease;
}

.checkout .checkout-bill .email {
    animation: zoom 1.8s ease;
}

.checkout .checkout-bill .alamat {
    animation: zoom 2.2s ease;
}

.checkout .checkout-bill .no {
    animation: zoom 2.5s ease;
}

.checkout .checkout-bill .keterangan {
    animation: zoom 2.8s ease;
}

/* bill end */

@keyframes top {
    from {
        top: -10000px;
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
        left: -100rem;
    }

    to {
        left: 0;
    }
}
</style>