<html>

<head>
    <title>Tambah Menu</title>
</head>

<body>

    <form name="tambah-data" method="post" action="tambah.php" enctype="multipart/form-data">

        <h1>Tambah Produk</h1>
        <h3>Nama Menu</h3>
        <input type="text" name="judul">

        <h3>Kategori</h3>
        <input type="text" name="kategori">

        <h3>Harga</h3>
        <input type="text" name="harga">

        <h3>Stok</h3>
        <input type="text" name="stok">

        <h3 class="imek">Image Product</h3>
        <input type="file" name="img" class="input-gambar"> 

        <input type="submit" name="submit" value="Tambah">

        <a href="data.php">kembali ke home</a>
    </form>

    <?php

    // Check If form submitted, insert form data info users table.
    if (isset($_POST['submit'])) {

        $judul = $_POST['judul'];
        $kategori = $_POST['kategori'];
        $harga = $_POST['harga'];
        $stok = $_POST['stok'];

        // Upload img
        $img = $_FILES['img']['name'];
        $img_temp = $_FILES["img"]["tmp_name"];
        $img_name = uniqid() . '_' . $img;
        $img_folder = "../img-product/" . $img;

        if (move_uploaded_file($img_temp, $img_folder)) {
            // Menghubungkan ke Database
            include_once("../koneksi.php");

            // Menyimpan data ke Database
            $result = mysqli_query($koneksi, "INSERT INTO product (judul, kategori, harga, stok, img) VALUES ('$judul', '$kategori', '$harga', '$stok', '$img')");

            if ($result) {
                echo '<script>alert("Data berhasil disimpan.");</script>';
            } else {
                echo "Error: " . mysqli_error($koneksi);
            }
        } else {
            echo "Gagal mengunggah gambar.";
        }
    }

    ?>
</body>

</html>

<style>
    * {
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
    padding: 0;
}

body {
    align-items: center;
    justify-content: center;
    display: flex;
    background-color: rgb(105, 102, 102);
    background-size: cover;
    background-repeat: no-repeat;
}



form {
   box-shadow: 0 0 5px black;
   border-radius: 8px;
   height: 85vh;
   width: 35vw;
   background-color:  rgba(255, 254, 254, 0.473);
   padding-top: 0.3rem;
   
}

form h1  {
    text-align: center;
    color: white;
    text-shadow: 0 0 3px rgba(255, 253, 253, 0.685);
}

form h3 {
    padding-top: 0.7rem;
    padding-left: 2rem;
    color: white;
    text-shadow: 0 0 3px rgba(255, 253, 253, 0.685);
}

form input {
    font-size: 1.1rem;
    margin-top: 0.5rem;
    margin-left: 2rem ;
    height: 1.5rem;
    width: 23rem;
    border: none;
    border-bottom: 2px solid;
    background-color: transparent ;
    outline: none;
    font-weight: 600;
}

form input[type="submit"] {
    border: none;
    border-radius: 4px;
    background-color: rgb(255, 42, 0);
    width: 15rem;
    height: 2.5rem;
    font-weight: bolder;
    color: white;
    margin-left: 1rem;
    margin-right: 1rem;
    text-shadow: 0 0 3px black;
    margin-top: 2.5rem;
    cursor: pointer;
}

a {
    padding: .75rem 1rem;
    background-color: skyblue;
    border-radius: 5px;
    text-decoration: none;
    color: white;
    font-weight: bolder;
    text-shadow: 0 0 3px black;
}

.input-gambar {
    width: 19.5rem;
    background-color: rgba(0, 0, 0, 0.300);
    border: 2px gray;
    border-radius: 10px;
    block-size: 1.7rem;
    font-size: 1.2rem;
    box-shadow: 0 0 5px black;
    margin-left: 4rem;
    font-weight: normal;
}

.imek {
    margin-top: 1.1rem;
}
</style>