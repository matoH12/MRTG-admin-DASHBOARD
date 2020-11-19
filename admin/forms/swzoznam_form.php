<fieldset>
    <div class="form-group">
        <label for="swname">Switchname *</label>
          <input type="text" name="swname" value="<?php echo htmlspecialchars($edit ? $customer['swname'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Switch Name" class="form-control" required="required" id = "swname" onKeyDown="javascript: var keycode = keyPressed(event); if(keycode==32){ return false; }"  >
    </div> 

    <div class="form-group">
        <label for="swip">Switch IP</label>
        <input type="text" name="swip" value="<?php echo htmlspecialchars($edit ? $customer['swip'] : '', ENT_QUOTES, 'UTF-8'); ?>" placeholder="Switch IP" class="form-control"  required="required" pattern="((^|\.)((25[0-5])|(2[0-4]\d)|(1\d\d)|([1-9]?\d))){4}$"  id="swip">
    </div> 


    <div class="form-group">
        <label>Budova </label>
           <?php $select = array('id', 'nazov'); $opt_arr = $db->arraybuilder()->paginate('budova', "1", $select);
                            ?>
            <select name="idbudova" class="form-control selectpicker" required>
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



    <div class="form-group">
        <label>Lokalita </label>
           <?php $select = array('id', 'nazov'); $opt_arr = $db->arraybuilder()->paginate('lokalita', "1", $select);
                            ?>
            <select name="idlokalita" class="form-control selectpicker" required>
                <option value=" " >Vyber Lokality</option>
                <?php
                foreach ($opt_arr as $opt) {
                    if ($edit && $opt['id'] == $customer['lokalitaid']) {
                        $sel = "selected";
                    } else {
                        $sel = "";
                    }

                    echo '<option value="'.$opt['id'].'"'. $sel .'>' . $opt['nazov'] . '</option>';
                }

                ?>
            </select>
    </div>


    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send" ></span></button>
    </div>            

<script type="text/javascript">

function keyPressed(){
var key = event.keyCode || event.charCode || event.which ;
return key;
}

</script>


</fieldset>
