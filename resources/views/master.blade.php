<html>
	<head>
		<title>Laravel</title>		
		<link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>
		<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		@yield("script_header")
		<script type="text/javascript">
			function searchTag() {
				window.location = '{{ $base_url."list/" }}' + $('#search').val().replace("#","");
			};
		</script>
	</head>
	<body>
		<div class="container">
			<div class="loading" id="loading" style="display:none;"></div>
			<div class="content" id="content">
				<div class="topBar">		
					<div class='searchContainer fr'>
						<input type="text" name="search" id="search" placeholder="Keyword..." />
						<button onclick="searchTag();">Search</button>
					</div>
					<div style="margin:0 auto; padding:0; width: 89px; height: 88px">
						<div class="btnHome fl">
						<a href="{{ $base_url.'list' }}">
							<div class="home-icon"></div>
						</a>
						</div>
						<div class="btnStore fl">
							<a href="{{ $base_url.'store' }}">
								<div class="save-icon"></div>
							</a>
						</div>
					</div>					
				</div>
				@yield("content")
			</div>
		</div>
	</body>
</html>
