<?php 


	require_once "../../controllers/VentasController.php";
	// require_once "../../controllers/UsuarioController.php";
	// require_once "../../controllers/ClienteController.php";


	require_once "../../models/Ventas.php";
	require_once "../../models/Usuarios.php";
	require_once "../../models/Clientes.php";

    $reporte = VentasController::descargarReporteVentas();

?>