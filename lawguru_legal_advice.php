<?php
	/*
		Plugin Name: LawGuru - Legal Advice
		Plugin URI: http://www.LawGuru.com/articles/tips/wordpress-lawguru-plugin/
		Description: Plugin for Lawguru Answers - configure in the Appearance widget editor, signup at lawguru.com/affiliates for an account
		Author: LawGuru.com (Lawguru Answers)
		Author URI: http://www.LawGuru.com/answers/ask/
		Version: 1.4
	*/

	function lawguru_legal_adviceinstall () {
		require_once(dirname(__FILE__).'/installer.php');
	}
	register_activation_hook(__FILE__,'lawguru_legal_adviceinstall');
		
	require_once(dirname(__FILE__).'/lawguru_legal_advice.function.php');	

	//Widget
	
	function widget_lawguru_legal_advice($args) {
		extract($args);
		$_affid = get_option("lawguru_legal_advice_affiliate");
		$_premium = '';
		 if (get_option("lawguru_legal_advice_allow_free") != 1)
		{ 
			$_premium = '/premium';
		}
		// $data = lawguru_legal_advice_get_data();
		// if(trim($quote) == '') 
			// return;		
		echo $before_widget;
?>
		<?php 
			if (get_option("lawguru_legal_advicetitle")!='')
				echo $before_title.get_option("lawguru_legal_advicetitle").$after_title;
		?>
		<div id="lawguru_legal_advice">	
			<form action="https://www.lawguru.com/answers/ask<?php echo $_premium ?>#a_aid=<?php echo $_affid; ?>" method="post" target="_blank" name="ask_form">
			<textarea name="question" rows="6" style="width: 100%; height: 40% overflow: auto; margin-bottom: 4px;" class="input1"></textarea><br>
			<div style="float: right; "><input class="ask_submit" value="Continue" type="submit"></div>
			</form>
			<div style="clear:both;"></div>
				 <?php if (get_option("lawguru_legal_advice_allow_link") != 0): ?><div style="text-align:right"><a href="http://lawguru.com/answers/ask<?php echo $_premium ?>" rel="section" title="Lawguru - Legal Advice"  onClick="appendLink('lgal2','<?php echo $_affid; ?>')" style="text-decoration:none;font-size:10px">Legal Advice</a> <a href="http://lawguru.com/answers/ask<?php echo $_premium ?>" rel="section" title="Lawguru - Legal Advice" onClick="appendLink('lgal2','<?php echo $_affid; ?>')" style="text-decoration:none;font-size:10px">by LawGuru.com</a></div> <?php endif; ?>
		<script language="JavaScript"><!--
		function appendLink(clink, append) {
			var element = document.getElementById( clink);
			   if ( element && element.href )
			   {
				 element.href + '#a_aid=' + append;
			   }
		}
		--></script>
		</div>
<?php		
		echo $after_widget;
	}

	function lawguru_legal_advicecontrol()
	{
		$title 		= 	get_option('lawguru_legal_advicetitle');
		$allow_free = 	get_option('lawguru_legal_advice_allow_free');
		$allow_link = 	get_option('lawguru_legal_advice_allow_link');
		$lgaaffiliate = get_option('lawguru_legal_advice_affiliate');

		if ($_POST['lawguru_legal_advicesubmit']){
			update_option("lawguru_legal_advicetitle", htmlspecialchars($_POST['lawguru_legal_advicetitle']));
			update_option("lawguru_legal_advice_allow_free", intval($_POST['lawguru_legal_advice_allow_free']));
			update_option("lawguru_legal_advice_allow_link", intval($_POST['lawguru_legal_advice_allow_link']));
			update_option("lawguru_legal_advice_affiliate", htmlspecialchars($_POST['lawguru_legal_advice_affiliate']));
		}
?>
		<table>
			<tr>
				<td width="150"><label for="lawguru_legal_advicetitle">Title</label></td>
				<td><input type="text" id="lawguru_legal_advicetitle" name="lawguru_legal_advicetitle" value="<?php echo $title; ?>" /></td>
			</tr>
			<tr>
				<td><label for="lawguru_legal_advice_allow_free">Allow Free Questions?</label></td>
				<td><input type="checkbox" id="lawguru_legal_advice_allow_free" name="lawguru_legal_advice_allow_free" value="1" <?php echo ($allow_free?'checked="checked"':''); ?>/></td>
			</tr>
				<tr>
				<td><label for="lawguru_legal_advice_allow_link">Enable Reciprocol Link?</label></td>
				<td><input type="checkbox" id="lawguru_legal_advice_allow_link" name="lawguru_legal_advice_allow_link" value="1" <?php echo 'checked="checked"'; ?>/></td>
			</tr>
			<tr>
				<td width="150"><label for="lawguru_legal_advice_affiliate">Affiliate ID</label></td>
				<td><input type="text" id="lawguru_legal_advice_affiliate" name="lawguru_legal_advice_affiliate" value="<?php echo $lgaaffiliate; ?>" /></td>
			</tr>
			
		</table>
		<input type="hidden" id="lawguru_legal_advicesubmit" name="lawguru_legal_advicesubmit" value="1" />
<?php
	}

	function widget_lawguru_legal_adviceinit()
	{
		register_sidebar_widget('Lawguru - Legal Advice', 'widget_lawguru_legal_advice');
		register_widget_control('Lawguru - Legal Advice', 'lawguru_legal_advicecontrol', 300, 200 );     
	}
	add_action("plugins_loaded", "widget_lawguru_legal_adviceinit");
?>