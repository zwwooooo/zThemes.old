<form id="searchform" method="get" action="<?php echo home_url(); ?>/">
<input type="text" value="<?php _e('type, hit enter','chocolate_pro'); ?>" onfocus="if (this.value == '<?php _e('type, hit enter','chocolate_pro'); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e('type, hit enter','chocolate_pro'); ?>';}" size="35" maxlength="50" name="s" id="s" />
<input type="submit" id="searchsubmit" value="<?php _e('SEARCH','chocolate_pro'); ?>" />
</form>