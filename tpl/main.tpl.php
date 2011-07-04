<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>toothPaste</title>
    <link rel="stylesheet" href="{{@BASE}}/media/css/style.css" type="text/css" media="screen" />
    <link href="{{@BASE}}/media/css/shCoreDefault.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="{{@BASE}}/media/js/jquery.js"></script>
    <script type="text/javascript" src="{{@BASE}}/media/js/shCore.js"></script>
    <script type="text/javascript">
        SyntaxHighlighter.all();

        $(document).ready(function(){
            $('#file').change(function() {
                $('#theOneThing').addClass('magicthing'); // ha, thats so lazy, I had to use it
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
