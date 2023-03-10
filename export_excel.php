<?php
include 'config.php';

$name_channel = $_GET['name'];
?>

<a href="index.php">HOME</a>
<div style="text-align: center;">
    <h3><?= $name_channel?></h3>
</div>
<br>
<form action="" method="post">
    <input type="hidden" name="category" value="<?= $name_channel?>">
    <button type="submit" name="reset">Reset</button>
</form>
<?php
if (isset($_POST['reset'])) {
    $q = mysqli_query($con, "SELECT * FROM export_excel WHERE category = '".$_POST['category']."'");
    while ($dt = mysqli_fetch_array($q)) {
        unlink("download/".$dt['name']);
        mysqli_query($con, "DELETE FROM export_excel WHERE id = '".$dt['id']."'");
    }
}
?>
<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Nama File</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $q = mysqli_query($con, "SELECT * FROM export_excel WHERE category = '$name_channel' ORDER BY date DESC");
        while ($dt = mysqli_fetch_array($q)) {
            ?>
            <tr>
                <td><?= $no++?></td>
                <td><a href="download/<?= $dt['name']?>"><?= $dt['name']?></a></td>
                <td><?= $dt['date']?></td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>