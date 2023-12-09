<?php
$pageTitle = " Page Title ";
$siteName = " Site name ";

include_once 'head.php';
include_once 'header.php';
?>
<main style="clear: both; width: 100%">
    Главный контент сайта
    <div>
    <?php
        for ($i = 0; $i < 10; $i++) {
            include 'element1.php';
        }
    ?>
    </div>

</main>
<?php
include_once 'footer.php';
