<div class="card-body">
        <div class="table-responsive">

    
            <br>
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                                                
                                             
                    <th>Nombre y Apellido</th>
                        <th>DNI</th>
                        <th>Domicilio</th>
                        <th>N° de Contacto</th>
                        <th>Escuela</th>
                        <th>Fiscal General</th>
                        <th>Fiscal de Mesa</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($registros as $model)
                    <tr>
                        <td>{{ !empty($model->persona) ? $model->persona->nombre:'Sin asignar' }}</td>
                        <td>{{ !empty($model->persona) ? $model->persona->dni:'Sin asignar' }}</td>
                        <td>{{ $model->domicilio_real }}</td>
                        <td>{{ $model->telefono }}</td>
                        <td>{{ !empty($model->escuela) ? $model->escuela->name:'Sin asignar' }}</td>
                        <td {{ !empty($model->fiscal_general) ? 'class=btn-success ':'' }}>{{ !empty($model->fiscal_general) ? 'fiscal_general':'' }}</td>
                        <td>{{ !empty($model->fiscal_mesa) ? 'Mesa:'.$model->mesa:'' }}</td>
                       
                       
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
