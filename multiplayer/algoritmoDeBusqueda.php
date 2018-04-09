<?php
class BusquedaContrincante
{
	private $usuario;
	private $host;
	private $hostUser;
	private $hostContra;
	private $hostDB;
	
	public function __construct($usuar)
	{
		$this->usuario=$usuar;
		$contDB = file("../engine/datosDB/dbName.txt");
		$contUser = file("../engine/datosDB/username.txt");
		$contUrl = file("../engine/datosDB/url.txt");
		$contPass = file("../engine/datosDB/pass.txt");
		$this->host = $contUrl[0];
		$this->hostUser = $contUser[0];
		
		if ($contPass[0] == "0") {
			$this->hostContra = "";
		} else {
			$this->hostContra = $contPass[0];
		}
		$this->hostDB = $contDB[0];
	}
	
	public function RegistrarEnDB() //funcion que guarda usuarios buscando partidas actualmente en la DB
	{
		$conex=new mysqli($this->host,$this->hostUser,$this->hostContra,$this->hostDB);
		if($conex->connect_error)//comprobando conexion
		{
			echo "Error en la conexion 1: ". $conex->connect_error;
			exit();
		}
		
		/*esta consulta es solo mientras este en testeo este modo*/
		if($conex->query("delete from UsuariosBuscandoPartida where usuario=\"$this->usuario\""))
		{
			
		}
		
		//comprobando si ya esta el usuario
		if(!$consultaRepeticion = $conex->query("select usuario from UsuariosBuscandoPartida where Usuario=\"$this->usuario\""))
		{
			echo "Error en la consulta select: " . $conex->error;
			exit();
		}
		if($consultaRepeticion->num_rows > 0)
		{
			echo "Error: no puede realizar la peticion 2 veces";
			exit();
		}
		//añadiendo usuario a la tabla de busqueda
		if($conex->query("insert into UsuariosBuscandoPartida(usuario,usuarioEmparejado) values (\"$this->usuario\",False)") != true)
		{
			echo "Problema en el insert: " . $conex->error;
			exit();
		}
		//cerrando conexion y pasando a la funcion de emparejamiento
		$conex->close();
		$this->JuntarJugadores();
	}
	
	private function JuntarJugadores()
	{
		//aumentando tiempo de ejecucion para la busqueda de rival
		ini_set('max_execution_time', 240); //240 segundos = 4 minutos
		
		$conex=new mysqli($this->host,$this->hostUser,$this->hostContra,$this->hostDB);
		
		$maximoBusqueda = 0;
		
		if($conex->connect_error)//comprobando conexion
			{
				echo "Error en la conexion 2: ". $conex->connect_error;
				exit();
			}
			
		$emparejados=False;

		do{
			sleep(1);
			$maximoBusqueda++;

			
			
			if($maximoBusqueda>=5)
			{
				$conex->query("delete from UsuariosBuscandoPartida where usuario=\"$this->usuario\"");
				
				echo 'Lo lamentamos, intentelo nuevamente.<br><button class="boton1 boton1-grande" name="btnBuscarRival">Buscar Rival</button>';
				exit();
			}

			if(!$resultado=$conex->query("select * from UsuariosBuscandoPartida where usuario='$this->usuario' and usuarioEmparejado=1"))
			{
				echo "Problema en el select: " . $conex->error;
				exit();
			}
			elseif($resultado->num_rows > 0)
			{
				echo "Ya esta emparejado";
				exit();
			}
			else
			{
				if(!$conex->query("update usuariosBuscandoPartida set usuarioEmparejado=1 where usuario='$this->usuario'"))
				{
					echo "Error en el select: " . $conex->error;
					exit();
				}

				if(!$consultacant=$conex->query("select count(usuario) as 'cantidad' from UsuariosBuscandoPartida"))
				{
					echo "Error en el select: " . $conex->error;
					exit();
				}
				
				$cantidadUsuarios=$consultacant->fetch_array(MYSQLI_ASSOC);
				
				$consultacant->free();
				
				
				
				
				
				if(!$consultaUsers=$conex->query("select usuario as 'usuarios' from UsuariosBuscandoPartida"))
				{
					echo "Error en el select: ". $conex->error;
					exit();
				}
				
				$numeroCols=$consultaUsers->num_rows;
				
				if($numeroCols>1)
				{
					$i=0;

					while($arrayUsersActivos=$consultaUsers->fetch_array(MYSQLI_ASSOC))
					{
						$UsuariosActivos[$i]=$arrayUsersActivos['usuarios'];
						$i++;
					}

					do{

						$numeroA=rand(0,($cantidadUsuarios['cantidad']-1));
					
						$versus1=$UsuariosActivos[$numeroA];

						}while($versus1 == $this->usuario);

					

					

					if(!$resultado=$conex->query("select * from UsuariosBuscandoPartida where usuario='$versus1' and usuarioEmparejado=0"))
					{
						echo "Error en el update: ". $conex->error;
						exit();
					}
					elseif($resultado->num_rows > 0)
					{
						if(!$conex->query("update usuariosBuscandoPartida set usuarioEmparejado=1 and contrincante='$this->usuario' where usuario='$versus1'"))
						{
							echo "Error en el update: ". $conex->error;
							exit();
						}

						$versus2=$this->usuario;
					
						echo $versus1 . " vs " . $versus2;
						exit();
						
						
						
						/*if(!$conex->query("delete from UsuariosBuscandoPartida where
						Usuario=\"$versus1\" or Usuario=\"$versus2\""))
						{
							echo "Problemas con el delete: ". $conex->error;
						}*/
					}
					else
					{
						if(!$conex->query("update usuariosBuscandoPartida set usuarioEmparejado=0 where usuario='$this->usuario'"))
						{
							echo "Error en el select: " . $conex->error;
							exit();
						}
							
					}
				}

				}

			
			
			
			}while(!$emparejados);
			
			$conex->close();
	}
}


