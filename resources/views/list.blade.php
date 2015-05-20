<?php
	$base_url = $tagFilter == '' ? '' : '../';
?>

<html>
	<head>
		<title>Laravel</title>		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script type="text/javascript">
			function searchTag() {
				window.location = '{{ $base_url."list/" }}' + $('#search').val();
			};
		</script>
	</head>
	<body>
		<div class="container">
			<div class="content">
				<div class="topBar">		
					<div class='searchContainer fr'>
						<input type="text" name="search" id="search" placeholder="Keyword..." />
						<button onclick="searchTag();">Search</button>
					</div>			
					<div class="btnHome">
						<a href="{{ $base_url.'list' }}">
							<div class="home-icon"></div>
						</a>
					</div>					
				</div>
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
			</div>
		</div>
	</body>
</html>
