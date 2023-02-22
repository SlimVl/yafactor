<?php

include_once "config/boot.php";
$database = new Database();
$db = $database->getConnection();

$word = array_keys($_POST);
$word = $word[0];

if (isset($word)) {
    $sth = $db->prepare("SELECT `name` FROM `factor` WHERE `tags` LIKE '%" . $word . "%'");
    $sth->execute();
    $row = $sth->fetchAll(PDO::FETCH_ASSOC);

    echo "<table class='w3-table w3-bordered'>
                <thead>
                    <tr>
                        <th>Factors</th>
                    </tr>
                </thead>
                <tbody>";

    if(count($row))
    {
        $end_result = '';
        foreach ($row as $r) {
            $end_result .= "<tr>";
            $end_result .= "<td>";
            $end_result .= $r['name'];
            $end_result .= "</td>";
            $end_result .= "</tr>";
        }
        echo $end_result;
    }
    echo "</tbody>
</table>";
}