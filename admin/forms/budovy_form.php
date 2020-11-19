<fieldset>
    <div class="form-group">
        <label for="nazov">Budova *</label>
          <input type="text" name="nazov" value="<?php echo htmlspecialchars($edit ? $customer['nazov'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Nazov budovy" class="form-control" required="required" id = "nazov"onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }"  >
    </div> 


    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send"></span></button>
    </div>            

<script type="text/javascript">

function keyPressed(){
var key = event.keyCode || event.charCode || event.which ;
return key;
}

</script>
</fieldset>
