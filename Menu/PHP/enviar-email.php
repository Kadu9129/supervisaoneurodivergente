<?php
// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. DADOS DO EMAIL QUE VOCÊ VAI RECEBER
    // =======================================================
    $para = "contato@supervisaoneurodivergente.com.br"; // <<---- COLOQUE SEU E-MAIL AQUI
    $assunto = "Nova mensagem do formulário de contato";
    // =======================================================

    // 2. PEGANDO OS DADOS DO FORMULÁRIO
    // =======================================================
    // A função trim() remove espaços em branco no início e no fim
    $nome = trim($_POST["nome"]);
    $email = trim($_POST["email"]);
    $mensagem = trim($_POST["mensagem"]);
    // =======================================================

    // 3. VALIDAÇÃO BÁSICA (PARA EVITAR CAMPOS VAZIOS)
    // =======================================================
    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Formato de e-mail inválido.";
        exit;
    }
    // =======================================================

    // 4. MONTANDO O CORPO DO E-MAIL
    // =======================================================
    $corpo_email = "Você recebeu uma nova mensagem do seu site:\n\n";
    $corpo_email .= "Nome: " . htmlspecialchars($nome) . "\n";
    $corpo_email .= "E-mail: " . htmlspecialchars($email) . "\n";
    $corpo_email .= "Mensagem:\n" . htmlspecialchars($mensagem) . "\n";
    // =======================================================

    // 5. CONFIGURANDO OS CABEÇALHOS DO E-MAIL (HEADERS)
    // =======================================================
    // É importante para evitar que o e-mail caia na caixa de SPAM
    $headers = "From: contato@supervisaoneurodivergente.com.br\r\n"; // Use um e-mail do seu domínio
    $headers .= "Reply-To: " . $email . "\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    $headers .= "X-Mailer: PHP/" . phpversion();
    // =======================================================

    // 6. ENVIANDO O E-MAIL
    // =======================================================
    if (mail($para, $assunto, $corpo_email, $headers)) {
        // Se o e-mail for enviado com sucesso, redireciona para uma página de sucesso
        header("Location: /Menu/SubHTML/obrigado.html");
    } else {
        // Se houver uma falha, exibe uma mensagem de erro
        echo "Houve um erro ao enviar a mensagem. Tente novamente mais tarde.";
    }
    // =======================================================

} else {
    // Se alguém tentar acessar o arquivo diretamente, redireciona para a página inicial
    header("Location: /Menu/menu.html");
    exit;
}
?>