<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Markdown</title>

	<style type="text/css">
		.editor {
		    margin: 30px auto;
		}
	</style>
</head>
<body>
	<div class="editor">
	    <textarea name="conntent" style="display: none;" id="myEditor"></textarea>
	</div>

	<script type="text/javascript" src="/plugin/jquery/jquery/jquery-1.12.4/jquery.js"></script>
	@include('vendor.editor.head')
</body>
</html>
