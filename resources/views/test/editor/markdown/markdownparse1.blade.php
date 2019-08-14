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
		{!! \Chenhua\MarkdownEditor\MarkdownEditor::parse("#中间填写markdown格式的文本") !!}

        <textarea style="display: none;">
# 这是一个h1标签
## 这是一个h2标签
		</textarea>
	</div>

	@include('vendor.markdown.decode', [
		'editors' => ['test-editormd']
	])
</body>
</html>
