<ul id="menu">
<?php foreach ($menu_nodes as $key => $menu){ ?>
<?php if(isset($menu['children']) && count($menu['children'])){ ?>
    <li id="<?php echo strtolower($menu['key']); ?>">
        <a class="parent">
            <i class="<?php echo $menu['note']; ?>"></i>
            <span><?php echo $menu['name'];?></span>
        </a>
        <ul>
        <?php foreach ($menu['children'] as $child){ ?>
        <?php if(isset($child['children']) && count($child['children']) ){ ?>
            <li>
                <a class="parent">
                    <i class="<?php echo $child['note']; ?>"></i>
                    <span><?php echo $child['name'];?></span>
                </a>
                <ul>
                <?php foreach ($child['children'] as $third){ ?>
                <?php if(isset($third['children']) && count($third['children']) ){ ?>
                    <li>
	                    <a class="parent">
		                    <i class="<?php echo $third['note']; ?>"></i>
		                    <span><?php echo $third['name'];?></span>
		                </a>
		                <ul>
		                	<?php foreach ($third['children'] as $last){ ?>
                            <?php if(!empty($last['path'])){ ?>
		                	<li>
		                	<a href="<?php echo str_replace('__PATH__',$last['path'],$url_tpl);?>"><?php echo $last['name']?></a>
		                	</li>
		                	<?php }?>
                            <?php }?>
                        </ul>
                    </li>
                <?php }else { ?>
                    <?php if(!empty($third['path'])){ ?>
                    <li>
                        <a href="<?php echo str_replace('__PATH__',$third['path'],$url_tpl);?>"><?php echo $third['name']?></a>
                    </li>
                    <?php } ?>
                <?php } ?>
                <?php } ?>
                </ul>
            </li>
        <?php }else{ ?>
            <?php if(!empty($child['path'])){ ?>
            <li>
                <a href="<?php echo str_replace('__PATH__',$child['path'],$url_tpl);?>">
                    <span><?php echo $child['name'];?> </span>
                </a>
            </li>
            <?php } ?>
        <?php } ?>
        <?php } ?>
        </ul>
    </li>
    <?php }else{ ?>
    <?php if(!empty($menu['path'])){ ?>
    <li id="<?php echo strtolower($menu['key']); ?>">
        <a href="<?php echo str_replace('__PATH__',$menu['path'],$url_tpl);?>">
            <i class="<?php echo $menu['note'] ?> "></i> <span><?php echo $menu['name'];?> </span>
        </a>
    </li>
    <?php } ?>
<?php } ?>
<?php } ?>
</ul>

<script type="text/javascript">
$(function(){
    for (var i = 4; i >= 0; i--) {
        $.each($('#menu ul'),function(){
            if($(this).children('li').length==0){
                $(this).parent().remove();
            }
        });        
    }      
})

</script>