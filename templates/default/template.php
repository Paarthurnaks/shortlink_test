<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/templates/default/main.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <title>Сократитель ссылок</title>
</head>
<body>
<div class="container">
    <form class="ui-form" method="POST" action="../../index.php">
        <span class="ui-label">Оригинальная ссылка</span><br>
        <input class="ui-input-text" id="form0_link" name="original_link" type="text" placeholder="например: https://google.com/">
        <button type="submit" onclick="AjaxQuery();" class="ui-execute">Сократить</button>
    </form>
    <span class="ui-subtitle" id="shortlink_result"></span>
</div>
<? echo '<script src="/templates/default/script.js?'.time().'"></script>'; ?>
</body>
</html>