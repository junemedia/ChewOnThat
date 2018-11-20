	<div id="right_sidebar">
	
	<?php if ($_SERVER['REQUEST_URI'] != '/recipe4living-cooking-store/') { ?>
	<!--<div class="box">
			<p>
				<div align="left" style="padding-right: 0.3cm;padding-left: 0.2cm;">
					<table border="0" style="border:0;">
					<tr><td><a target="_blank" href="<?bloginfo('rss2_url'); ?>"><img src="<?bloginfo("template_url")?>/images/rss-COT.gif" alt="RSS"/></a></td>
					<td valign="top">&nbsp;&nbsp;<font style="font-weight:bold;">Sign up for our feed!</font>
					<br>&nbsp;&nbsp;For more ways to join, <a href='http://chewonthatblog.com/sign-up/'>click here</a>
					</td>
					</tr>
					</table>
				</div>
				<div style="padding-bottom: 0.1cm;"></div>
			</p>
	</div>
	<div class="box">
			<p>
				<div align="left" style="padding-right: 0.3cm;padding-left: 0.2cm;">
					<?php include ("searchform.php"); ?>
				</div>
				<div style="padding-bottom: 0.1cm;"></div>
			</p>
	</div><br>-->
	
	<div class='box'> </div>
	

	<!--<script type='text/javascript' src='http://static.fmpub.net/zone/6878'></script>
<script type='text/javascript' src='http://static.fmpub.net/site/chewonthatblog'></script>-->
		
	<?php dynamic_sidebar("right_sidebar"); ?>
	<div class='box'> </div>
	<br><br>
			</div>
		
			
			
	
	
	
	
	
	
	
		
		
	
		
		<div class="emptyads">
		<!-- PUT THIS TAG IN DESIRED LOCATION OF SLOT ChewonThat_RON2_300x250 -->
		<!--<script type="text/javascript">
		  GA_googleFillSlot("ChewonThat_RON2_300x250");
		</script>-->
		<!-- END OF TAG FOR SLOT ChewonThat_RON2_300x250 -->



		
		
		<!--
		Yedda was removed from right rail per Hillary's request on 7/27/09 - by Samir Patel
		<div class="box">
		<style type="text/css">
		.YeddaAolComboWidget_SubTitle{font-weight:bold;}
		</style>
			<p>
				<div align="left" style="padding-right: 0.3cm;padding-left: 0.2cm;">
				
				<table border="0" style="border:0;">
				<tr><td colspan="2">
				<script language="javascript" type="text/javascript"> function yedda_render_widget(url) { var ct=''; var temp = document.getElementsByTagName('title'); if (temp!=null && temp.length>0) {ct=temp[0].text;} document.write('<scr'+'ipt type="text/javascript" src="'+url+'&ctxu='+escape(document.location)+'&ctxt='+escape(ct)+'"></scr'+'ipt>'); } yedda_render_widget("http://yedda.com/api/widgets/?d=602&layout=v&tags=cooking&mt=1&mt.ct=Cooking&mt.qht=cooking"); </script> <noscript><a href="http://yedda.com/explore?&pid=4950978157101">Got a question? Ask on Yedda!</a></noscript>
				</td>
				</tr>
				</table>
				</div>
				<div style="padding-bottom: 0.1cm;"></div>
			</p>
		</div><br>
		-->


	<!-- BELOW CODE WILL AUTO EXPAND TO THE CURRENT YEAR AND MONTH - FOR ARCHIVE BOX ON RIGHT RAIL OF THIS PAGE-->
	<script>
		/*var listobject = document.getElementById('ara_ca_mo<?php echo date('Y'); ?>');
		var sign = document.getElementById('ara_ca_mosign<?php echo date('Y'); ?>'); 
		if(listobject.style.display == 'block') { 
			listobject.style.display = 'none'; sign.innerHTML = '[+]';
		} else {
			listobject.style.display = 'block'; sign.innerHTML = '[-]';
		}
		
		
		var listobject = document.getElementById('ara_ca_po<?php echo date('Yn'); ?>');
		var sign = document.getElementById('ara_ca_posign<?php echo date('Yn'); ?>');
		if(listobject.style.display == 'block') {
			listobject.style.display = 'none'; sign.innerHTML = '[+]';
		} else {
			listobject.style.display = 'block'; sign.innerHTML = '[-]';
		}*/
	</script>
<?php } ?>

</div>
