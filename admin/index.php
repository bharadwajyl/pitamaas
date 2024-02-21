<?php
error_reporting(0);
//Global variables
$count = 1;

$roles = array("sd_0" => "Angular Developer", "sd_1" => "UI/UX Designer", "sd_2" => "PHP Developer", "sd_3" => "Application Developer", "sd_5" => "SDE III", "sd_5" => "React/ReactNative");

//Fetch details
@require("../route/db.php");  
$fetch = $conn->query("SELECT * FROM pitamaas");  
?>
<!DOCTYPE html>
<html lang="en">
<head>

<!--TITLE-->
<title>Pitamaas || Admin panel</title>

<!--SHORTCUT ICON-->
<link rel="shortcut icon" href="#" />

<!--META TAGS-->
<meta charset="UTF-8" />
<meta name="language" content="ES" />
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />

<!--FONT AWESOME-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

<!--ICONIFY-->
<script src="https://code.iconify.design/iconify-icon/1.0.7/iconify-icon.min.js"></script>

<!--PLUGIN-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<!--DATATABLES-->
<link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.min.css" />

<!--GOOGLE FONTS-->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,200;6..12,300;6..12,400;6..12,500;6..12,600;6..12,700;6..12,800;6..12,900;6..12,1000&display=swap" rel="stylesheet" />

<!--STYLE SHEET-->
<link rel="stylesheet" href="../assets/css/main.css" />
<link rel="stylesheet" href="assets/css/home.css" />

</head>
<body>

<!--MAIN-->
<main>
    <div class="divisions division_1 flex">
        <section class="left_content flex_content padding_2x">
            <table class="display">
                <thead>
                    <tr>
                        <th>slno</th>
                        <th>Job role</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if ($fetch->num_rows > 0){
                            while($rows = $fetch->fetch_assoc()){
                                echo '
                                    <tr class="table-card card sd_'.$count.'">
                                        <td>'.$count.'</td>
                                        <td>'.$roles[$rows["role"]].'</td>
                                        <td>'.$rows["fname"].'</td>
                                    </tr>
                                ';
                                $count++;
                            }
                        }
                    ?>
                </tbody>
            </table>
        </section>
        <section class="right_content">
        </section>
    </div>
</main>

<!--ADDITIONAL-->

<!--DATATABLES-->
<script type="text/javascript" src="https://cdn.datatables.net/2.0.0/js/dataTables.min.js"></script>
<!--JAVASCRIPT-->
<script type="text/javascript" src="../assets/js/main.js"></script>
<script type="text/javascript" src="assets/js/home.js"></script>
<script type="text/javascript" src="../assets/js/home.js"></script>
<script type="text/javascript" src="../assets/js/ajax.js"></script>

</body>
</html>
