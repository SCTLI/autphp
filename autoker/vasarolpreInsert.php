<?php
include_once ('common/dbfunctions.php');
$autoAlvazszam = $_POST['alvazszam'];
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>KIválaszott autó lefogalála</title>
    <link rel="stylesheet" type="text/css" href="css/alap.css">
    <link rel="icon" href="image/icon.png" type="image/icon">
    <meta charset="utf-8" />
</head>
<body>
<h1 class="kozepre">Az autó lefoglalálásához kérem töltse ki az alábbi űrlapot</h1>
<form method="post" action="Insert/vasarolInsert.php" class="kozepre">
    <input type="hidden" name="alvazszam" value="<?php echo $autoAlvazszam ?>" />
    <label>Melyik üzletben szeretné átvenni:</label>
    <select name="uzletid">
        <?php
        $stid = getUzletList();
        oci_execute($stid);
        while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo '<option value="'.$row['uzletid'].'">'.$row['nev'].'-'.$row['varos'].'</option>';
        }
        ?>
    </select>
    <br />
    <label>*Ideiglenes(ezt késöbb a bejelentkezett sessesionből szedjük majd ki)*KI veszi az autót</label>
    <select name="igszam">
        <?php
        $stid = getUgyfelList();
        oci_execute($stid);
        while ( $row = oci_fetch_array($stid, OCI_ASSOC + OCI_RETURN_NULLS)) {
            echo '<option value="'.$row['igsz'].'">'.$row['nev'].'</option>';
        }
        ?>
    </select>
    <input type="submit" value="Lefoglalás">
</form>
</body>
</html>