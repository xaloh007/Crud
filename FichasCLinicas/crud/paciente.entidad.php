<?php
class Paciente
{
	private $id;
	private $Nombre;
	private $Apellido;
	private $Sexo;
	private $FechaNacimiento;
	private $Medico;
	private $Detalles;

	public function __GET($k){ return $this->$k; }
	public function __SET($k, $v){ return $this->$k = $v; }
}