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
    	{!! \YuanChao\Editor\EndaEditor::MarkDecode("#我是参数") !!}
	</div>

	@include('vendor.editor.decode')
</body>
</html>
