<?php require_once __DIR__ . "/header.php"; ?>

<body>
    <div id="content" class="w3-large">
        <div class="w3-container" id="">
            <div class="w3-content" style="max-width:900px">
                <div class="heading-wrapper w3-padding-64">
                    <h1 class="w3-center"><span class="w3-tag w3-wide">Search Results</span></h1>
                </div>
                <div class="menu-item w3-hide-small">
                    <form action="search.php" method="POST" id="main-search" class="w3-container w3-padding-0 w3-margin-0" style="display: flex;">
                        <input type="text" name="search" class="w3-input" style="border-radius: 10px 0 0 10px;" placeholder="Search">
                        <button type="submit" class="w3-button w3-dark-gray" style="border-radius: 0 10px 10px 0;">Go</button>
                    </form>
                </div>
                <div style="text-align: center">
                    <div id="searchresults">Результат поиска для <span class="word"></span></div>
                    <ul id="results" class="update">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

<?php require_once __DIR__ . "/footer.php"; ?>