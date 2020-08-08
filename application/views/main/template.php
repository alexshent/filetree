<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<title><?php echo $title ?></title>
<?php
foreach ($CSS as $style_link) {
    echo "$style_link\n";
}

foreach ($JS as $script_link) {
    echo "$script_link\n";
}
?>
<link rel="stylesheet" href="/styles.css">
</head>

<body>
<div class="container">
<?php echo $body_content ?>
</div>
</body>

</html>
