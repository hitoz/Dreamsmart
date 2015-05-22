<?php
	use \App\Tag as Tag;

	$base_url = '';
?>
@extends('master')
@section('content')
<div class="storeContainer">
	@foreach ($tags as $index => $tag)
		<?php
			$postTags = Tag::where('name', $tag[0])->get();
		?>
		<div class="storeTagCaption">
			<b>{{ "#".$tag[0] }}</b>
			<div class="storePostContainer">

		@foreach ($postTags as $index => $postTag)
			<?php
				$post = $postTag->post()->first();
				$user = $post->user()->first();
			?>
			<div class="storeCardContainer fl">
				<img src="{{ $post->image }}" style="width:370px; height:370px;" />
				<div class="timelineLikeContainer">
					<div class="love-icon timelineLike fl"></div>
					<div class="timelineLikeCaption" style="font-size: 17;">
						@if ($post->like_count > 0)
							<span style="font-weight: 700;">{{ $post->like_count }}</span> people like this.
						@endif									
					</div>
				</div>
				<div class="timelineCaptionContainer">
					<div class="timelineCaption">
						<div class="timelineCaptionThumbnail fl">
							<img src="{{ $user->profile_picture }}" style="width:24px; height:24px;" />
						</div>
						<div class="timelineCaptionUsernameContainer" style="font-size: 14; white-space:normal; color: black">
							<span class="timelineCaptionUsername">
								{{ $user->username }}
							</span>
							<?php
								$str = $post->caption;
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
		<div style="clear:both;"></div>
	@endforeach	
</div>
@stop
