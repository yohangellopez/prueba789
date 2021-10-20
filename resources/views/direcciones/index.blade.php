@extends('layouts.template')
@section('content')
<div class="row sales layout-top-spacing">
        <div class="col-sm-12">
            <div class="widget widget-chart-one">
                <div class="widget-heading">
                    <h4 class="card-title">
                        <b>Direccion | Listado</b>
                    </h4>
                    <ul class="tabs tab-pills">
                        <li>
                            <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal" data-target="#theModal">
                                Agregar
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="row justify-content-between">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text input-gp">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <input type="text" id="search" class="form-control" placeholder="Buscar...">
                        </div>
                    </div>
                </div>
                <div class="widget-content">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped mt-1">
                            <thead class="text-white" style="background:#3B3F5C">
                                <tr>
                                    <th class="table-th text-white">CLIENTE</th>
                                    <th class="table-th text-white text-center">CALLE</th>
                                    <th class="table-th text-white text-center">NUMERO EXT.</th>
                                    <th class="table-th text-white text-center">PAIS</th>
                                    <th class="table-th text-white text-center">COLONIA</th>
                                    <th class="table-th text-white text-center">ESTADO</th>
                                    <th class="table-th text-white text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($direcciones)>0)
                                @foreach($direcciones as $direccion)
                                <tr>
                                    <td><h6>{{$direccion->nombre}} {{$direccion->apellido_paterno}} </h6></td>
                                    <td><h6>{{$direccion->calle}}</h6></td>
                                    <td><h6>{{$direccion->num_ext}}</h6></td>
                                    <td><h6>{{$direccion->pais}}</h6></td>
                                    <td><h6>{{$direccion->colonia}}</h6></td>
                                    <td><h6>{{$direccion->estado}}</h6></td>
                                    
                                    <td class="text-center">
                                        <a href="javascript:void(0)" onclick="Edit('{{$direccion->id}}')" id="edit_btn" class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
    
                                        <a href="javascript:void(0)" onclick="Confirm('{{$direccion->id}}')" class="btn btn-dark" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <td colspan="7" class="text-center"> <h6>No hay direcciones registrados</h6></td>
                                @endif
                            </tbody>
                        </table>
                        {{$direcciones->links()}}
                    </div>
                </div>
            </div>
        </div>
    
        @include('direcciones.form')
    
    </div>
@endsection      
<script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
  
<script>
    $(document).ready(function(){
        $('#btnDireccion').click(function(e){
            e.preventDefault();
            var data = $('#formDireccion').serialize();

            $.ajax({
                type:'POST',
                url: '{{route('direccion.store')}}'  ,
                data: data,
                success:function(data){
                    if (data.type === 'validate') {
                        for (const prop in data.errors) {
                            noty2(data.errors[prop][0]);
                        }
                    }else{
                        noty(data.message) 
                        setTimeout(function(){ 
                            location.reload();
                        }, 2000);
                    }
                },
                error: function(data){
                }
            })
        });

    });
   
    function Confirm(id){
        Swal.fire({
            title: 'CONFIRMAR',
            text: '¿DESEA ELIMINAR LA DIRECCION?',
            icon: 'warning',
            showCancelButton: true,
            cancelButtonText: 'Cerrar',
            cancelButtonColor: '#3FB3FFF',
            confirmButtonColor: '#3B3F5C',
            confirmButtonText: 'Aceptar'
        }).then(function(result){
            if(result.value){
                eliminar(id);
                swal.close()
            }
        });
    }

    function eliminar(id){
        let aux = "{{ route('direccion.delete', 'id') }}";

        var ruta = aux.replace('id', id);
        $.ajax({
            type:'DELETE',
            url: ruta  ,
            data:  id,
            success:function(data){
                if (data.type === 'deleted') {
                    noty(data.message);
                    setTimeout(function(){ 
                        location.reload();
                    }, 2000);
                }else{
                    noty(data.message,2);
                }
            },
            error: function(data){
            }
        })
    }

    function Edit(id){
        let aux = "{{ route('direccion.delete', 'id') }}";

        var ruta = aux.replace('id', id);
        $.ajax({
          url: "{{ route('direccion.get') }}"+"/"+id,
          type: 'GET',
          data: { id },
          dataType: "json",
          success: function (data) {
              console.log(data[0]);
               document.getElementById('cliente_id').value = data[0].cliente_id;
               document.getElementById('calle').value = data[0].calle;
               document.getElementById('num_ext').value = data[0].num_ext;
               document.getElementById('num_int').value = data[0].num_int;
               document.getElementById('colonia').value = data[0].colonia;
               document.getElementById('estado').value = data[0].estado;
               document.getElementById('pais').value = data[0].pais;
               document.getElementById('id').value = data[0].id;
               document.getElementById('h5T').innerHTML='<b>Direccion</b>| ACTUALIZAR'
               document.getElementById('btnDireccion').innerHTML='ACTUALIZAR'
              $("#theModal").modal('show');
          }

      });
    }

    function limpiarModal(){
            document.getElementById('cliente_id').value = 'Elegir';
            document.getElementById('calle').value = '';
            document.getElementById('num_ext').value = 0;
            document.getElementById('num_int').value = 0;
            document.getElementById('colonia').value = '';
            document.getElementById('estado').value = '';
            document.getElementById('pais').value = '';
            document.getElementById('h5T').innerHTML='<b>Direccion</b>| CREAR'
            document.getElementById('btnDireccion').innerHTML='CREAR'
    }

</script>
    