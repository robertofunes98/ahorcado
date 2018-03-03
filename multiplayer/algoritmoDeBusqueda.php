<?php

class BusquedaContrincante
{
	private $usuario;
	
	public function __construct($usuar)
	{
		$this->usuario=$usuar;
	}
	
	public function RegistrarEnDB() //funcion que guarda usuarios buscando partidas actualmente en la DB
	{
		$conex=mysqli_connect("localhost","root","mysql","PruebaAhorcado") or die("Problemas con la conexion1");

		
		mysqli_query($conex,"insert into UsuariosBuscandoPartida(Usuario) values (\"$this->usuario\")") or 
		die("problema en el insert". mysqli_error($conex));
		
		mysqli_close($conex);
		
		$this->JuntarJugadores();
	}
	
	
	private function JuntarJugadores()
	{
		$conex=mysqli_connect("localhost","ref98","mysql","PruebaAhorcado") or die("Problemas con la conexion2");
		
		$consultacant=mysqli_query($conex,"select count(usuario) as 'cantidad' from UsuariosBuscandoPartida") or 
		die("problema en el select". mysqli_error($conex));
		
		$cantidadUsuarios=mysqli_fetch_array($consultacant);
		
		$numeroA=rand(0,($cantidadUsuarios['cantidad']-1));
		
		mysqli_close($conex);
		
		
		
		do{
			
			$conex=mysqli_connect("localhost","ref98","mysql","PruebaAhorcado") or die("Problemas con la conexion3");
		
			$consultaUsers=mysqli_query($conex,"select usuario as 'usuarios' from UsuariosBuscandoPartida") or 
			die("problema en el select". mysqli_error($conex));
		
		
			$numeroCols=mysqli_num_rows($consultaUsers);
			
			if($numeroCols>1)
			{
				
				$i=0;
			
				while($arrayUsersActivos=mysqli_fetch_array($consultaUsers))
				{
					$UsuariosActivos[$i]=$arrayUsersActivos['usuarios'];
					$i++;
				}
		
		
				mysqli_close($conex);
		
				$versus1=$UsuariosActivos[$numeroA];
		
				$numeroA=rand(0,($cantidadUsuarios['cantidad']-1));
		
				$versus2=$UsuariosActivos[$numeroA];
		
				echo $versus1 . " vs " . $versus2;
		
				$conex=mysqli_connect("localhost","ref98","mysql","PruebaAhorcado") or die("problemas con la conexion4");
		
				$borrarUsers=mysqli_query($conex,"delete from UsuariosBuscandoPartida where
				Usuario=\"$versus1\" or Usuario=\"$versus2\"") or die("Problemas con el delete: " .
				mysqli_error($borrarUsers));
		
				mysqli_close($conex);
		
			}
			
		
			}while($numeroCols<=1);
			
			
			$_POST["$versus1"];
			$_POST["$versus2"];
	}
}

$hola=new BusquedaContrincante("ref98");

$hola->RegistrarEnDB();



?>