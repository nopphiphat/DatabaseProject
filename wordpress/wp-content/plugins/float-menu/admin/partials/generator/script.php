<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
jQuery(document).ready(function() {
	<?php if (isset($id)){
		$idd = $id;
	}
	else {
		$idd = $lastid;
	}
	$subOpen = !empty($param['subOpen']) ? $param['subOpen'] : 'mouseover';
  $showAfterPosition = !empty($param['showAfterPosition']) ? $param['showAfterPosition'] : 0;
	?>
	jQuery(".float-menu-<?php echo $idd; ?>").floatingMenu({				
		position: ["<?php echo $param['menu']; ?>", "center"],
		offset: [0, 0],
		shape: "square",
		sideSpace: <?php echo $param['sideSpace']; ?>,
		buttonSpace: <?php echo $param['buttonSpace']; ?>,
		labelSpace: <?php echo $param['labelSpace']; ?>,
		labelConnected: <?php echo $param['labelConnected']; ?>,
		labelEffect: "fade",
		labelAnim: [<?php echo $param['labelSpeed']; ?>, "easeOutQuad"],
		color: "default",
		overColor: "default",
		labelsOn: <?php echo $param['labelsOn']; ?>,				

	});
});
