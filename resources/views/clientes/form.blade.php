<div class="modal fade" id="theModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white" id="h5T">
                    <b>Cliente</b> | CREAR
                </h5>
                
                <button type="button" class="close"  data-dismiss="modal" onclick="limpiarModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCliente">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                                <label>Nombre:</label>
                                <input type="text" name="nombre" id="nombre" autofocus placeholder="Nombre" class="form-control">
                                @error('nombre') <span class="text-danger er">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Apellido paterno:</label>
                                <input type="text" name="apellido_paterno" id="apellido_paterno" placeholder="Apellido" class="form-control">
                                @error('apellido_paterno') <span class="text-danger er">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Apellido materno:</label>
                                <input type="text" name="apellido_materno" id="apellido_materno" placeholder="Apellido" class="form-control">
                                @error('apellido_materno') <span class="text-danger er">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                                @error('email') <span class="text-danger er">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label>Telefono:</label>
                                <input type="text" name="telefono" id="telefono" maxlength="10" placeholder="Telefono" class="form-control">
                                @error('telefono') <span class="text-danger er">{{$message}}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="id" value="0">
                </form>
                
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-dark close-btn text-info" onclick="limpiarModal()" data-dismiss="modal">CERRAR</button>
            
                <button type="button" id="btnCliente" class="btn btn-dark close-modal">REGISTRAR</button>
                
            </div>
        </div>
    </div>
</div>