<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Ursos Sem Curso</title>
  <link rel="stylesheet" href="estilos.css">
</head>
<body>
  <div class="cadastro-container">
	<h1>Cadastro de Bio</h1>
	<form method="post" action="home.php" enctype="multipart/form-data">
		<label for="foto">Foto:</label>
		<input type="file" name="foto" onchange="previewImagem(event)"/><br>
		<img id="preview" class="preview" src="" alt="">

		<label for="nome">Nome:</label>
		<input type="text" name="nome" required/><br>

		<label for="idade">Idade:</label>
		<input type="number" name="idade" required/><br>

		<label for="profissao">Profissão:</label>
		<input type="text" name="profissao" required/><br>

		<label for="resumo">Resumo:</label>
		<textarea name="resumo" required></textarea><br>

    <div class="form-actions">
      <a href="home.php">
        <button class="voltar" formnovalidate>Voltar</button>
      </a>
      <input class="botao" type="submit" value="Enviar Cadastro">
    </div>
	</form>
	<img src="./ursos-sem-curso.png" alt="Segunda imagem" id="segunda-imagem">
</div>


	<script>
		function previewImagem(event) {
			var imagem = document.getElementById('preview');
			imagem.src = URL.createObjectURL(event.target.files[0]);
		}
	</script>
</body>
</html>

