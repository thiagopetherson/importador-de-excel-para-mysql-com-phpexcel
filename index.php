<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Importando Arquivo do Excel</title>

</head>
    
<body>
	
   		<form enctype="multipart/form-data" id="formulario-arquivo" method="post" action="import.php">		                        
			
			<input  type="file" name="arquivo" id="arquivo"  required>
			
			<div class="text-right">	
				<input class="btn btn-dark btn-sm" type="submit" name="enviar" id="enviar" value="Importar">
			</div>    
		</form>
		
		
  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
  <script src="script.js"></script>
  
</body>
</html>
    
  