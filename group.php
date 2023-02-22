<?php

require_once __DIR__ . "/header.php";
include_once "config/boot.php";
$database = new Database();
$db = $database->getConnection();

$sth = $db->prepare("SELECT * FROM `factor` WHERE `Group` != ''");
$sth->execute();

$row = $sth->fetchAll(PDO::FETCH_ASSOC);
?>
<body>
<div style="text-align: center">
    <div id="searchresults">Результат поиска для <span class="word"></span></div>
    <ul id="results" class="update">
    </ul>
</div>
<div class="w3-content" style="max-width:100%">
    <div class="heading-wrapper w3-padding-64">
        <h1 class="w3-center"><span class="w3-tag w3-wide">All Groups</span></h1>
    </div>
    <table class="w3-table w3-bordered">
        <thead>
            <tr>
                <th>CppName</th>
                <th>Name</th>
                <th>Tags</th>
            </tr>
        </thead>
        <tbody>
<?php
if(count($row))
{
    $end_result = '';
    foreach($row as $r)
    {
        $lnk = $r['Name'];
        $tg = $r['Tags'];
        $tg = str_replace(" ", "", $tg);
        $tg = explode(",", $tg);
        $str = '';
        foreach ($tg as $tag) {
            $tg_link = $tag;
            $str .= ", " . "<a href='/tag/{$tg_link}'>" . $tag . "</a>";
        }
//        var_dump($str);
        $end_result .= "<tr>";
        $end_result .= "<td>";
        $end_result .= $r['CppName'];
        $end_result .= "</td>";
        $end_result .= "<td>";
        $end_result .= "<a href='/factor/{$lnk}'>" . $r['Name'] . "</a>";
        $end_result .= "</td>";
        $end_result .= "<td>";
        $end_result .= substr( $str, 2);
        $end_result .= "</td>";
        $end_result .= "</tr>";
    }
    echo $end_result;
    ?>

<?php
}
else
{
    echo '<li>Ничего не найдено</li>';
}
?>
        </tbody>
    </table>
</div>
</body>
<?php require_once __DIR__ . "/footer.php"; ?>
