<div class="modal fade" id="add-customercredential">
    <div class="modal-dialog modal-md">
        <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-body">
                    
                    <div class="form-group">
                        <label for="credential_name">Nombre de la credencial</label>
                        <input type="text" class="form-control form-control-border" id="credential_name" name="credential_name" placeholder="Nombre de la credencial" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="file_upload">Subir archivo</label>
                        <input type="file" class="form-control form-control-border" id="file_upload" name="file_upload" required>
                    </div>
                                
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Cerrar</button>
                    <input type="submit" class="btn btn-primary " id="add-customercredential_btn" name="add-customercredential" value="Guardar">
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->