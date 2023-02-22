<!DOCTYPE html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="<?php $_SERVER["DOCUMENT_ROOT"] ?>/main.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script type="text/javascript">

        jQuery(function($) {

            $(".w3-button").click(function() {
                // получаем строку, которую ввел пользователь
                var searchString    = $(".w3-input").val();

                // формируем поисковый запрос
                var data = 'search='+ searchString;

                // если введенная информация не пуста
                if(searchString) {

                    // вызов ajax
                    $.ajax({
                        type: "POST",
                        url: "search.php",
                        data: data,
                        beforeSend: function(html) { // действие перед отправлением
                            $("#results").html('');
                            $("#searchresults").show();
                            $(".word").html(searchString);
                        },
                        success: function(html){ // действие после получения ответа
                            console.log(searchString);
                            $("#results").show();
                            $("#results").append(html);
                        }
                    });
                }
                return false;
            });
        });
    </script>
</head>
<header>
    <div class="w3-top">
        <div id="main-nav" class="w3-row w3-padding w3-black">
            <div class="menu-item ">
                <a href="/" class="w3-buttons w3-block w3-black">Home</a>
            </div>

            <div class="menu-item ">
                <a href="/tag.php" class="w3-buttons w3-block w3-black">All Tags</a>
            </div>

            <div class="menu-item ">
                <a href="/group.php" class="w3-buttons w3-block w3-black">All Groups</a>
            </div>

            <div class="menu-item ">
                <a href="/srch.php" class="w3-buttons w3-block w3-black">Search</a>
            </div>
        </div>
    </div>
</header>