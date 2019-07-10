<script src="/assets/<?=$current_theme?>/js/jquery.min.js"></script>
<script src="/assets/<?=$current_theme?>/js/element.js"></script>
<!-- bx-slider -->
<script src="/assets/<?=$current_theme?>/js/jquery.bxslider.min.js"></script>
<script src="/assets/<?=$current_theme?>/js/slider/owl.carousel.js"></script>
<!-- Spincrement -->
<script src="/assets/<?=$current_theme?>/js/waypoints.min.js"></script>
<script src="/assets/<?=$current_theme?>/js/jquery.counterup.min.js"></script>
<!-- Parallax -->
<script type="text/javascript" src="/assets/<?=$current_theme?>/js/jquery.parallax-1.1.3.js"></script>
<script type="text/javascript" src="/assets/<?=$current_theme?>/js/jquery.localscroll-1.2.7-min.js"></script>
<!-- responsive menu -->
<script src="/assets/<?=$current_theme?>/js/wow.min.js"></script>
<script src="/assets/<?=$current_theme?>/js/responsiveslides.js"></script>
<script src="/assets/<?=$current_theme?>/js/jquery.pagepeel.1.2.1.js"></script>

<script>

	
	
	$(document).ready(function () {
		$(function() {
			$(".rslides").responsiveSlides();
		});
		
		<?/*$('#pagePeel').pagePeel({
			introAnim: false,
			smallWidth: 112,
			smallHeight:112,			
			adLink: '<?=url('create/hackathon')?>',
			adLinkTarget : '_self',
			bigAd: '/assets/<?=$current_theme?>/images/bigAd.jpg?v=<?=$IMAGES_VERSION?>',
			bigSWF : '/assets/<?=$current_theme?>/flash/page-peel-big-intro.swf'
		});*/?>
		
		var navListItems = $('div.setup-panel div a'),
				  allWells = $('.setup-content'),
				  allNextBtn = $('.nextBtn');

		allWells.hide();

		navListItems.click(function (e) {
			e.preventDefault();
			var $target = $($(this).attr('href')),
				  $item = $(this);

			if (!$item.hasClass('disabled')) {
			  navListItems.removeClass('btn-primary').addClass('btn-default');
			  $item.addClass('btn-primary');
			  allWells.hide();
			  $target.show();
			 // $target.find('input:eq(0)').focus();
			}
		});

		allNextBtn.click(function(){
		  var curStep = $(this).closest(".setup-content"),
			  curStepBtn = curStep.attr("id"),
			  nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
			  curInputs = curStep.find("input[type='text'],input[type='url']"),
			  curPasswords = curStep.find("input[type='password']"),
			  isValid = true;

			
		  $(".form-group").removeClass("has-error");
		  for(var i=0; i<curInputs.length; i++){
			  if (!curInputs[i].validity.valid){
				  isValid = false;
				  $(curInputs[i]).closest(".form-group").addClass("has-error");
			  }
		  }
		  <?php if(!$memberInfo): ?>
		  for(var i=0; i<curPasswords.length; i++){
			  var passe = $(curPasswords[i]).val();
			  if (passe==""){
				  isValid = false;
				  $(curPasswords[i]).closest(".form-group").addClass("has-error");
			  }
		  }
		  if($(curPasswords[0]).val()!= $(curPasswords[1]).val()){
			isValid = false;
			$(curPasswords[0]).closest(".form-group").addClass("has-error");  
			$(curPasswords[1]).closest(".form-group").addClass("has-error");  
		  }
		  <?php endif; ?>
		  if (isValid)
			  nextStepWizard.removeAttr('disabled').trigger('click');
		});

		$('div.setup-panel div a.btn-primary').trigger('click');
		<?php if($memberInfo): ?>
			$("#step-2").show();
			$("#a-step-2").addClass('btn-primary').addClass('btn-default');
		<?php endif; ?>
	});
	<?php if($register_msg): ?>
		alert("<?=$register_msg?>");
	<?php endif; ?>
</script>