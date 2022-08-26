<?php include 'conexion.php';?>
<!doctype html>
<html lang="es">



  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Verificador de credenciales MedicalRed chile">
    <meta name="author" content="Wiflash">
    <link rel="icon" href="favicon.ico">
<title>Verificador de credenciales | MedicalRed Chile</title>
<!-- Bootstrap core CSS -->
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="assets/css/sticky-footer-navbar.css" rel="stylesheet">
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
<!--Validacion de rut-->

  </head>
  


  <body>
    <header>
  

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Privilegios requeridos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        
      </div>
      <div class="modal-body">
        Para ingresar al sistema necesitas de un usuario y contraseña.</br>
       <p align="center"> ¿Cuentas con los privilegios necesarios? </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button onclick="location='https://www.medicalredchile.cl/MRC'" type="button" class="btn btn-primary">Acceder</button>
      </div>
    </div>
  </div>
</div>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" style="color:#fff"; >MedicalRed Chile</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto">
           
            <li class="nav-item active">
              <a class="badge badge-warning"  href="index.php">Limpiar búsqueda <span class="sr-only">(current)</span></a>
            </li>  
                     
          </ul>
          <form class="form-inline mt-2 mt-md-0">
                <!-- Button trigger modal -->
<button type="button" class="btn btn-light" data-toggle="modal" data-target="#exampleModal">
  Ingresar
</button>
          </form>
        </div>
      </nav>
    </header>

    <!-- Begin page content -->

<div class="container">
  <hr>
<h3>Ingrese rut del titular <span class="badge badge-secondary">sin . </span></h3>


<div class="alert alert-primary" role="alert">
  Si no hay resultados, es porque no existen datos correspondientes al rut ingresado en nuestra base de datos.
</div>
 <hr>

<div class="row">
  <div class="col-12 col-md-12">
<!-- Contenido -->   



<ul class="list-group">
  <li class="list-group-item">
<form id="validacion-live" method="post">
  <div class="form-row align-items-center">
    <div class="col-auto">
      
      <input maxlength="10" onkeypress="return validar(event)" required name="RutTitular" type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Ejemplo: 14054804-9">  
 
    </div>
   
    <div class="col-auto">
      <button type="submit" class="btn btn-primary mb-2">Comprobar credencial</button>
      
            
            
    </div>
  </div>
</form>
  </li>

</ul>
<style>
.bluetext {
        color: blue;
}
</style>

<?php
 
if(!empty($_POST))
{
      $aKeyword = explode(" ", $_POST['RutTitular']);
      $query ="SELECT * FROM u_yf_registrocredencial WHERE ruttitular like '" . $aKeyword[0] . "' OR ruttitular like '" . $aKeyword[0] . "'";
      
     for($i = 1; $i < count($aKeyword); $i++) {
        if(!empty($aKeyword[$i])) {
            $query .= " OR ruttitular like '" . $aKeyword[$i] . "'";
        }
      }
     
     $result = $db->query($query);
     echo "<br>Has buscado el rut:<b> ". $_POST['RutTitular']."</b>";
                     
     if(mysqli_num_rows($result) > 0) {
        $row_count=0;
        echo "<br><br>Resultados encontrados: ";
        echo "<br><table class='table table-striped'>";
        While($row = $result->fetch_assoc()) {   
            $row_count++;                         
            echo "<tr><td><P class='bluetext' >Nombre: </p>". $row['nombretitular'] . "</td><td><p class='bluetext' >Estado: </p>". $row['estado'] . "</td></tr>";
        }
        echo "</table>";
	
    }
    else {
        echo "<br>Resultados encontrados: Ninguno, No existen datos del titular ingresado en nuestra base de datos para validar. ";
		
    }
}
 
?>




<!-- Fin Contenido --> 
</div>
</div><!-- Fin row -->
</div><!-- Fin container -->
    <footer class="footer">
      <div class="container">
        <span class="text-muted"><p>Comprobación exclusiva para clientes <a href="https://www.medicalredchile.cl" target="_blank">© MedicalRed</a></p></span>
      </div>
    </footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>

<!--Generador de guion-->
<script src="jquery.rut.js"></script>
    <script type="text/javascript">
      $(function(){
        $("form#validacion-live input").rut({formatOn: 'keyup', validateOn: 'keyup'}).on('rutInvalido', function(){ $(this).parents(".control-group").addClass("error")}).on('rutValido', function(){ $(this).parents(".control-group").removeClass("error")});
      });
    </script>
<!--Validacion solo numero y guion-->
<script>
function validar(e){
  tecla = (document.all) ? e.keyCode : e.which;
  tecla = String.fromCharCode(tecla)
  return /^[0-9k\-]+$/.test(tecla);
}
</script>

    </body>
</html>