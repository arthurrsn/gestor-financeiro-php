# 💰 Gestor Financeiro — PHP

Trabalho em dupla desenvolvido para a disciplina de PHP.  
Sistema web de controle financeiro pessoal com autenticação, registro de transações e histórico.

---

## 🚀 Como rodar o projeto

### Pré-requisito
Ter o **XAMPP** ou **LAMPP** instalado na máquina.

### Passos

1. Copie a pasta do projeto para dentro de `htdocs`:
   ```
   /opt/lampp/htdocs/php-trabalho/   ← Linux
   C:\xampp\htdocs\php-trabalho\     ← Windows
   ```

2. Inicie o servidor Apache pelo painel do XAMPP ou pelo terminal:
   ```bash
   /opt/lampp🔒 
    
   ❯ sudo ./manager-linux-x64.run
   ```

3. Abra o navegador e acesse:
   ```
   http://localhost/php-trabalho/login.php
   ```

> ⚠️ O arquivo de entrada do sistema é o **`login.php`**. Sempre inicie por ele.

---

## 🔐 Credenciais de acesso

| Campo   | Valor   |
|---------|---------|
| Usuário | `admin` |
| Senha   | `12345`   |

---

## 📁 Estrutura de arquivos

```
php-trabalho/
├── login.php          → Página de login com autenticação
├── index.php          → Dashboard principal com saldo e formulário
├── historico.php      → Histórico completo de transações
├── session.php        → Controle de sessão e proteção de páginas
├── funcoes.php        → Funções reutilizáveis (cálculos e formatação)
├── logout.php         → Encerra a sessão e redireciona ao login
├── style.css          → Estilização do sistema
└── includes/
    ├── header.php     → Cabeçalho HTML comum
    ├── menu.php       → Barra de navegação
    └── footer.php     → Rodapé HTML comum
```

---

## ⚙️ Funcionalidades

- Login com senha criptografada (`password_hash` / `password_verify`)
- Registro de **receitas** e **despesas**
- Cálculo automático do **saldo atual**
- Histórico com impacto de cada transação no saldo
- Percentual de cada despesa/receita sobre o total
- Botão para **zerar o mês** / limpar histórico
- Controle de acesso: páginas protegidas por sessão
- Dados persistidos via `$_SESSION` durante a navegação

---

## 🛠️ Tecnologias utilizadas

- PHP (sessões, POST/GET, funções, arrays associativos)
- HTML5 + CSS3
- Google Fonts (Syne + DM Sans)