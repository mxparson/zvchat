
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
	<title>聊天室 - Powered by zvchat</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.8.1/build/reset-fonts-grids/reset-fonts-grids.css">

<script src="http://code.jquery.com/jquery-1.4.2.min.js"></script>
<script>
$(document).ready(function(){
	connect();
	$('#word').keydown(function(e){
		if(e.keyCode == 13)
		{
			send();return false;
		}
	});
	$('#send').click(function(){
		send();return false;
	});
	if($("#usernameSpan").html() == "")
	{
		gotName();
	}
});


var timestamp = 0;
var url = 'backend.php';
var error = false;
function connect(){
    var d = new Date();
	$.ajax({
        data : {'timestamp' : timestamp, 't' : d.getTime()},
			url : url,
			type : 'get',
			dataType : 'json',
			timeout : 0,
            success : function(data){

				if(null != data)
				{
					timestamp = data.timestamp;
					if(data.msg != "")
					{
						$("#content").prepend('<div>' + data.msg + '</div>');
					}
				}
			},
				complete : function(){
					connect();
				}
	})
}
function send(msg){
	$.ajax({
		data : {'username' : $('#username').val(),'msg' : $('#word').val()},
			type : 'get',
			url : url,
			complete : function (){
				$('#word').val("");
			}
	})
}
function gotName()
{
	var name = prompt("请输入您的名字","");
	if( name != null && name != "")
	{
		$("#usernameSpan").html(name);
		$("#username").val(name);
	}
	else
	{
		gotName();
	}
}
setInterval((function(){var d = new Date();document.getElementById('history_look').innerHTML='<a href="history.php?t=' + d.getTime() +'" target="_blank">聊天记录</a>';}), 1000);
</script>
  </head>
  <body>

<div style="float: right;text-align:left;">

<pre>
zvchat 2.1.6 beta

zvchat 2.1.6 版采用新的comet架构，解决了消息实时互通的重大障碍。
Alpha版主要测试消息队列功能，界面和其它功能还在开发中。
如果消息队列比较稳定了 。后面的开发工作会比较顺利.
zvchat有望实现消息即时互通,长期困扰开发的难题有望被攻破了。

项目地址：http://zvchat.googlecode.com

zvchat 2.1.6版会是一个独立运行的版本，不依赖Mysql,不依赖其它组件.
只要支持php，就可以安装运行zvchat。欢迎加qq群 63490795交流互动。

作者主页：

<a href="http://www.netroby.com/">http://www.netroby.com/</a>

演示地址：

<a href="http://www.netroby.com/zvchat/">http://www.netroby.com/zvchat/</a>
</pre>
</div>

  <div style="text-align:left;margin:5px;">
<input type="hidden" name="username" id="username" value="" size="4" />
<span id="usernameSpan"></span>
	  <input type="text" name="word" id="word" value="" size="24" style="width:500px;height:20px;font-size:12px;"  />
      <input type="button" id="send" value="发 送" style="border:#DDD 1px solid;background-color:#EEE;padding:5px;color:#333; font-size:14px;" />
      <span id="history_look"></span>
  </div>

  <div id="content" style="width:650px;height:500px;overflow-y:scroll;text-align:left;margin:5px;padding:5px;background-color:#EEE;">
<?php $ef = explode("\r\n" , file_get_contents('./all.txt')); foreach ($ef as $k => $v) { if ($k <= 10  ) { if ($k > 0) { echo $k .':' . $v . "<br />\r\n"; } } } ?>
  </div>

<div style="text-align:left;padding-left:100px;">
<a href="http://www.netroby.com">zvchat 2.1.6</a>
</div>
  </body>
</html>

