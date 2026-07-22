# 📋 Agenda Virtual - Projeto de Estudo

Uma aplicação web simples e prática para gerenciar contatos de forma rápida e eficiente. Projeto desenvolvido com fins educacionais para estudar operações CRUD (Create, Read, Update, Delete) com PHP e integração com banco de dados MySQL.

---

## 📌 Objetivo do Projeto

Este projeto foi desenvolvido como exercício de aprendizado pessoal para:
- **Estudar operações CRUD** utilizando PHP
- **Integrar aplicações web com banco de dados** MySQL
- **Praticar requisições AJAX** para melhorar a experiência do usuário
- **Utilizar frameworks CSS** como Bootstrap para interface responsiva
- **Aprender padrões de arquitetura** básicos em desenvolvimento web

> **Nota:** Este é um projeto educacional e de portfólio. Não é destinado para uso em produção ou contribuição comunitária.

---

## 🎯 Funcionalidades

✅ **Visualizar Contatos** - Lista completa de todos os contatos cadastrados  
✅ **Adicionar Contato** - Cadastrar novo contato com nome e telefone  
✅ **Editar Contato** - Modificar dados de um contato existente  
✅ **Deletar Contato** - Remover um contato da agenda  
✅ **Interface Responsiva** - Utiliza Bootstrap para compatibilidade com diversos dispositivos  
✅ **Requisições Assíncronas** - AJAX para operações sem recarregar a página

---

## 🛠️ Tecnologias Utilizadas

| Tecnologia | Versão | Propósito |
|-----------|--------|----------|
| **PHP** | 7.2+ | Backend e processamento de dados |
| **MySQL** | 5.7+ | Banco de dados |
| **jQuery** | 3.2.1 | Manipulação DOM e requisições AJAX |
| **Bootstrap** | 3.3.7 | Framework CSS para UI responsiva |
| **JavaScript** | Vanilla | Lógica do frontend |
| **HTML5** | 5 | Estrutura da página |
| **CSS3** | 3 | Estilização adicional |

---

## 📂 Estrutura do Projeto

```
AgendaProjeto/
├── Connection.php          # Configuração de conexão com banco de dados
├── Index.php               # Página principal e interface da agenda
├── Post.php                # Handler para criação de contatos (CREATE)
├── Put.php                 # Handler para edição de contatos (UPDATE)
├── Delete.php              # Handler para exclusão de contatos (DELETE)
├── Jquerry.js              # Biblioteca jQuery (não utilizada diretamente)
├── bootstrap.css           # Estilos Bootstrap
├── bootstrap.js            # Scripts Bootstrap
├── dados.sql               # Script SQL para criação do banco e dados iniciais
└── README.md               # Este arquivo
```

---

## 🚀 Como Instalar e Configurar

### Pré-requisitos
- PHP 7.2 ou superior
- MySQL 5.7 ou superior
- Servidor web (Apache, Nginx, etc.)
- Git (opcional)

### Passo 1: Clone o Repositório
```bash
git clone https://github.com/gabrielmontb/AgendaProjeto.git
cd AgendaProjeto
```

### Passo 2: Configure o Banco de Dados

1. Abra o phpMyAdmin ou sua ferramenta de gerenciamento MySQL
2. Crie um banco de dados chamado `agenda`
3. Importe o arquivo `dados.sql`:
   ```bash
   mysql -u root -p agenda < dados.sql
   ```

### Passo 3: Configure a Conexão

Edite o arquivo `Connection.php` com suas credenciais:

```php
$mysqli = new mysqli('localhost:3306', 'seu_usuario', 'sua_senha', 'agenda');
```

**Parâmetros:**
- `localhost:3306` - Host e porta do MySQL (padrão)
- `seu_usuario` - Usuário do MySQL (padrão: `root`)
- `sua_senha` - Senha do MySQL (deixe em branco se não houver)
- `agenda` - Nome do banco de dados

### Passo 4: Coloque os Arquivos no Servidor Web

