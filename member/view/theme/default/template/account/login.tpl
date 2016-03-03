<?php echo $header; ?>
<header></header>
<div class="container">
    <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
    </ul>

    <?php if ($success) { ?>
    <div class="alert alert-success"><i class="fa fa-check-circle"></i> <?php echo $success; ?></div>
    <?php } ?>
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
    <?php } ?>
    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="row">
                <div class="col-sm-7">
                    <?php if(false){ ?>
                    <div class="well">
                      <h2><?php echo $text_new_customer; ?></h2>
                      <p><strong><?php echo $text_register; ?></strong></p>
                      <p><?php echo $text_register_account; ?></p>
                      <a href="<?php echo $register; ?>" class="btn btn-primary"><?php echo $button_continue; ?></a>
                    </div>
                    <?php }else{?>
                    <img src="<?php echo TPL_IMG.'catalog/focus.jpg' ?>" alt="Focus Image" class="img-rounded">
                    <?php }?>
                </div>
                <div class="col-sm-5">
                    <div class="well">
                        <h2><?php echo $text_sign_in; ?></h2>
                        <p></p>
                        <form action="<?php echo $action; ?>" method="post" id="account-login">
                            <div class="form-group">
                                <label class="control-label" for="input-customer-sn"><?php echo $entry_username; ?></label>
                                <input type="text" name="username" value="<?php echo $username; ?>" placeholder="<?php echo $entry_username; ?>" id="input-customer-sn" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-password"><?php echo $entry_password; ?></label>
                                <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>" id="input-password" class="form-control" />
                                <a href="<?php echo $forgotten; ?>"><?php echo $text_forgotten; ?></a>
                            </div>
                            <button from="account-login" class="btn btn-primary"><?php echo $button_login; ?></button>
                            <?php if ($redirect) { ?>
                            <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body></html>