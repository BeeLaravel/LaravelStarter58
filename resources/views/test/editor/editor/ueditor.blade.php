<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>Ueditor</title>
</head>
<body>
	<script id="container" name="content" type="text/plain"></script>

	@include('vendor.ueditor.assets')
	<script type="text/javascript">
	    var ue = UE.getEditor('container');
	    ue.ready(function() {
	        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');
	    });
	</script>
</body>
</html>