<fieldset>
    <div class="form-group">
        <label for="nazov">Nazov Lokality *</label>
          <input type="text" name="nazov" value="<?php echo htmlspecialchars($edit ? $customer['nazov'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Nazov lokality" class="form-control" required="required" id = "nazov" onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }" >
    </div> 


    <div class="form-group">
        <label>Budova </label>
           <?php $select = array('id', 'nazov'); $db->pageLimit = 200;  $opt_arr = $db->arraybuilder()->paginate('budova', "1", $select);
                            ?>
            <select name="budovaid" class="form-control selectpicker" required>
                <option value=" " >Vyber budovy</option>
                <?php
                foreach ($opt_arr as $opt) {
                    if ($edit && $opt['id'] == $customer['budovaid']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }


                    echo '<option value="'.$opt['id'].'"' . $sel . '>' . $opt['nazov'] . '</option>';
                }

                ?>
            </select>
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
