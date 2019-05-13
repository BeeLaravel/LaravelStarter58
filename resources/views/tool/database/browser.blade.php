<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title>Tools - Database - Browser</title>

        <link rel="stylesheet" href="/css/tool/database/browser.css">
    </head>
    <body>
        <div class="main">
            <select name="type" id="type">
                <option value="">==请选择==</option>
                @foreach ( $types as $key => $value )
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            <select name="server" id="server">
                <option value="">==请选择==</option>
            </select>
            <textarea name="tables" id="tables" cols="30" rows="10">
            </textarea>
        </div>

        <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.4.0/jquery.min.js"></script>
        <script type="text/javascript" src="/js/tool/database/browser.js"></script>
        <script type="text/javascript">
            $("select[name=type]").change(function(){
                $.ajax({
                    method: 'post',
                    url: '{{ url("/tool/database/browser/server") }}',
                    dataType: 'json',
                    data: {
                        'type': $("select[name=type]").val()
                    },
                    success: function(data){
                        var html = '<option value="">==请选择==</option>';
                        data.forEach(function(item) {
                            html += '<option value="' + item.id + '" host="' + item.host + '" port="' + item.port + '">' + item.title + '</option>';
                        });
                        $("select[name=server]").html(html);
                    },
                    error: function(){
                        alert('Error!');
                    }
                });
            });
            $("select[name=server]").change(function(){
                $.ajax({
                    method: 'post',
                    url: '{{ url("/tool/database/browser/table") }}',
                    dataType: 'json',
                    data: {
                        'server_id': $("select[name=server]").val()
                    },
                    success: function(data){
                        console.log(data);
                        // var html = '<option value="">==请选择==</option>';
                        // data.forEach(function(item) {
                        //     html += '<option value="' + item.id + '>' + item.table_name + '</option>';
                        // });
                        // $("select[name=server]").html(html);

                        var text = '';
                        data.forEach(function(item) {
                            text += item.TABLE_NAME + "\n";
                        });
                        $("textarea[name=tables]").text(text);
                    },
                    error: function(){
                        alert('Error!');
                    }
                });
            });
        </script>
    </body>
</html>
