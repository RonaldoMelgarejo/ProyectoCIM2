<div class="conatiner-fluid content-inner mt-n5 py-0">
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Bootstrap Datatables</h4>
               </div>
            </div>
            <div class="card-body">
               <!-- <p>Images in Bootstrap are made responsive with <code>.img-fluid</code>. <code>max-width: 100%;</code> and <code>height: auto;</code> are applied to the image so that it scales with the parent element.</p> -->
               <div class="table-responsive">
                  <table id="tablePotencia" class="table table-striped" data-toggle="data-table">
                     <thead>
                        <tr>
                           <th>Nro</th>
                           <th>Voltaje [V]</th>
                           <th>Corriente [A]</th>
                           <th>Potencia [W]</th>
                           <th>Fecha y Hora</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                           $indice=1; //le damos valor al indice para no mostrar el id

                           foreach($medicion->result() as $row){  //$estudiante se rescata del controlador estudiante con el mismo nombre que esta en el array asociativo $row solo es una variable que almacena datos 
                           ?>

                           <tr>
                              <th scope="row"><?php echo $indice; ?></th>
                              <td><?php echo $row->voltaje; ?></td>   <!--nombre es el parametro de BD y debe ser escrito como en la BD y $row es el dato almacenado momentaneamente-->
                              <td><?php echo $row->corriente; ?></td>
                              <td><?php echo $row->potencia; ?></td>
                              <td><?php echo formatearFecha($row->fechaHoraMedicion); ?></td>
                           </tr>

                           <?php
                           $indice++;
                           }
                        ?>  
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>Nro</th>
                           <th>Voltaje [V]</th>
                           <th>Corriente [A]</th>
                           <th>Potencia [W]</th>
                           <th>Fecha y Hora</th>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
      </div>

      <script>
        $(document).ready(function() {
         var table = $('#tablePotencia').DataTable();
         table.destroy();

         // Luego, puedes inicializar la tabla nuevamente
         $('#tablePotencia').DataTable({
            "language": {
               "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
            }
         });
        });
      </script>