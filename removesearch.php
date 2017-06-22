<?php
include('wp-config.php');
global $wpdb;
if(isset($_POST['survey']) && $_POST['survey']!=""){
	$countArray = count($_POST['survey']);
	for($a = 0; $a<$countArray; $a++)
	{
		if($_POST['survey'][$a] != $_POST['removeVal']){
			$srch[] = $_POST['survey'][$a];
			?>
			<p class="tag">
				<span class="tag_txt"><?php echo get_cat_name($_POST['survey'][$a]); ?></span>
				<input type="hidden" name="survey[]" id="survey<?php echo $_POST['survey'][$a]; ?>" value="<?php echo $_POST['survey'][$a]; ?>"><span id="close" class='close' onclick="removesearch(<?php echo $_POST['survey'][$a]; ?>)">✕</span>
			</p>
			<?php
		}
	}
}
?>