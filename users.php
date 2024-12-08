<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Pendaftaran PKL</h2>

    <?php
    $connection = pg_connect("host=localhost dbname=pkl_sarastya user=postgres password=gilang88");
    if (!$connection) {
        echo "An error occured.<br>";
        exit;
    }

    $result = pg_query($connection, "SELECT * FROM users");
    if (!$result) {
        echo "An error occured.<br>";
        exit;
    }
    ?>

    <table>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Jurusan</th>
            <th>Tempat Lahir</th>
            <th>Tanggal Lahir</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Date</th>
        </tr>


        <?php
        while($row = pg_fetch_assoc($result)) {
            echo "
            <tr>
            <th>$row[Id]</th>
            <th>$row[Username]</th>
            <th>$row[Email]</th>
            <th>$row[Password]</th>
            <th>$row[Nama]</th>
            <th>$row[Kelas]</th>
            <th>$row[Jurusan]</th>
            <th>$row[Tempat_Lahir]</th>
            <th>$row[Tanggal_Lahir]</th>
            <th>$row[Alamat]</th>
            <th>$row[No_Telp]</th>
            <th>$row[Created_At]</th>
           </tr>
           ";
        }

        ?>
    </table>
</body>
</html>