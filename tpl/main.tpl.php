<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>toothPaste</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" href="{{@BASE}}/media/css/style.css" type="text/css" media="screen" />
    <link href="{{@BASE}}/media/css/shCoreDefault.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{@BASE}}/media/js/jquery.js"></script>
    <script type="text/javascript" src="{{@BASE}}/media/js/shCore.js"></script>
    <script type="text/javascript">
        SyntaxHighlighter.all();

        $(document).ready(function(){
            $('#file').change(function() {
                $('#theOneThing').hide();
                $('.pastebutton').attr('value', 'Upload');
            });
        });
    </script>
</head>
<body>

<div class="topBar">
    <div class="header">
        <h1><a href="{{@BASE}}/">tooth<em>Paste</em><sup>F3</sup></a></h1>
    </div>
</div>

<div class="container">

<F3:include href="{{@template}}" />

</div>
<!-- made with toothPaste by Sascha Ohms -->
</body>
</html>
