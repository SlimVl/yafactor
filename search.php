<?php

include_once "config/boot.php";
$database = new Database();
$db = $database->getConnection();

if (isset($_POST['search']))
{
    $word = $_POST['search'];

    // формирование поискового запроса к базе
    $sth = $db->prepare("SELECT * FROM `factor` WHERE `CppName` LIKE '%" . $word . "%' OR `Name` LIKE '%" . $word . "%' OR `Tags` LIKE '%" . $word . "%' OR `Group` LIKE '%" . $word . "%'");
    $sth->execute();
    // получение результатов
    $row = $sth->fetchAll(PDO::FETCH_ASSOC);

    if(count($row))
    {
        $end_result = '';
        foreach($row as $r)
        {
            $tg = $r["Tags"];
            $lnk = $r['Name'];
            $result = $r['CppName'] . ' | ' . $r['Name'] . ' | ' . $r['Tags'];
            // выделим найденные слова
            $bold = '<span class="found">' . $word . '</span>';
            if (stristr($tg, 'TG_UNUSED') || $tg == 'TG_UNUSED' || stristr($tg, 'TG_DEPRECATED') || $tg == 'TG_DEPRECATED') {
                $end_result .= "<tr style='color: gray'>";
            } else {
                $end_result .= "<tr>";
            }
            $end_result .= "<td>";
            $end_result .= "<a href='/factor/{$lnk}'>" . $r['Name'] . "</a>";
            $end_result .= "</td>";
            $end_result .= "<td>";
            $end_result .= $r['Description'];
            $end_result .= "</td>";
            $end_result .= "</tr>";
        }
        echo "<table class='w3-table w3-bordered'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>";
        echo $end_result;
        echo "</tbody>";
    }
    else
    {
        echo '<li>Ничего не найдено</li>';
    }
}
?>