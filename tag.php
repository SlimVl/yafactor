<?php require_once __DIR__ . "/header.php";
include_once "config/boot.php";
$database = new Database();
$db = $database->getConnection();

$sth = $db->prepare("SELECT `tags` FROM `factor`");
$sth->execute();

$row = $sth->fetchAll(PDO::FETCH_ASSOC);
?>

<div id="content" class="w3-large">
    <div class="w3-container" id="">
        <div class="w3-content" style="max-width:900px">
            <div class="heading-wrapper w3-padding-64">
                <h1 class="w3-center"><span class="w3-tag w3-wide">All Tags</span></h1>
            </div>
            <?php
            $str = '';
            for ($i = 0; $i < count($row); $i++) {
                $str .= ',' . $row[$i]["tags"];
            }
            $str = str_replace(" ", "", $str);
            $str = explode(",", $str);
            $result = array_count_values($str);
            arsort($result);
            ?>
            <table class="w3-table w3-bordered">
                <thead>
                    <tr>
                        <th>Tag</th>
                        <th>Number of Factors</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    if(count($row))
                    {
                        $end_result = '';
                        foreach($result as $k => $v)
                        {
                            if ($k == '') continue;
                            $end_result .= "<tr>";
                            $end_result .= "<td>";
                            $end_result .= "<a class='tag_click' href='/tag/" . $k . "'>" . str_replace('tg', '', str_replace('_', ' ', mb_strtolower($k))) . "</a>";
                            $end_result .= "</td>";
                            $end_result .= "<td>";
                            $end_result .= $v;
                            $end_result .= "</td>";
                            $end_result .= "</tr>";
                        }
                        echo $end_result;
                    }
                    else
                    {
                        echo '<li>Ничего не найдено</li>';
                    }
                    ?>
                </tbody>
            </table>
            <div style="text-align: center">
                <div id="searchresults">Результат запроса для <span class="word"></span></div>
                <ul id="results" class="update">
                </ul>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    // jQuery(function($) {
    //
    //     $(".tag_click").click(function(e) {
    //         e.preventDefault();
    //         $(this).toggleClass("active");
    //
    //         var tag = $(this).attr("href");
    //         let data = tag.split('/tag/')[1];
    //         // вызов ajax
    //         $.ajax({
    //             type: "POST",
    //             url: "tg.php",
    //             data: data,
    //             beforeSend: function(html) { // действие перед отправлением
    //                 $("#results").html('');
    //                 $("#searchresults").show();
    //                 $(".word").html(data);
    //             },
    //             success: function(html){ // действие после получения ответа
    //                 $("#results").show();
    //                 $("#results").append(html);
    //             }
    //         });
    //         return false;
    //     });
    // });
</script>

<?php require_once __DIR__ . "/footer.php"; ?>
