<!DOCTYPE html>
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<head>
<meta charset="UTF-8" />
<title><?php echo $title; ?></title>
<base href="<?php echo $base; ?>" />
<?php if ($description) { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php } ?>
<?php if ($keywords) { ?>
<meta name="keywords" content="<?php echo $keywords; ?>" />
<?php } ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
<script type="text/javascript" src="<?php echo TPL_JS; ?>jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="<?php echo TPL_JS; ?>bootstrap/js/bootstrap.min.js"></script>
<link href="<?php echo TPL_JS; ?>bootstrap/less/bootstrap.less" rel="stylesheet/less" />
<script src="<?php echo TPL_JS; ?>bootstrap/less-1.7.4.min.js"></script>
<link href="<?php echo TPL_JS; ?>font-awesome/css/font-awesome.min.css" type="text/css" rel="stylesheet" />
<link href="<?php echo TPL_JS; ?>summernote/summernote.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo TPL_JS; ?>summernote/summernote.js"></script>
<script src="<?php echo TPL_JS; ?>datetimepicker/moment.js" type="text/javascript"></script>
<script src="<?php echo TPL_JS; ?>datetimepicker/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<link href="<?php echo TPL_JS; ?>datetimepicker/bootstrap-datetimepicker.min.css" type="text/css" rel="stylesheet" media="screen" />
<link type="text/css" href="view/stylesheet/stylesheet.css" rel="stylesheet" media="screen" />
<?php foreach ($styles as $style) { ?>
<link type="text/css" href="<?php echo $style['href']; ?>" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
<?php } ?>
<?php foreach ($links as $link) { ?>
<link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
<?php } ?>
<script src="view/javascript/common.js" type="text/javascript"></script>
<script src="<?php echo TPL_JS ?>scrolltop.js" type="text/javascript"></script>
<?php foreach ($scripts as $script) { ?>
<script type="text/javascript" src="<?php echo $script; ?>"></script>
<?php } ?>
</head>
<body>
<div id="container">
<header id="header" class="navbar navbar-static-top">
    <div class="navbar-header">
        <?php if ($logged) { ?>
        <a type="button" id="button-menu" class="pull-left"><i class="fa fa-indent fa-lg"></i></a>
        <?php } ?>
        <a href="<?php echo $home; ?>" class="navbar-brand">
            <img src="view/image/logo.png" alt="<?php echo $heading_title; ?>" title="<?php echo $heading_title; ?>" />
        </a>
    </div>
    
    <ul class="nav pull-right">
        <?php if (!$logged) { ?>
        <li class="dropdown" >
            <div class="btn-group">
                <form action="<?php echo $lang_action; ?>" method="post" id="language">
                    <button class="btn btn-link dropdown-toggle" data-toggle="dropdown">
                        <?php foreach ($languages as $language) { ?>
                        <?php if ($language['code'] == $code) { ?>
                        <img src="<?php echo TPL_IMG ?>flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>">
                        <?php } ?>
                        <?php } ?>
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <?php foreach ($languages as $language) { ?>
                        <li style="min-width: 150px;">
                            <a href="<?php echo $language['code']; ?>">
                                <img src="<?php echo TPL_IMG ?>flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" /> 
                                <?php echo $language['name']; ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <input type="hidden" name="code" value="<?php echo $code ?>" />
                    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                </form>
            </div>
        </li> 
    <?php }else { ?>

        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">
                <span class="label label-danger pull-left"><?php echo $alerts; ?></span> 
                <i class="fa fa-bell fa-lg"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-right alerts-dropdown">
                <li class="dropdown-header"><?php echo $text_ads; ?></li>
                <li>
                    <a href="<?php echo $confirmed_publish; ?>" style="display: block; overflow: auto;">
                        <span class="label label-primary pull-right"><?php echo $confirmeds; ?></span>
                        <?php echo $text_confirmed_publish; ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $opening_publish; ?>">
                        <span class="label label-success pull-right"><?php echo $openings; ?></span>
                        <?php echo $text_published_opening; ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $failed_publish; ?>">
                        <span class="label label-warning pull-right"><?php echo $faileds; ?></span>
                        <?php echo $text_failed_publish; ?>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $demotion; ?>">
                        <span class="label label-danger pull-right"><?php echo $demotion_total; ?></span>
                        <?php echo $text_demotion; ?>
                    </a>
                </li>
                <li class="divider"></li>
                <li class="dropdown-header"><?php echo $text_customer; ?></li>
                <li>
                    <a href="<?php echo $customer_message; ?>">
                        <span class="label label-danger pull-right"><?php echo $message_total; ?></span>
                        <?php echo $text_message; ?>
                    </a>
                </li>
                
            </ul>
        </li>
        <li>
            <a href="<?php echo $dashboard; ?>" data-toggle="tooltip" title="<?php echo $text_dashboard?>">
                <i class="fa fa-dashboard fa-lg"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo $balance; ?>" data-toggle="tooltip" title="<?php echo $text_balance;?>">
                <i class="fa fa-cny fa-lg"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo $profile; ?>" data-toggle="tooltip" title="<?php echo $text_profile;?>">
                <i class="fa fa-gear fa-lg"></i>
            </a>
        </li>
        <li><a href="<?php echo $front ?>" target="_blank"><i class="fa fa-life-ring fa-lg"></i></a></li>

        <li>
            <a href="<?php echo $logout; ?>">
                <span class="hidden-xs hidden-sm hidden-md"><?php echo $text_logout; ?></span> 
                <i class="fa fa-sign-out fa-lg"></i>
            </a>
        </li>
    <?php }?>    
    </ul>
</header>
