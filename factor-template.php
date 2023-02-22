<?php
include_once "config/boot.php";
$url = $_SERVER['REQUEST_URI'];
$url = explode('/', $url);
$url = end($url);

$database = new Database();
$db = $database->getConnection();

$sth = $db->prepare("SELECT * FROM `factor` WHERE `name` = '$url'");
$sth->execute();

$row = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<div id="content" class="w3-large">
    <div class="w3-container" id="">
        <div class="w3-content" style="max-width:900px">
            <div class="heading-wrapper w3-padding-64">
                <h1 class="w3-center"><span class="w3-tag w3-wide"><?=$url?></span></h1>
            </div>
            <table class='w3-table w3-bordered'>
                <thead>
                    <tr>
                        <th>Key</th>
                        <th>Value</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $end_result = '';
                    foreach($row[0] as $k => $v) {
                        if ($v == NULL) continue;
                        $end_result .= "<tr>";
                        $end_result .= "<td>";
                        $end_result .= $k;
                        $end_result .= "</td>";
                        $end_result .= "<td>";
                        $end_result .= $v;
                        $end_result .= "</td>";
                        $end_result .= "</tr>";
                    }
                    echo $end_result;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>