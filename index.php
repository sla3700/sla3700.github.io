<?php
	header("Content-Type: application/json; charset=utf-8"); 

	/* prepara o documento para comunicação com o JSON, as duas linhas a seguir são obrigatórias 
	  para que o PHP saiba que irá se comunicar com o JSON, elas sempre devem estar no ínicio da página */
// Dados do servidor da Hostinger
	$servidor = 'sql313.epizy.com';
	$usuario  = 'epiz_22763228';
	$senha    = 'SxSXE905';
	$banco    = 'epiz_22763228_commands';

	try {
		$conecta = new PDO("mysql:host=$servidor;dbname=$banco", $usuario , $senha);
		$conecta->exec("set names utf8"); //permite caracteres latinos.
		$consulta = $conecta->prepare('SELECT * FROM comandos');
		$consulta->execute(array());  
		$resultadoDaConsulta = $consulta->fetchAll();
        		$StringJson = "[";

	if ( count($resultadoDaConsulta) ) {
    
		foreach($resultadoDaConsulta as $registro) {
            			if ($StringJson != "[") {$StringJson .= ",";}
	$StringJson .= '{"nome":"' . $registro['name']  . '",';
			$StringJson .= '"desc":"' . $registro['description']  . '",';	
			$StringJson .= '"autor":"' . $registro['author']    . '",';	
			$StringJson .= '"exec":"' . $registro['exec'] . '"}';

		}  
        		$StringJson .= "]"; // Exibe o vettor JSON

        $a = json_decode($StringJson, true);
		echo $StringJson; // Exibe o vettor JSON
  } 
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage(); // opcional, apenas para teste
}
?>
