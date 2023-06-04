<div class="modal fade" id="add-simple_crud">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="text">Text</label>
                        <input type="text" class="form-control form-control-border" id="text" name="text" placeholder="Text" required>
                        <div id="response"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="text_area">Textarea</label>
                        <textarea class="form-control form-control-border" rows="3" id="text_area" name="text_area" placeholder="Textarea" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Dropdown</label>
                        <select class="form-control select2" id="dropdown" name="dropdown" required>
                            <option value=''>-- SELECT --</option>
                            <option value='1'>1st</option>
                            <option value='2'>2nd</option>
                            <option value='3'>3rd</option>
                            <option value='4'>4th</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                    <input type="submit" class="btn btn-primary " id="add-simple_crud_btn" name="add-simple_crud" value="Save">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
$(document).ready(function(){
        
    $("#text").keyup(function(){
                    
        var text = $(this).val().trim();
             
        if(text != ''){
            
            $.ajax({
                url: 'check-text.php',
                type: 'post',
                data: {text: text},
                success: function(response){
                
                    $('#response').html(response);
                
                }
            });
        }else{
            $("#response").html("");
        }
                
    });

});
</script>