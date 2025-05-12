<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ticket</title>
<style>
 
 .col-md-12 {
    width: 100%;
} 

.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
    background-color: #ECF0F5;
}

.box-header {
    color: #444;
    display: block;
    padding: 10px;
    position: relative;
}

.box-header.with-border {
    border-bottom: 1px solid #f4f4f4;
}


.box-header .box-title {
    display: inline-block;
    font-size: 18px;
    margin: 0;
    line-height: 1;
}

.box-body {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    padding: 10px;

}


.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}


.table-bordered {
    border: 1px solid #f4f4f4;
}


.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}

table {
    background-color: transparent;
}

 .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
    border: 1px solid #f4f4f4;
}


.badge {
    display: inline-block;
    min-width: 10px;
    padding: 3px 7px;
    font-size: 12px;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    background-color: #777;
    border-radius: 10px;
}

.bg-red {
    background-color: #dd4b39 !important;
}


</style>
	  
</head>
<body>

<div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <img src="{!! asset('Rocky_Linux.png') !!}" width="400px" alt="">
                  <h3 class="box-title">Distribuidora de Productos S.A. de C.V.</h3>
                  <br />
                  <h3 class="box-title">DPF981221HG8</h3>
                  <br />
     <h3 class="box-title">Fecha de impresión - <?=  $date; ?></h3>
                  <br />
                  <h3 class="box-title">Datos del Cliente:</h3>
                  <br />
                  <h3 class="box-title">
                    <?= $data_venta->clientes->nombre.' '.$data_venta->clientes->ap_pat.' '.$data_venta->clientes->ap_mat; 
                    ?> 
                    &nbsp;&nbsp;&nbsp;RFC: EAML981212KL9</h3>
                    <br />
                  <h3 class="box-title">
                    <?= $data_venta->direccion.' Colonia '. 
                        $data_venta->colonia.', CP '.
                        $data_venta->cp.', '.
                        $data_venta->clientes->municipios->nombre.', Edo. de '.
                        $data_venta->clientes->municipios->entidades->nombre .', '.
                        $data_venta->clientes->municipios->entidades->paises->nombre; ?></h3> 
                   <br />
                   <h3 class="box-title">Fecha de venta - <?=  $data_venta->fecha; ?></h3>      
                  
                  
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table class="table table-bordered">
                  <thead>
                     <tr>
                      <td style="width: 10px">Cant</td>
                      <td style="width: 40px">Producto</td>
                      <td style="width: 40px">Precio</td>
                      <td style="width: 40px">Subtotal</td>
                    </tr>
                  </thead>
                    <tbody>
                  <?php foreach($data_detalle_venta as $det){ ?>
                 
                    <tr>
                      <td style="width: 10px" ><?= $det->cantidad; ?></td>
                      <td><?= $det->productos->nombre; ?></td>
                      <td><?= $det->precio_venta; ?></td>
                      <td><?= $det->precio_venta * $det->cantidad; ?></td>
                    </tr>
                    
                    <?php  } ?>
                    <tr>
                        <td colspan="4" >&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" >&nbsp;</td>
                        <td>Subtotal</td>
                        <td><?=  $data_venta->subtotal; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" >&nbsp;</td>
                        <td>IVA</td>
                        <td><?=  $data_venta->iva; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" >&nbsp;</td>
                        <td>TOTAL</td>
                        <td><?=  $data_venta->subtotal + $data_venta->iva; ?></td>
                    </tr>
                    
                  </tbody>

                  </table>
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                  
                </div>
              </div><!-- /.box -->              
            </div>
            

</body>
</html>


