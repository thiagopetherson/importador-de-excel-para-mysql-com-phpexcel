<?php  

require_once("vendor/autoload.php");
require_once("conexao/conexao.php");

//arquivo vindo do form ou de qualquer outro lugar
$arquivo = $_FILES['arquivo']['tmp_name'];

//print_r($_FILES);
//die(); 

/** detecta automaticamente o tipo de arruivo que será carregado */
$excelReader = PHPExcel_IOFactory::createReaderForFile($arquivo);


//Após configurados os parâmetros, passa o arquivo (do formato da planilha) para um objeto
$excelObj = $excelReader->load($arquivo);

//Transforma o objeto em array
$excelObj->getActiveSheet()->toArray(null, true,true,true);

//Pega os nomes das abas existentes na planilha
$worksheetNames = $excelObj->getSheetNames($arquivo);

$return = array();

//sei que essa parte define a aba ativa, e que por padrão a ultima aba é sempre a que fica ativa, porém não entendi completamente o funcionamento
foreach($worksheetNames as $key => $sheetName)
{  
	//define a aba ativa
	$excelObj->setActiveSheetIndexByName($sheetName);

	//cria um array(MATRIZ) com o nome da aba como índice
	$return[$sheetName] = $excelObj->getActiveSheet()->toArray(null, true,true,true);
}

//Esse contador é usado para pularmos a primeira linha da planilha (que no caso é o cabeçalho)
//Se não houvesse cabeçalho, seria só tirar essa lógica do $i
$i = 0; 

foreach($return as $key => $value)
{
	foreach($value as $k => $v)
	{
		if($i === 0)
		{
			$i++;
			continue;
		}	

		$query = "INSERT INTO tbl_import_excel(nome,idade,sexo,estado_civil,cidade,uf)
				  VALUES(:nome,:idade,:sexo,:estado_civil,:cidade,:uf)";

		$stmt = $conn->prepare($query);
		$stmt->bindValue(':nome',trim($v['A']));
		$stmt->bindValue(':idade',trim($v['B']));
		$stmt->bindValue(':sexo',trim($v['C']));
		$stmt->bindValue(':estado_civil',trim($v['D']));
		$stmt->bindValue(':cidade',trim($v['E']));
		$stmt->bindValue(':uf',trim($v['F']));

		$result = $stmt->execute();

		if(!$result)
		{
			 print_r($stmt->errorInfo());
		}
		
	}
}

$retorno = "sucesso";

echo json_encode($retorno);
die();

		/*
		if($stmt->execute())
		{
			echo "sucesso" ;
		}
		else
		{
		   print_r($stmt->errorInfo());
		}
		*/
?>
