<div class="add">
    <form action="{{@BASE}}/add" method="post" id="pasteform" enctype="multipart/form-data">
        <div><textarea name="source" cols="40" rows="30"></textarea></div>
        <div><input type="submit" name="submit" value="Paste" class="pastebutton" /><span id="theOneThing"> or file content: </span><input type="file" name="file" id="file" /> <span class="password"><input type="checkbox" name="private" id="private" /> <label for="private">Private</label></span></div>
    </form>
</div>
