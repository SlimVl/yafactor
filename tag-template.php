<?php
include_once "config/boot.php";
$url = $_SERVER['REQUEST_URI'];
$url = explode('/', $url);
$url = end($url);
?>
<div id="content" class="w3-large">
    <div class="w3-container" id="">
        <div class="w3-content" style="max-width:900px">
            <div class="heading-wrapper w3-padding-64">
                <h1 class="w3-center"><span class="w3-tag w3-wide"><?=$url?></span></h1>
            </div>
        <?php
        $database = new Database();
        $db = $database->getConnection();

        $sth = $db->prepare("SELECT `name`, `description`, `tags` FROM `factor` WHERE `tags` LIKE '%" . $url . "%'");
        $sth->execute();

        $row = $sth->fetchAll(PDO::FETCH_ASSOC);

        echo "<table class='w3-table w3-bordered'>
                <thead>
                    <tr>
                        <th>Factors</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>";

        if(count($row))
        {
            $end_result = '';
            foreach ($row as $r) {
                $tg = $r["tags"];
//                var_dump(!strpos($tg, 'TG_UNUSED'));
                $lnk = $r['name'];
                if (stristr($tg, 'TG_UNUSED') || $tg == 'TG_UNUSED' || stristr($tg, 'TG_DEPRECATED') || $tg == 'TG_DEPRECATED') {
                    $end_result .= "<tr style='color: gray'>";
                } else {
                    $end_result .= "<tr>";
                }
                $end_result .= "<td>";
                $end_result .= "<a href='/factor/{$lnk}'>" . $r['name'] . "</a>";
                $end_result .= "</td>";
                $end_result .= "<td>";
                $end_result .= $r['description'];
                $end_result .= "</td>";
                $end_result .= "</tr>";
            }
            echo $end_result;
        }
        echo "</tbody>
            </table>";
        ?>
        </div>
    </div>
</div>

