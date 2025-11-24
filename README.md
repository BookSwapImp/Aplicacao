BookSwap: Sistema Web Colaborativo para Troca de Livros

Orientadores: ANA CARLA ARRUDA DE HOLANDA

O BookSwap é um sistema web colaborativo desenvolvido com o objetivo de promover a troca de livros usados, incentivando o acesso à leitura de forma sustentável e econômica 1
. A plataforma atua como um ponto de encontro virtual para usuários que desejam trocar seus livros, consolidando-se como uma solução relevante e tecnicamente consistente 1
.

📚 Funcionalidades Principais

O sistema BookSwap oferece um conjunto robusto de funcionalidades para gerenciar a troca de livros de ponta a ponta, desde o cadastro do usuário até a administração da plataforma 2
.

Categoria
Funcionalidades
Usuário
Cadastro, Login, Edição de Perfil, Gerenciamento de Livros (Meus Livros), Busca de Livros, Início de Trocas.
Trocas
Sistema de Troca (Página Troca), Visualização de Livras Disponíveis (Página Home).
Administração
Painel do Mantenedor (para gerenciar denúncias e usuários), Relatórios.


💻 Tecnologias Utilizadas

O projeto foi desenvolvido utilizando uma arquitetura baseada em PHP, seguindo um padrão de organização que se assemelha ao MVC (Model-View-Controller) 2
.

Componente
Tecnologia
Detalhes
Linguagem
PHP
Versão 8.2 (configurada via Dockerfile) 2
.
Banco de Dados
MySQL
Modelo lógico do banco de dados relacional documentado (FIGURA 4) 1
.
Front-end
Bootstrap
Utilizado para a criação de interfaces responsivas e de fácil navegação 1
.
Dependências
Composer
Gerenciamento de dependências, incluindo phpmailer/phpmailer para envio de e-mails 2
.
Ambiente
Docker / Docker Compose
Facilita a configuração do ambiente de desenvolvimento e produção 2
.


⚙️ Configuração do Ambiente de Desenvolvimento

Para rodar o projeto localmente, é necessário ter o Docker e o Docker Compose instalados.

1.
Clone o repositório:

2.
Inicie o ambiente com Docker Compose: O arquivo docker-compose.yml configura um container com PHP 8.2 e Apache, mapeando a porta 3000 do seu host para a porta 80 do container.

3.
Acesse a aplicação: A aplicação estará disponível em http://localhost:3000.

4.
Configuração do Banco de Dados: O banco de dados deve ser configurado separadamente. Utilize os scripts SQL fornecidos (banco.sql ou script_banco_bookswap.sql ) para criar o esquema e popular as tabelas. As configurações de conexão devem ser ajustadas no diretório app/connection/.

🚧 Status Atual e Próximos Passos

O projeto está em fase de manutenção e aprimoramento. O foco atual é a correção de problemas de integridade referencial no banco de dados, conforme indicado no TODO.md 2
.

Funcionalidades Futuras Planejadas 1
:

•
Implementação de um sistema de chat integrado para comunicação direta e segura entre os usuários.

•
Desenvolvimento de um sistema de busca por endereço para facilitar a logística de troca.

•
Integração de notificações via e-mail para eventos importantes.

📝 Modelagem e Documentação

A documentação do projeto inclui artefatos de análise e modelagem essenciais para o entendimento da arquitetura do sistema 1
:

•
Diagrama de Casos de Uso.

•
Diagrama de Classes Conceitual.

•
Diagrama Entidade-Relacionamento (DER).




Instruções de Download:

Nescesario: Xampp, compilador do PHP.

-- A partir do arquivo script_banco_bookswap.sql construa o banco de dados.

-- Instale no diretorio htdocs do Xampp.



 DocumentaçãoBookSwap. Google Docs. Disponível em: [https://docs.google.com/document/d/1HyF2R8-vSOwIdwHNufM3B2fR3zgg5khgoNkp7g7xHM/edit?tab=t.0](https://docs.google.com/document/d/1HyF2R8-vSOwIdwHNufM3B2fR3zgg5khgoNkp7g7xHM/edit?tab=t.0 ). Acesso em: Nov. 2025.
