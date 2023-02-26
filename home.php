<?php
// Realiza a conexão com o banco de dados MySQL
$host = "localhost"; // Endereço do servidor
$user = "root"; // Nome do usuário
$password = ""; // Senha do usuário
$dbname = "ursos_sem_curso"; // Nome do banco de dados

$conn = mysqli_connect($host, $user, $password, $dbname);

// Verifica se a conexão foi estabelecida com sucesso
if (!$conn) {
  die("Falha na conexão com o banco de dados: " . mysqli_connect_error());
}

// Recebe os dados do formulário
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$idade = isset($_POST['idade']) ? $_POST['idade'] : null;
$profissao = isset($_POST['profissao']) ? $_POST['profissao'] : null;
$resumo = isset($_POST['resumo']) ? $_POST['resumo'] : null;
$foto = isset($_FILES['foto']['name']) ? $_FILES['foto']['name'] : null;

$alertaCadastro = '';

if ($nome && $idade && $profissao && $resumo && $foto) {
  // Salva a imagem no servidor
  $tmpName = $_FILES['foto']['tmp_name'];
  $destino = 'uploads/' . $foto;
  move_uploaded_file($_FILES["foto"]["tmp_name"], $destino);

  // Insere os dados no banco de dados
  $sqlInsert = "INSERT INTO cadastro (nome, idade, profissao, resumo, foto) VALUES ('$nome', '$idade', '$profissao', '$resumo', '$destino')";

  if (mysqli_query($conn, $sqlInsert)) {
    $alertaCadastro = "Cadastro realizado com sucesso!";
  } else {
    $alertaCadastro = "Erro ao realizar o cadastro: " . mysqli_error($conn);
  }

  header("location: home.php");
}

$integrantes = array();
$mensagem = '';

// Insere os dados no banco de dados
$sqlSelect = "SELECT * FROM cadastro";
$result = mysqli_query($conn, $sqlSelect);

if (mysqli_num_rows($result) > 0) {
  $integrantes = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
  $mensagem = "Nenhum resultado encontrado";
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Ursos Sem Curso</title>
  <link rel="stylesheet" href="estilos.css"/>
</head>
<body>
  <div class="lista-container">
    <h1 class="titulo">Sobre o grupo "Ursos Sem Curso"</h1>
  <?php if ($integrantes): ?>
    <div class="lista-integrantes">
      <ul>
        <?php foreach ($integrantes as $integrante): ?>
          <li>
            <img src="<?php echo $integrante['foto']; ?>" alt="" class="foto-integrante" />
            <h3><?=$integrante['nome']; ?></h3>
            <p><?=$integrante['idade']; ?> anos</p>
            <p><?=$integrante['profissao']; ?></p>
            <p><?=$integrante['resumo']; ?></p>
          </li>
        <?php endforeach;?>
      </ul>
    </div>
  <?php else: ?>
  <p class="mensagem"><?=$mensagem?></p>
  <?php endif; ?>
  <a href="cadastro.php">
      <button class="botao adicionar">Adicionar Integrante</button>
    </a>
  </div>
	<img src="./ursos-sem-curso.png" alt="Segunda imagem" id="segunda-imagem">
</body>
</html>