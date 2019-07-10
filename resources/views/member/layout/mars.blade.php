<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  

  <link rel='stylesheet' href='/assets/member/css/main.css?v=<?=$CSS_VERSION?>'>
  <link href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
  <link href='http://fonts.googleapis.com/css?family=Oswald:300,400,700|Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
  <link href="/assets/css/summernote.css" rel="stylesheet">
  <?/*<link href="/assets/favicon.ico" rel="shortcut icon">
  <link href="/assets/apple-touch-icon.png" rel="apple-touch-icon">*/?>
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
    @javascript html5shiv respond.min
  <![endif]-->

  <title>hack.id</title>
  <meta name="google-signin-client_id" content="928596884418-lmd96cbh4h4vf1rkiudb5rtqn2ur6a97.apps.googleusercontent.com">

</head>

<body class="body-light-linen">
		
	
<div class="all-wrapper">
	<div class="row">
		<div class="col-md-3">
			<div class="text-center">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>

			@component('member.sideleft')
				<strong>Whoops!</strong> Something went wrong!
			@endcomponent
			
		</div>
		@component('member.main')
				<strong>Whoops!</strong> Something went wrong!
		@endcomponent
	</div>	
</div>	
</body>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/js/jquery.dataTables.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/dataTables.bootstrap.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/dataTables.buttons.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/buttons.bootstrap.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/buttons.flash.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/buttons.html5.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/buttons.print.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/dataTables.fixedHeader.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/dataTables.keyTable.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/dataTables.responsive.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/responsive.bootstrap.js" charset="UTF-8"></script>
<script type="text/javascript" src="/assets/js/dataTables.scroller.min.js" charset="UTF-8"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>
<script src="/assets/js/summernote.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script>
	var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

	function addbanner()
	{
		var html = '<div>'+
						'<div class="form-group">'+
						   '<label class="col-md-3 control-label">Image</label>'+
						   '<div class="col-md-7">'+
							'<input type="file" name="banner_image[]" class="form-control" >'+
						  ' </div>'+
						  ' <div  class="col-md-2"> <a href="javascript:void(0)" class="widget-link-remove" onclick="removebanner(this); return false;">[<i class="icon-minus"></i>]</a></div>'+
						'</div>'+
						'<div class="form-group">'+
						  ' <label class="col-md-3 control-label">URL Click</label>'+
						  ' <div class="col-md-7">'+
							'	<input type="text" name="url[]" class="form-control" >'+
						  ' </div>'+
						 ' </div>'+
				    '</div>';
		$("#banner_div").append(html);
	}
	function addJudges()
	{
		var html = '<div style="border-top:1px dashed #ccc;padding-top:20px;">'+
						'<div class="form-group">'+
						  ' <label class="col-md-3 control-label">Name</label>'+
						   '<div class="col-md-7">'+
							'	<input type="text" name="judges_name[]" class="form-control" >'+
						   '</div>'+
						    '<div  class="col-md-2"> <a href="javascript:void(0)" class="widget-link-remove" onclick="removeJudges(this); return false;">[<i class="icon-minus"></i>]</a></div>'+
						'</div>'+
						'<div class="form-group">'+
						'   <label class="col-md-3 control-label">Photo</label>'+
						'   <div class="col-md-7">'+
						'		<input type="file" name="judges_photo[]" class="form-control" >'+
						 '  </div>'+
						'</div>'+
						'<div class="form-group">'+
						'  <label class="col-md-3 control-label">Description</label>'+
						'  <div class="col-md-9">'+
						'	<textarea name="judges_description[]" class="form-control" /></textarea>'+
						'  </div>'+
						'</div>'+
						'<div class="form-group">'+
						'   <label class="col-md-3 control-label">FB</label>'+
						'   <div class="col-md-7">'+
						'		<input type="text" name="judges_fb[]" class="form-control" >'+
						'   </div>'+
						'</div>'+
						'<div class="form-group">'+
						'   <label class="col-md-3 control-label">Twitter</label>'+
						'   <div class="col-md-7">'+
						'		<input type="text" name="judges_twitter[]" class="form-control" >'+
						'   </div>'+
						'</div>'+
						'<div class="form-group">'+
						'   <label class="col-md-3 control-label">linked in</label>'+
						'   <div class="col-md-7">'+
						'		<input type="text" name="judges_linken[]" class="form-control" >'+
						'   </div>'+
					'</div>'+
					'</div>';
		$("#judges_div").append(html);
		
	}
	
	function addPages(){
		var d = new Date();
		var n = d.getTime();
		var html = '<div style="border-top:1px dashed #ccc;padding-top:20px;">'+
						'<div class="form-group">'+
						   '<label class="col-md-3 control-label">Page Name</label>'+
						   '<div class="col-md-7">'+
								'<input type="text" name="page_name[]" class="form-control" >'+
						   '</div>'+
						    ' <div  class="col-md-2"> <a href="javascript:void(0)" class="widget-link-remove" onclick="removePages(this); return false;">[<i class="icon-minus"></i>]</a></div>'+
						'</div>'+
						'<div class="form-group" style="display:none;">'+
						   '<label class="col-md-3 control-label">Background Image</label>'+
						   '<div class="col-md-7">'+
							'<input type="file" name="pages_bg[]" class="form-control" >'+
						   '</div>'+
						'</div>'+
						'<div class="form-group">'+
						   '<label class="col-md-3 control-label">Content</label>'+
						   '<div class="col-md-7">'+
								'<div class="pages_content" id="pages_content_'+n+'"></div>'+
						   '</div>'+
						'</div>'+
				    '</div>';
		$("#pages_div").append(html);
		$('#pages_content_'+n).summernote({
			height: 300,                 // set editor height
		});
	}
	function removebanner(elm){
		$(elm).parent().parent().parent().remove();
	}
	
	function removeJudges(elm){
		$(elm).parent().parent().parent().remove();
	}	
	function removePages(elm){
		$(elm).parent().parent().parent().remove();
	}
	$(document).ready(function() {
		$('#datatable').dataTable();
		$('#startdate_div').datetimepicker({
                 format: 'DD/MM/YYYY'
           });
		$('#enddate_div').datetimepicker({
                 format: 'DD/MM/YYYY'
           });
		   
		$('.pages_content').summernote({
			height: 300,                 // set editor height
		});

        <?php if(isset($pages)): ?>
			<?php foreach($pages as $page): ?>
				$('#pages_content_<?=str_slug($page->nama,'-')?>').summernote('code', Base64.decode("<?=base64_encode($page->konten)?>"));
			<?php endforeach;?>
		<?php endif; ?>
	});
	
	var submitEvent = function(){
		var frm = document.hackaton_form;
		var eqno = 0 ;
		$(".pages_content").each(function(){
			var cqnya = $('.pages_content').eq(eqno).summernote('code');

			$(frm).append('<input type="hidden" name="pages_content_clean[]" value="'+encodeURIComponent(cqnya)+'" >');
			eqno++;
		})
		
		
		//frm.action = "/member/createhackathon";
		frm.method = "POST";
		frm.submit();
	};
	
	var submitProject = function(){
		var frm = document.project_form;
		var eqno = 0 ;
	
		frm.method = "POST";
		frm.submit();
	};
</script>
</html>