Copie todos os arquivos para o diretório raiz do seu servidor web:
- Apache: `/var/www/html/` ou `C:\xampp\htdocs\` (Windows)
- Nginx: configurar conforme seu setup

### Passo 5: Acesse a Aplicação

Abra seu navegador e acesse:
```
http://localhost/AgendaProjeto/Index.php
```

---

## 📖 Documentação dos Arquivos

### `Connection.php`
**Responsabilidade:** Estabelecer conexão com o banco de dados MySQL

```php
$mysqli = new mysqli('localhost:3306', 'root', '', 'agenda');
```

**Variáveis disponíveis:**
- `$mysqli` - Objeto de conexão MySQLi

**Tratamento de erros:**
- Verifica se houve erro na conexão
- Exibe mensagem de erro em caso de falha

---

### `Index.php`
**Responsabilidade:** Interface principal da aplicação

**Fluxo:**
1. Carrega conexão com banco de dados
2. Executa query SELECT para recuperar todos os contatos
3. Renderiza tabela HTML com os contatos
4. Fornece modais para adicionar e editar contatos
5. Inclui scripts JavaScript para operações assíncronas

**Elementos principais:**
- **Header:** Título "Agenda Virtual"
- **Formulário de Adição:** Collapse com campos nome e telefone
- **Tabela de Contatos:** Lista todos os contatos com ações (Editar/Excluir)
- **Modal de Edição:** Formulário para atualizar dados do contato
- **Scripts AJAX:** Comunicação assíncrona com backend

**Estilos CSS:**
- `#p1` - Verde (botão Editar)
- `#p2` - Vermelho (botão Excluir)
- `#p3` - Branco alabastro (fundo corpo)
- `#p4` - Branco Alice (tabela)

---

### `Post.php`
**Responsabilidade:** Processar criação de novos contatos (CREATE)

**Método HTTP:** POST

**Parâmetros esperados:**
- `$_POST['nome']` - Nome do contato
- `$_POST['telefone']` - Telefone do contato

**Retorno:**
```
"Cadastrado com sucesso!" - Se operação bem-sucedida
"Houve um erro ao cadastrar!" - Se erro na operação
```

**Operações:**
1. Inclui arquivo de conexão
2. Prepara e executa INSERT na tabela `dados`
3. Retorna mensagem de confirmação

---

### `Put.php`
**Responsabilidade:** Processar atualização de contatos (UPDATE)

**Método HTTP:** POST

**Parâmetros esperados:**
- `$_POST['nome_d']` - Novo nome
- `$_POST['telefone_d']` - Novo telefone
- `$_POST['delete_id']` - ID do contato a atualizar

**Retorno:**
```json
{"statusCode":200}  // Sucesso
{"statusCode":201}  // Erro
```

**Operações:**
1. Inclui arquivo de conexão
2. Executa UPDATE na tabela `dados`
3. Retorna status em formato JSON
4. Fecha conexão

---

### `Delete.php`
**Responsabilidade:** Processar exclusão de contatos (DELETE)

**Método HTTP:** POST

**Parâmetros esperados:**
- `$_POST['delete_id']` - ID do contato a deletar

**Operações:**
1. Inclui arquivo de conexão
2. Executa DELETE na tabela `dados`
3. Registra log de erros (se houver)

---

### `dados.sql`
**Responsabilidade:** Script SQL para criação do banco e população com dados iniciais

**Estrutura da tabela `dados`:**
```sql
CREATE TABLE `dados` (
  `ID` int(11) PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(30),
  `telefone` varchar(11)
);
```

**Dados iniciais:** 8 contatos de exemplo para teste

---

## 🔄 Fluxo de Operações

### 1. Leitura (Read)
```
Index.php → SELECT * FROM dados → Renderização HTML
```

### 2. Criação (Create)
```
Usuário clica "Salvar" 
  → AJAX POST para Post.php 
  → Insert no banco 
  → Reload da página
```

### 3. Atualização (Update)
```
Usuário clica "Editar" 
  → Modal com dados atuais 
  → Clica "Confirmar edição" 
  → AJAX POST para Put.php 
  → Update no banco 
  → Reload da página
```

### 4. Exclusão (Delete)
```
Usuário clica "Excluir" 
  → Confirmação via alert 
  → AJAX POST para Delete.php 
  → Delete no banco 
  → Remove linha da tabela 
  → Reload da página
```

---

## 🗄️ Esquema do Banco de Dados

### Tabela: `dados`

| Campo | Tipo | Restrições | Descrição |
|-------|------|-----------|-----------|
| `ID` | INT(11) | PRIMARY KEY, AUTO_INCREMENT | Identificador único |
| `nome` | VARCHAR(30) | NULL permitido | Nome do contato |
| `telefone` | VARCHAR(11) | NULL permitido | Telefone do contato |

**Índices:**
- PRIMARY KEY em `ID`

**Ordenação padrão:**
- SELECT ORDER BY nome ASC (alfabética)

---

## ⚙️ Configuração Detalhada

### Variáveis de Ambiente (Connection.php)

```php
// Servidor
Host: localhost
Port: 3306

// Credenciais
User: root
Password: '' (vazio)

// Banco de dados
Database: agenda
```

### Charset
- Banco: utf8mb4
- Collation: utf8mb4_general_ci

---

## 🎨 Interface e Experiência do Usuário

### Layout Principal
- **Hero Image:** Cabeçalho com título "Agenda Virtual"
- **Botão de Adição:** Collapsa para mostrar formulário
- **Tabela Responsiva:** Com ações em cada linha
- **Modal de Edição:** Para modificar contatos

