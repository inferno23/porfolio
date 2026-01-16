<table>
    <thead>
    <tr>
    <th>N°</th>
        <th>Nombre y Apellido</th>
        <th>Email</th>
        <th>Rol</th>
        <th>N° de Celular</th>
        <th>N° de Teléfono</th>
        <th>Organización</th>
        <th>Cargo</th>
        <th>Campaña para el Cargo de</th>
        <th>Precandidato</th>
        <th>Tiempo de Suscripción</th>
        <th>Estado</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
        <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>  <?php    if ($user->role == 1) echo 'Administrador General';
                           if ($user->role == 2) echo 'Administrador de Cliente';
                           if ($user->role == 3) echo 'Fiscal';
                           if ($user->role == 4) echo 'Administrador Plan Básico';
                           if ($user->role == 5) echo 'Administrador Plan Bronce';
                           if ($user->role == 6) echo 'Administrador Plan Plata';
                           if ($user->role == 7) echo 'Administrador Plan Oro';
                           if ($user->role == 8) echo 'Administrador Plan Platino';
                
                ?></td>
            <td>{{ $user->celular }}</td>
            <td>{{ $user->telefono }}</td>
            <td>{{ $user->organizacion_id }}</td>
            <td>{{ $user->cargo }}</td>
            <td>{{ $user->detalle }}</td>
            <td>{{ $user->precandidato }}</td>
            <td>{{ $user->tiempo_suscripcion }}</td>
            <td>  <?php   if ($user->is_active == 1) echo 'Activo';
                          if ($user->is_active == 0) echo 'Inactivo';
                
                ?></td>
            
        </tr>
    @endforeach
    </tbody>
</table>