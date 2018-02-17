<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class copias extends Aplicacion{
/**
 * controlador de gestión de usuarios.
 */
 

	function __construct()
	{
		parent::__construct();
		$this->appcode=32;
		$this->titulo2="Procedimiento de respaldo";
	}
	
	
	
	
	
	//Carga la vista principal del controlador de usuarios
	function index()
	{
		$this->login(array("Administrador"));
		$this->args['contenidoVista']=$this->load->view("admin/copias_v",$this->datos,true);
		$this->generarVista();
	}
	
	
	function db()
	{
		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		
		$prefs = array(
					'tables'      => array(),  // Array of tables to backup.
					'ignore'      => array(),           // List of tables to omit from the backup
					'format'      => 'zip',             // gzip, zip, txt
					'filename'    => 'sicoin-db.sql',    // File name - NEEDED ONLY WITH ZIP FILES
					'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
					'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
					'newline'     => "\n"               // Newline character used in backup file
				  );


		$backup =& $this->dbutil->backup($prefs);

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		write_file('/respaldos/backup.zip', $backup); 

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('sicoin-db.zip', $backup);
	}

}