### Cores Utilizadas
- Verde `hsl(120, 90%, 50%)` - Ações positivas (Editar)
- Vermelho `hsl(0, 90%, 50%)` - Ações destrutivas (Excluir)
- Branco `rgb(248, 248, 255)` - Fundo principal
- Azul claro `rgb(230, 250, 255)` - Tabela

### Responsividade
- Viewport meta tag configurado
- Bootstrap Grid System
- Compatível com mobile, tablet e desktop

---

## 🐛 Problemas Conhecidos e Melhorias Futuras

### ⚠️ Problemas Conhecidos
1. **SQL Injection** - Código vulnerável a SQL injection (usar prepared statements corretamente)
2. **Validação** - Sem validação de entrada no frontend ou backend
3. **XSS** - Sem sanitização de dados (usar htmlspecialchars)
4. **Segurança** - Senha do banco em arquivo público
5. **Reload desnecessário** - Múltiplos `location.reload()` após operações

### 📈 Possíveis Melhorias
- [ ] Implementar validação de entrada (nome, telefone)
- [ ] Usar Prepared Statements para evitar SQL Injection
- [ ] Adicionar autenticação e autorização
- [ ] Melhorar tratamento de erros
- [ ] Adicionar paginação para muitos contatos
- [ ] Implementar busca e filtros
- [ ] Adicionar confirmação de sucesso com SweetAlert
- [ ] Refatorar para usar API REST
- [ ] Separar lógica em classes/OOP
- [ ] Adicionar testes unitários

---

## 📚 Conceitos de Aprendizado

Este projeto demonstra os seguintes conceitos:

### PHP & Backend
- ✅ Incluir arquivos com `include()`
- ✅ Variáveis superglobais (`$_POST`)
- ✅ Consultas ao banco de dados (SELECT, INSERT, UPDATE, DELETE)
- ✅ Tratamento de erros com `die()` e `or die()`

### Frontend & JavaScript
- ✅ jQuery para manipulação DOM
- ✅ AJAX para requisições assíncronas
- ✅ Event handling com `.on()` e `.click()`
- ✅ Manipulação de modais
- ✅ Confirmação de ações com `confirm()`

### Banco de Dados
- ✅ Criação de tabelas SQL
- ✅ Inserção de dados com INSERT
- ✅ Consultas com WHERE e ORDER BY
- ✅ AUTO_INCREMENT para IDs

### Web Design
- ✅ HTML5 semântico
- ✅ CSS3 com cores HSL/RGB
- ✅ Framework Bootstrap
- ✅ Responsividade
- ✅ Acessibilidade básica

---

## 📸 Screenshots

### Tela Principal
- Lista de contatos com tabela
- Botão "Adicionar contato" em destaque
- Ações para editar/excluir cada contato

### Formulário de Adição
- Collapse com campos de entrada
- Validação visual via Bootstrap
- Feedback ao usuário

### Modal de Edição
- Janela modal com formulário
- Pré-preenchimento de dados
- Botões de ação

---

## 🔒 Notas de Segurança

⚠️ **AVISO:** Este é um projeto educacional. **NÃO USE EM PRODUÇÃO** sem:

1. **Implementar Prepared Statements:**
   ```php
   $stmt = $mysqli->prepare("INSERT INTO dados (nome, telefone) VALUES (?, ?)");
   $stmt->bind_param("ss", $nome, $telefone);
   ```

2. **Validar e Sanitizar Entrada:**
   ```php
   $nome = htmlspecialchars($_POST['nome']);
   ```

3. **Usar HTTPS:**
   - Implementar SSL/TLS

4. **Autenticação:**
   - Adicionar login/senha
   - Controlar acesso ao banco

5. **Proteção do Arquivo Connection.php:**
   - Não expor credenciais em repositório público
   - Usar variáveis de ambiente

---

## 📝 Licença

Este é um projeto pessoal de estudo. Sinta-se livre para usar como referência ou base para seus próprios projetos de aprendizado.

---

## 👤 Autor

**Gabriel Montebeller Pereira**  
GitHub: [@gabrielmontb](https://github.com/gabrielmontb)

---

## 📞 Contato e Suporte

Como este é um projeto educacional pessoal, não há suporte oficial. Sinta-se livre para:
- Clonar e modificar para aprendizado
- Usar como referência em seus estudos
- Fazer melhorias e refinamentos

---

## 📅 Histórico do Projeto

- **Criado:** 10 de Abril de 2021
- **Linguagem:** PHP
- **Tipo:** Projeto Educacional
- **Status:** Ativo (Documentação atualizada em 2024)

---

**Última atualização:** 2024  
**Versão:** 1.0 Documentado
