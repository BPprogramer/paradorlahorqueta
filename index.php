<?php 

    // require 'models/Conexion.php';

	if(!isset($_ENV)==0){
		
		require __DIR__.'/vendor/autoload.php';
		$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
		$dotenv->safeLoad();
	
		
	}



   
	require_once "hlpers/funciones.php";
	require_once "controllers/PlantillaController.php";
	require_once "controllers/VentasController.php";
	require_once "controllers/CategoriasController.php";
	require_once "controllers/CrearVentaController.php";
	require_once "controllers/ProductosController.php";
	require_once "controllers/ReporteVentasController.php";
	require_once "controllers/UsuarioController.php";
	// require_once "controllers/ClienteController.php";


	require_once "models/Ventas.php";
	require_once "models/Categorias.php";
	require_once "models/CrearVenta.php";
	//require_once "models/Productos.php";
	require_once "models/ReporteVentas.php";
	require_once "models/Usuarios.php";
	require_once "models/Clientes.php";



	$plantilla = new PlantillaController();
	$plantilla->ctrPlantilla();
