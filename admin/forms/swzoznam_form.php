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
           <?php $select = array('id', 'nazov'); $db->pageLimit = 2000; $opt_arr = $db->arraybuilder()->paginate('budova', "1", $select);
                            ?>
            <select id="idbudova" name="idbudova" class="form-control selectpicker" required>
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

<div id="catalog"></div>  






    <div class="form-group text-center">
        <label></label>
        <button type="submit" class="btn btn-warning" >Save <span class="glyphicon glyphicon-send" ></span></button>
    </div>            
<script type="text/javascript">

function keyPressed(){
var key = event.keyCode || event.charCode || event.which ;
return key;
}


   function displayDivDemo(id, elementValue) {
      document.getElementById(id).style.display = elementValue.value !== 0 ? 'block' : 'none';
   }


$('#idbudova').on('change', function() {
           var option = this.value;
                   $.ajax({
                    type: "POST",
                    url: "getzoznamlokalit.php",
                    data: {
                            'idbudova': option
                    },
                    success: function (data) {
                                  $('#catalog').html(data);

                        }
                    });
});



</script>


</fieldset>
