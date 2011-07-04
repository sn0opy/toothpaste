
<div class="add">
    <form action="{{@BASE}}add" method="post" id="pasteform" enctype="multipart/form-data">
        <div><textarea name="source" cols="40" rows="30"></textarea></div>
        <div><input type="submit" name="submit" value="Paste" class="pastebutton" /><span id="theOneThing"> or </span><input type="file" name="file" id="file" /></div>
    </form>
</div>
