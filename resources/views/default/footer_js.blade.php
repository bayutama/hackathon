<!-- jQuery  -->
<script type="text/javascript" src="/assets/js/jquery.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/assets/js/bootstrap.min.js"></script>	

<!-- MAGNIFIC POPUP -->
<script src="/assets/js/jquery.magnific-popup.min.js"></script>    

<!-- PORTFOLIO SCRIPTS -->
<script type="text/javascript" src="/assets/js/imagesloaded.pkgd.min.js"></script>

<!-- APPEAR -->    
<script type="text/javascript" src="/assets/js/jquery.appear.js"></script>

<!-- MAIN SCRIPT -->
<script src="/assets/js/main.js"></script>

<!-- COUNTDOWN -->
<script src="/assets/js/jquery.countdown.min.js"></script>
<script src="/assets/js/responsiveslides.js"></script>
<script>
//COUNTDOWN -----------------------------------------------------------------------------
	$('#clock').countdown('2017/07/07').on('update.countdown', function(event) {
	   var $this = $(this).html(event.strftime(''
		 + '<div class="countdown-item-container3"><span class="countdown-amount">%D</span><span class="countdown-period">Day%!D</span></div>'
		 + '<div class="countdown-item-container3"><span class="countdown-amount">%H</span><span class="countdown-period">Hour%!H</span></div>'
		 + '<div class="countdown-item-container3"><span class="countdown-amount">%M</span><span class="countdown-period">Minute%!M</span></div>'
		 + '<div class="countdown-item-container3"><span class="countdown-amount">%S</span><span class="countdown-period">Second%!S</span></div>'));
	 });
	$(function() {
		$(".rslides").responsiveSlides({ 
			auto : false,
			manualControls : "#pagerMenu"
		});
	});
	$(".mm_ac").click(function(){
		$('.mm_ac').each(function(){
			$(this).parent().removeClass('current');
		});
		$(this).parent().addClass('current');
	});
	
	
	
	$(document).ready(function () {
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
				  $target.find('input:eq(0)').focus();
			  }
		  });

		  allNextBtn.click(function(){
			  var curStep = $(this).closest(".setup-content"),
				  curStepBtn = curStep.attr("id"),
				  nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
				  curInputs = curStep.find("input[type='text'],input[type='url']"),
				  isValid = true;

			  $(".form-group").removeClass("has-error");
			  for(var i=0; i<curInputs.length; i++){
				  if (!curInputs[i].validity.valid){
					  isValid = false;
					  $(curInputs[i]).closest(".form-group").addClass("has-error");
				  }
			  }

			  if (isValid)
				  nextStepWizard.removeAttr('disabled').trigger('click');
		  });

		  $('div.setup-panel div a.btn-primary').trigger('click');
	});
</script>
