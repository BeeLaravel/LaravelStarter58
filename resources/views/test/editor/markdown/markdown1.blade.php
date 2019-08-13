<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Markdown</title>

	<style type="text/css">
		
	</style>
</head>
<body>
	<div id="test-editormd">
	    <textarea name="test-editormd" style="display: none;"></textarea>
	</div>

	@include('vendor.markdown.encode', ['editors' => ['test-editormd']])
</body>
</html>
