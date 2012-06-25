<!DOCTYPE html>
<html lang="zh-CN">
    <head>
        <meta charset="utf-8">
            <title>OmarHub By BigImpact</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="description" content="">
            <meta name="author" content="BigImpact 小组">
            <!-- Le styles -->
                <link href="/assets/css/bootstrap.css" rel="stylesheet">
                <link href="/assets/css/bigimpact.css" rel="stylesheet">
                 <?php if ( isset ($css) && ! empty($css)): ?>
                    <?php print $css; ?>
                <?php endif ?>
                            
            <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
            <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <![endif]-->
            <!-- Le fav and touch icons -->         
            <link rel="shortcut icon" href="/assets/ico/favicon.ico">
    </head>

    <body>
    <div class="container">

        <?php if ( isset ($content) && ! empty($content)): ?>
            <?php print $content; ?>
        <?php endif ?>
            
    </div> 
    <!-- /container -->
    <!--[if IE 6]>
    <script src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.zh_CN.pack.js"></script>
    <![endif]-->
        <script src="/assets/js/jquery-1.7.2.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script> 
        <script src="/assets/js/application.js"></script>
         <?php if ( isset ($js) && ! empty($js)): ?>
            <?php print $js;?>
        <?php endif ?>  
    </body>
</html>
