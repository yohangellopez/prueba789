@extends('layouts.template')
@section('content')
<div class="row sales layout-top-spacing">
        <div class="col-sm-12">
            <div class="widget widget-chart-one">
                <div class="widget-heading">
                    <h4 class="card-title">
                        <b>Clientes | Listado</b>
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
                                    <th class="table-th text-white">NOMBRE</th>
                                    <th class="table-th text-white text-center">APELLIDO</th>
                                    <th class="table-th text-white text-center">EMAIL</th>
                                    <th class="table-th text-white text-center">TELEFONO</th>
                                    <th class="table-th text-white text-center">ACCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count($clientes)>0)
                                @foreach($clientes as $cliente)
                                <tr>
                                    <td><h6>{{$cliente->nombre}}</h6></td>
                                    <td><h6>{{$cliente->apellido_paterno}}  {{$cliente->apellido_materno}}</h6></td>
                                    <td><h6>{{$cliente->email}}</h6></td>
                                    <td><h6>{{$cliente->telefono}}</h6></td>
                                    
                                    <td class="text-center">
                                        <a href="javascript:void(0)" onclick="Edit('{{$cliente->id}}')" id="edit_btn" class="btn btn-dark mtmobile" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
    
                                        <a href="javascript:void(0)" onclick="Confirm('{{$cliente->id}}')" class="btn btn-dark" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <td colspan="5" class="text-center"> <h6>No hay clientes registrados</h6></td>
                                @endif
                            </tbody>
                        </table>
                        {{$clientes->links()}}
                    </div>
                </div>
            </div>
        </div>
    
        @include('clientes.form')
    
    </div>
@endsection      
<script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
  
<script>
    $(document).ready(function(){
        $('#btnCliente').click(function(e){
            e.preventDefault();
            var data = $('#formCliente').serialize();

            $.ajax({
                type:'POST',
                url: '{{route('clientes.store')}}'  ,
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
            text: '¿DESEA ELIMINAR EL CLIENTE?',
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
        let aux = "{{ route('clientes.delete', 'id') }}";

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
        let aux = "{{ route('clientes.delete', 'id') }}";

        var ruta = aux.replace('id', id);
        $.ajax({
          url: "{{ route('clientes.get') }}"+"/"+id,
          type: 'GET',
          data: { id },
          dataType: "json",
          success: function (data) {
               document.getElementById('nombre').value = data[0].nombre;
               document.getElementById('apellido_materno').value = data[0].apellido_materno;
               document.getElementById('apellido_paterno').value = data[0].apellido_paterno;
               document.getElementById('id').value = data[0].id;
               document.getElementById('email').value = data[0].email;
               document.getElementById('telefono').value = data[0].telefono;
               document.getElementById('h5T').innerHTML='<b>Cliente</b>| ACTUALIZAR'
               document.getElementById('btnCliente').innerHTML='ACTUALIZAR'
              $("#theModal").modal('show');
          }

      });
    }

    function limpiarModal(){
            document.getElementById('nombre').value = '';
            document.getElementById('apellido_materno').value = '';
            document.getElementById('apellido_paterno').value = '';
            document.getElementById('id').value = 0;
            document.getElementById('email').value = '';
            document.getElementById('telefono').value = '';
            document.getElementById('h5T').innerHTML='<b>Cliente</b>| CREAR'
            document.getElementById('btnCliente').innerHTML='CREAR'
    }

</script>
    