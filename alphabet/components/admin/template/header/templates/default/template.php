<?
 use \Component\Engine as Component;
?>
<!DOCTYPE html>
<html lang="ru-RU">
	<head>
      <title><? echo $arParam['TITLE']; ?></title>
      <meta name="description" content=""/>
      <meta name="keywords" content=""/>
      <meta name="author" content=""/>
      <meta name="copyright" content="(c)Site\Company-Name">
      <meta http-equiv="Reply-to" content="mail@yandex.ru">
      <meta name="format-detection" content="telephone=no"/>
      <meta name="format-detection" content="address=no"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
      <meta name="apple-mobile-web-app-capable" content="yes"/>
      <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
      <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, maximum-scale=1.0"/>
      <meta http-equiv="cleartype" content="on"/>
      <link href="/css/style.css" rel="stylesheet" type="text/css"/>
      <link href="/css/clearsans/clearsans.css" rel="stylesheet" type="text/css"/>
      <link href="/css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
      <script type="text/javascript" src="/js/jquery.min.js"></script>
      <script type="text/javascript" src="/js/main.js"></script>
	</head>
	<body>
  	<div class="header-bg width100" align="center">
      <div class="header container">
				<?
				new Component(
					"admin:menu",
					'default',
					array(),
					array()
				);
				?>
      </div>
    </div>
