<?php require_once __DIR__ . "/header.php";
$url = $_SERVER['REQUEST_URI'];
switch ($url) {
    case '/': ?>
        <div id="content" class="w3-large">
            <div class="w3-container" id="">
                <div class="w3-content" style="max-width:700px">
                    <h1 class="w3-center w3-padding-64"><span class="w3-tag w3-wide">Search Ranking Factor Explorer</span></h1>
                </div>
            </div>
        </div>
    <?php
}

if (preg_match('#/tag/TG_(.*)#', $url, $params)) {
    include 'tag-template.php';
} else if (preg_match('#/factor/(.*)#', $url, $params)) {
    include 'factor-template.php';
}
?>

<?php require_once __DIR__ . "/footer.php"; ?>