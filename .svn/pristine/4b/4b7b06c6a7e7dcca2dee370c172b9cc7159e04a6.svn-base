<!DOCTYPE html>
<!--[if lt IE 9]>
<div style='border: 1px solid #F7941D; background: #FEEFDA; text-align: center; clear: both; height: 60px; position: relative; z-index:5000;' id="forie"> 
    <div style='width:680px;margin: 0 auto;text-align: left; padding: 0; overflow: hidden; color: black;'> 
        <div style='width: 35px; float: left;'>
        <img src='<?php echo TPL_IMG ?>warning.jpg' alt='Warning!' width="33px"/>
        </div> 
        <div style=' float: left; font-family: Arial, sans-serif; color:#000'> 
            <div style='font-size: 14px; font-weight: bold; margin-top: 6px; color:#000'>
            <?php echo $text_browser_title; ?>
            </div> 
            <div style='font-size: 12px; margin-top: 6px; line-height: 12px; color:#000'>
            <?php echo $text_browser_text; ?>
            </div> 
        </div>

    </div>
</div>
<![endif]-->
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content= "<?php echo $keywords; ?>" />
<?php } ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<?php if ($icon) { ?>
<link href="<?php echo $icon; ?>" rel="icon" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="<?php echo TPL_JS ?>jquery-1.11.2.min.js" type="text/javascript"></script>
<link href="<?php echo TPL_JS ?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen" />
<script src="<?php echo TPL_JS ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<link href="<?php echo TPL_JS ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<link href="member/view/theme/default/stylesheet/stylesheet.css" rel="stylesheet">
<?php foreach ($styles as $style) { ?>
<link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<script src="member/view/javascript/common.js" type="text/javascript"></script>
<script src="<?php echo TPL_JS ?>scrolltop.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script src="<?php echo $script; ?>" type="text/javascript"></script>
<?php } ?>
</head>
<body class="<?php echo $class; ?>">
<nav id="top">
    <div class="container">
        <div class="pull-left" >
            <div id="logo">
                <?php if ($logo) { ?>
                <a href="<?php echo $home; ?>"><img src="<?php echo $logo; ?>" title="<?php echo $name; ?>" alt="<?php echo $name; ?>" class="img-responsive" /></a>
                <?php } else { ?>
                <h1><a href="<?php echo $home; ?>"><?php echo $name; ?></a></h1>
                <?php } ?>
            </div>
        </div>
        <div id="top-links" class="nav pull-right">
            <?php echo $language; ?>
            <?php if($logged && false){ ?>
            <ul class="list-inline">
                <li class="dropdown">
                    <a href="<?php echo $account; ?>" title="<?php echo $text_account; ?>" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-user"></i> 
                        <span id="welcome" class="hidden-xs hidden-sm hidden-md"><?php echo $text_account; ?></span> 
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li><a href="<?php echo $account; ?>"><?php echo $text_account; ?></a></li>
                        <li><a href="<?php echo $advertise; ?>"><?php echo $text_advertise; ?></a></li>
                        <li><a href="<?php echo $logout; ?>"><?php echo $text_logout; ?></a></li>
                    </ul>
                </li>
            </ul>
            <?php }?>
        </div>        
    </div>
</nav>

<?php if ($categories) { ?>
<div class="container">
    <nav id="menu" class="navbar">
        <div class="navbar-header">
            <span id="category" class="visible-xs"><?php echo $text_category; ?></span>
            <button type="button" class="btn btn-navbar navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"><i class="fa fa-bars"></i></button>
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <?php foreach ($categories as $category) { ?>
                <?php if ($category['children']) { ?>
                <li class="dropdown">
                    <a href="<?php echo $category['href']; ?>" class="dropdown-toggle" data-toggle="dropdown"><?php echo $category['name']; ?></a>
                    <div class="dropdown-menu">
                        <div class="dropdown-inner">
                          <?php foreach (array_chunk($category['children'], ceil(count($category['children']) / $category['column'])) as $children) { ?>
                            <ul class="list-unstyled">
                                <?php foreach ($children as $child) { ?>
                                <li><a href="<?php echo $child['href']; ?>"><?php echo $child['name']; ?></a></li>
                                <?php } ?>
                            </ul>
                          <?php } ?>
                        </div>
                      <a href="<?php echo $category['href']; ?>" class="see-all"><?php echo $text_all; ?> <?php echo $category['name']; ?></a> 
                    </div>
                </li>
                <?php } else { ?>
                <li><a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a></li>
                <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </nav>
</div>
<?php } ?>
