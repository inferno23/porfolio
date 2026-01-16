<div class="card-body">
        <div class="table-responsive">

        <table  width="100%" cellspacing="0">
                <thead>
                    <tr>
                                                
                                               
                       
                        <th>Lista</th>
                       
                        <th>Partido</th>
                        <th>Senador</th>
                        <th>Diputados</th>
                        <th>Presidente</th>
                        <th>Gobernador</th>
                        <th>Diputado Prov</th>
                        <th>Intendente</th>
                        <th>Consejal</th>
                        <th>Comunal</th>
                        
                    </tr>
                </thead>

                <tbody>
                    @foreach($votos_senador as $model)
                    <tr>
                    <td>{{ !empty($model->lista	) ? $model->lista:' ' }}</td>
                    <td>{{ !empty($model->partido	) ? $model->partido:' ' }}</td>
                    <td>{{ !empty($model->sum	) ? $model->sum:'0' }}</td>
                    <td>{{ !empty($model->votos_diputado	) ? $model->votos_diputado:'0' }}</td>
                    <td>{{ !empty($model->votos_presidente	) ? $model->votos_presidente:'0' }}</td>
                    <td>{{ !empty($model->votos_gobernador	) ? $model->votos_gobernador:'0' }}</td>
                    <td>{{ !empty($model->votos_diputado_prov	) ? $model->votos_diputado_prov:'0' }}</td>
                    <td>{{ !empty($model->votos_intendente	) ? $model->votos_intendente:'0' }}</td>
                    <td>{{ !empty($model->votos_consejal	) ? $model->votos_consejal:'0' }}</td>
                    <td>{{ !empty($model->votos_comunal	) ? $model->votos_comunal:'0' }}</td>
  
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <br>
            <br>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                                                
                                                <th> Mesa</th>
                                                <th> Total del padron</th>
                        <th> Cantidad de votantes</th>
                       
                        <th>Lista</th>
                       
                        <th>Partido</th>
                        <th>Votos senador</th>
                        <th>Votos diputado</th>
                        <th>Presidente</th>
                        <th>Gobernador</th>
                        <th>Diputado Prov</th>
                        <th>Intendente</th>
                        <th>Consejal</th>
                        <th>Comunal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($telegramas as $model)
                    <tr>
                       
                        <td>{{ !empty($model->mesa) ? ''.$model->mesa:'' }}</td>
                        <td>{{ !empty($model->total_padron) ? ''.$model->total_padron:0 }}</td>
                        <td>{{ !empty($model->cantidad_votantes) ? ''.$model->cantidad_votantes:0 }}</td>
                   
  
                        <td>{{ !empty($model->candidato_id) && $model->candidato_id > 0 ? $model->candidato->lista:'- ' }}</td>
                         <td>{{ !empty($model->candidato_id) && $model->candidato_id > 0 ? $model->candidato->partido:'- ' }}</td>
                      
                        <td>{{ !empty($model->votos_senador	) ? $model->votos_senador:'0' }}</td>
                        <td>{{ !empty($model->votos_diputado	) ? $model->votos_diputado:'0' }}</td>
                        <td>{{ !empty($model->votos_presidente	) ? $model->votos_presidente:'0' }}</td>
                        <td>{{ !empty($model->votos_gobernador	) ? $model->votos_gobernador:'0' }}</td>
                        <td>{{ !empty($model->votos_diputado_prov	) ? $model->votos_diputado_prov:'0' }}</td>
                        <td>{{ !empty($model->votos_intendente	) ? $model->votos_intendente:'0' }}</td>
                        <td>{{ !empty($model->votos_consejal	) ? $model->votos_consejal:'0' }}</td>
                        <td>{{ !empty($model->votos_comunal	) ? $model->votos_comunal:'0' }}</td>
  
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
