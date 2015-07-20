<?php
class PacienteModel
{
	private $pdo;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '');
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);		        
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM paciente");
			$stm->execute();

			foreach($stm->fetchAll(PDO::FETCH_OBJ) as $r)
			{
				$alm = new Paciente();

				$alm->__SET('id', $r->id);
				$alm->__SET('Nombre', $r->Nombre);
				$alm->__SET('Apellido', $r->Apellido);
				$alm->__SET('Sexo', $r->Sexo);
				$alm->__SET('FechaNacimiento', $r->FechaNacimiento);
				$alm->__SET('Medico', $r->Medico);
				$alm->__SET('Detalles', $r->Detalles);

				$result[] = $alm;
			}

			return $result;
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM paciente WHERE id = ?");
			          

			$stm->execute(array($id));
			$r = $stm->fetch(PDO::FETCH_OBJ);

			$alm = new Paciente();

			$alm->__SET('id', $r->id);
			$alm->__SET('Nombre', $r->Nombre);
			$alm->__SET('Apellido', $r->Apellido);
			$alm->__SET('Sexo', $r->Sexo);
			$alm->__SET('FechaNacimiento', $r->FechaNacimiento);
			$alm->__SET('Medico', $r->Medico);
			$alm->__SET('Detalles', $r->Detalles);

			return $alm;
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("DELETE FROM paciente WHERE id = ?");			          

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar(Paciente $data)
	{
		try 
		{
			$sql = "UPDATE paciente SET 
						Nombre          = ?, 
						Apellido        = ?,
						Sexo            = ?, 
						FechaNacimiento = ?,
						Medico          = ?, 
						Detalles        = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				array(
					$data->__GET('Nombre'), 
					$data->__GET('Apellido'), 
					$data->__GET('Sexo'),
					$data->__GET('FechaNacimiento'),
					$data->__GET('id'),
					$data->__GET('Medico'), 
					$data->__GET('Detalles')
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Registrar(Paciente $data)
	{
		try 
		{
		$sql = "INSERT INTO paciente (Nombre,Apellido,Sexo,FechaNacimiento,Medico,Detalles) 
		        VALUES (?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
			array(
				$data->__GET('Nombre'), 
				$data->__GET('Apellido'), 
				$data->__GET('Sexo'),
				$data->__GET('FechaNacimiento'),
				$data->__GET('Medico'), 
				$data->__GET('Detalles')
				)
			);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}