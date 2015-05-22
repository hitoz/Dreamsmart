<?php
	$base_url = $tagFilter == '' ? '' : '../';
?>
@extends('master')
@section('script_header')
	<script type="text/javascript">		
		function save(id) {				
			show("loading", true);
			var request = $.ajax({
									method: "POST",
									url: '{{ $base_url }}' + "save",
									data: { "id": id, "_token": "{{ csrf_token() }}" }
								});
			request.done(function (response, textStatus, jqXHR) {
				show("loading", false);
				alert(response.message);
			});			
		}

		function show(id, value) {
		    document.getElementById(id).style.display = value ? 'block' : 'none';
		}
	</script>
@stop
@section('content')
<div class="timelineContainer">
	@foreach ($medias as $index => $media)
		<?php 
			$user = $media->getUser();
		?>
		<div class="timelineSideBar">
			<div class="timelineSideBarContent">
				<div style="float:right">
					<img src="{{ $user->getProfilePicture() }}" style="width:40px; height:40px;" />
				</div>
				<div style="float:right; padding-right:10px;">
					<div class="sideBarFullName">
						{{ $user->getUserName() }}
					</div>
					<div class="sideBarCreatedTime">
						{{ FunctionHelper::nicedate($media->getCreatedTime()) }}
					</div>									
				</div>														
			</div>
		</div>
		<div class="timeline">
			<img src="{{ $media->getStandardResImage()->url }}" style="width:510px; height:510px;" />
			<div class="timelineLikeContainer">
				<div class="love-icon timelineLike fl"></div>
				<div class="timelineSave fr">
					<div class="btnSave save-icon" onclick="save('{{ $media->getId() }}')"></div>
				</div>
				<div class="timelineLikeCaption">
					@if ($media->getLikesCount() > 0)
						<span style="font-weight: 700;">{{ $media->getLikesCount() }}</span> people like this.
					@endif									
				</div>
			</div>
			<div class="timelineCaptionContainer">
				<div class="timelineCaption">
					<div class="timelineCaptionThumbnail fl">
						<img src="{{ $user->getProfilePicture() }}" style="width:24px; height:24px;" />
					</div>
					<div class="timelineCaptionUsernameContainer">
						<span class="timelineCaptionUsername">
							{{ $user->getUserName() }}
						</span>
						<?php
							$str = $media->getCaption();
							$arr = explode("#", $str);
							foreach ($arr as $value) {
								if (trim($value) != "") {
									$tagName = explode(" ", $value)[0];
									$tag = "#".$tagName;
									$url = $base_url."list/".$tagName;
									$str = str_replace($tag, "<a href='$url'>$tag</a>"." ", $str);		
								}													
							}							
							echo $str;				
						?>
					</div>									
					<div style="clear:both;"></div>
				</div>
			</div>
		</div>
	@endforeach	
</div>
@stop
