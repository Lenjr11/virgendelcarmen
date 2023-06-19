<?php include_once 'view/pagcole/navbar.php'; ?>

<script src="js/inscripcion.js?rev=<?php echo time(); ?>"></script>
<!-- Header Start -->
<div class="container-fluid page-header">
    <div class="container">
        <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
            <h3 class="display-4 text-white text-uppercase">Matrículas 2024</h3>
            <div class="d-inline-flex text-white">
                <p class="m-0 text-uppercase"><a class="text-white" href="index.php">Inicio</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Matrículas 2024</p>
            </div>
        </div>
    </div>
</div>
<!-- Header End -->

<!-- Contact Start -->
<div class="container-fluid py-5">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1>Separa tu vacante!</h1>
            <p>Registra los datos de tu hijo(a) y nos comunicaremos contigo para darle una mejor información para
                realizar el proceso de matrícula</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="contact-form bg-secondary rounded p-5">
                    <div id="success"></div>
                    <form  id="alumnovacante" novalidate="novalidate">
                        <div class="control-group">
                            <input type="text" class="form-control border-0 p-4" id="dni"
                                placeholder="DNI del alumno" minlength="8" maxlength="8" onkeypress="return soloNumeros(event)"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control border-0 p-4" id="nombre"
                                placeholder="Nombre del alumno"  maxlength="35" onkeypress="return soloLetras(event)"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control border-0 p-4" id="apellido"
                                placeholder="Apellidos del alumno" maxlength="35" onkeypress="return soloLetras(event)"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control border-0 p-4" id="correo"
                                placeholder="Correo del Padre-apoderado" maxlength="30"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control border-0 p-4" id="telefono"
                                placeholder="Telefono/Celular"  maxlength="9" onkeypress="return soloNumeros(event)"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <select class="select mb-3 form-control" id="grado" placeholder="Grado de interés"
                                style="width:100%">
                                <option value="">Seleccione un grado de interés</option>
                                <option value="Inicial">Inicial</option>
                                <option value="Primaria">Primaria</option>
                                <option value="Secundaria">Secundaria</option>
                            </select>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control border-0 py-3 px-4" rows="5" id="consulta"
                                placeholder="Si tiene alguna consulta escribala aquí" maxlength="100"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary py-3 px-5" type="button" onclick="Registrar_inscripcion()"
                                >Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Contact End -->

<?php include_once 'view/pagcole/end.php'; ?>
