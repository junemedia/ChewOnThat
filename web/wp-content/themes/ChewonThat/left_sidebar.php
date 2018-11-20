<?
require_once('magpierss/rss_fetch.inc');

$cacheFile = dirname(__FILE__) . '/../../../cache/rss_xml.cache';
$expire = time() - fileatime($cacheFile);
if($expire > 60 *60 * 24)
{
	$rss_xml = file_get_contents("http://www.recipe4living.com/rss/_all");
	$handle = fopen($cacheFile, 'w+');
	fwrite($handle, $rss_xml);	
}

$rss = fetch_rss("http://www.chewonthatblog.com/cache/rss_xml.cache");
//if(strlen($rss) < 20)
//{
//	$rss = fetch_rss("http://www.recipe4living.com/rss/_all");
//}
?>
<div id="left_sidebar">

	<?php //if ($_SERVER['REQUEST_URI'] != '/recipe4living-cooking-store/') { ?>
				
		
		
		
		<!--
		<div class="box" id="twitter">
				<h4>Twitter</h4>
				<div style="padding-right: 0.2cm;padding-left: 0.5cm">
				<p><?php //twitter_messages('ChewOnThatBlog'); ?></p>
				</div>
			</div>
		-->
			
		
		
		
		
		<div class="box" id="cookin">
			<h4>Newest Recipes</h4>
			<!--<div align="center">
			<a href="http://www.recipe4living.com/">
			<img src="<?bloginfo('template_url')?>/images/r4l_logo.png" width="157" height="29">
			</a>
			</div>-->
			<ul class="cookin">
			<?php
				$rss = $rss->items;
				$i =0;
				foreach ($rss as $item) {
					?><li><a target="_blank" href="<?php echo $item['link']; ?>"><?php echo htmlentities($item['title']); ?></a></li><?php
					$i++;
					if ($i>=5) break;
				}
			?>
			
			
			
			<div class="answer"><a target="_blank" href="http://www.recipe4living.com/">Click here for all recipes!</a></div>
			</ul>
		</div>

		<div class="box" style="text-align:center;"> </div>
		
		
			<!--
			<div class="box" id="top_posts">
				<h4>Top Posts</h4>
				<ul class="cookin">
				
				<?php //akpc_most_popular($limit = 5, $before = '<li>', $after = '</li>'); ?>
				</ul>
			</div>
			-->

		
		
		
		
		
		
		
		
		
		
		   <?php if (function_exists('get_recent_comments')) { ?>
		   <div class="box" id="comments"><h4><?php _e('Recent Comments'); ?></h4>
		        <ul>
		        <?php get_recent_comments(); ?>
		        </ul>
		   </div>
		   
		   <div class="box" id="comments">
		        <h4>Top Commenters</h4>
		        <ul>
		        	<?php c2c_get_commenters(); ?>
		        </ul>
		   </div>
		   <?php } ?>

		<!--<div class="box ads">
			<h4>Sponsored</h4>-->
			<!-- PUT THIS TAG IN DESIRED LOCATION OF SLOT ChewOnThat_RON_160x600 -->
			<!--<script type="text/javascript">
				  GA_googleFillSlot("ChewOnThat_RON_160x600");
				</script>-->
			<!-- END OF TAG FOR SLOT ChewOnThat_RON_160x600 -->
		<!--</div>-->
		
		<?php //} ?>
	</div>
