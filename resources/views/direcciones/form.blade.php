<div class="modal fade" id="theModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title text-white" id="h5T">
                        <b>Direccion</b> | CREAR
                    </h5>
                    
                    <button type="button" class="close"  data-dismiss="modal" onclick="limpiarModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formDireccion">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Cliente:</label>
                                    <select name="cliente_id" id="cliente_id" class="form-control">
                                        <option value="Elegir" disabled selected>Elegir</option>
                                        @foreach ($clientes as $cliente)
                                        <option value="{{$cliente->id}}">{{$cliente->nombre}} {{$cliente->apellido_paterno}} {{$cliente->apellido_materno}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Calle:</label>
                                    <input type="text" name="calle" id="calle" autofocus placeholder="Calle" class="form-control">
                                    @error('calle') <span class="text-danger er">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Numero externo:</label>
                                    <input type="number" name="num_ext" id="num_ext" placeholder="Numero externo" class="form-control">
                                    @error('num_ext') <span class="text-danger er">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Numero interno:</label>
                                    <input type="number" name="num_int" id="num_int" placeholder="Numero interno" class="form-control">
                                    @error('num_int') <span class="text-danger er">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Colonia:</label>
                                    <input type="email" name="colonia" id="colonia" placeholder="Colonia" class="form-control">
                                    @error('colonia') <span class="text-danger er">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Estado:</label>
                                    <input type="text" name="estado" id="estado" maxlength="10" placeholder="Estado" class="form-control">
                                    @error('estado') <span class="text-danger er">{{$message}}</span> @enderror
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label>Pais:</label>
                                    <input type="text" name="pais" id="pais" maxlength="10" placeholder="Pais" class="form-control">
                                    @error('pais') <span class="text-danger er">{{$message}}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" value="0">
                    </form>
                    
                </div>
    
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark close-btn text-info" onclick="limpiarModal()" data-dismiss="modal">CERRAR</button>
                
                    <button type="button" id="btnDireccion" class="btn btn-dark close-modal">REGISTRAR</button>
                    
                </div>
            </div>
        </div>
    </div>