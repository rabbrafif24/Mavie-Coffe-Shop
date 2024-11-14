<?php
include("../koneksi.php");

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];

    // File upload handling
    $img = $_FILES['img']['name'];
    $img_temp = $_FILES['img']['tmp_name'];
    $uploadDirectory = "../img-product/";

    // Periksa apakah gambar baru diunggah
    if (!empty($img)) {
        // Jika gambar baru diunggah, pindahkan ke direktori
        $targetFile = $uploadDirectory . $img;
        move_uploaded_file($img_temp, $targetFile);
    } else {
        // Jika tidak ada gambar baru diunggah, gunakan gambar yang ada
        $result = mysqli_query($koneksi, "SELECT img FROM product WHERE id=$id");
        $row = mysqli_fetch_assoc($result);
        $img = $row['img'];
        $targetFile = $uploadDirectory . $img;
    }

    // Update database dengan data baru
    $result = mysqli_query($koneksi, "UPDATE product SET judul='$judul', kategori='$kategori', harga='$harga', stok='$stok', img='$img' WHERE id=$id");

    if ($result) {
        // Database update successful
        header("Location: data.php");
    } else {
        // Database update failed
        echo "Error updating record: " . mysqli_error($koneksi);
    }
}

$id = $_GET['id'];
$result = mysqli_query($koneksi, "SELECT * FROM product WHERE id=$id");
while ($user_data = mysqli_fetch_array($result)) {
    $judul = $user_data['judul'];
    $kategori = $user_data['kategori'];
    $harga = $user_data['harga'];
    $stok = $user_data['stok'];
    $img = $user_data['img']; // Gambar yang sudah ada di database
}
?>

<html>

<head>
    <title>Edit Data buku</title>
</head>

<body>

    <form name="update_user" method="post" action="edit.php" enctype="multipart/form-data">

        <h1>Edit Data </h1>
        <h3>Judul</h3>
        <input type="text" name="judul" value="<?= $judul; ?>">

        <h3>Kategori</h3>
        <input type="text" name="kategori" value="<?= $kategori; ?>">

        <h3>Harga</h3>
        <input type="text" name="harga" value="<?= $harga; ?>">

        <h3>Stok</h3>
        <input type="text" name="stok" value="<?= $stok; ?>">

        <h3 class="imek">Image Book</h3>
        <input type="file" name="img" class="input-gambar"> <!-- Gunakan ini untuk mengunggah gambar baru -->


        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
        <input type="submit" name="update" value="Update">
    </form>
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
    background-color:  rgba(77, 76, 76, 0.836);
    background-size: cover;
    background-repeat: no-repeat;
}



form {
    box-shadow: 0 0 5px black;
    border-radius: 8px;
    height: 85vh;
    width: 35vw;
    background-color: rgba(77, 76, 76, 0.275);
    padding-top: 0.3rem;

}

form h1 {
    text-align: center;
    color: white;
    text-shadow: 0 0 5px black;
}

form h3 {
    padding-top: 0.7rem;
    padding-left: 2rem;
    color: white;
    text-shadow: 0 0 3px black;
}

form input {
    font-size: 1.1rem;
    margin-top: 0.5rem;
    margin-left: 2rem;
    height: 1.5rem;
    text-shadow: 0 0 4px white;
    width: 23rem;
    border: none;
    border-bottom: 2px solid;
    background-color: transparent;
    outline: none;
    font-weight: 600;
}

form input:last-child {
    border: none;
    border-radius: 4px;
    background-color: orangered;
    width: 15rem;
    height: 2.5rem;
    margin-left: 5.5rem;
    font-weight: bolder;
    color: white;
    cursor: pointer;
    text-shadow: 0 0 3px black;
    margin-top: 2.5rem;
}

.input-gambar {
    width: 19.5rem;
    background-color: rgba(0, 0, 0, 0.300);
    border: 2px gray;
    border-radius: 10px;
    text-shadow: none;
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