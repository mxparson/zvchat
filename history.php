<?php
$msg = nl2br(file_get_contents('./all.txt'));
header('content-type:text/html;charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>聊天记录</title>
<script>
setInterval((function(){var d = new Date();document.getElementById('history_look').innerHTML='<a href="history.php?t=' + d.getTime() +'">刷新聊天记录</a>';}), 1000);
</script>
</head>
<body>
<span id="history_look"></span>
<br />
<?php echo $msg; ?>
</body>
</html>

