# Arquivos utilizados para realizar a primeira atividade prática da disciplina de **PWEB (Programação WEB)**

## Linguagem utilizada
[![PHP](https://img.shields.io/badge/php-%23777BB4.svg?&logo=php&logoColor=white)](https://www.php.net/)

## Banco de Dados utilizada
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?logo=mysql&logoColor=fff)](https://www.mysql.com/)

## Autores
|André Casimiro|Francisca Geovanna|
|--|--|
|[![GitHub](https://img.shields.io/badge/GitHub-%23121011.svg?logo=github&logoColor=white)](https://github.com/Andre-nemesis)|[![GitHub](https://img.shields.io/badge/GitHub-%23121011.svg?logo=github&logoColor=white)](https://github.com/FranciscaGeovanna)|

#

# 💻 Documentação explicita da utilização e construção do sistema 📚

## 📃Sumário 
- [Arquitetura](#arquitetura)
- [Database](#db) 
- [Model](#model)
- [Repository](#repository)
- [Controller](#controller)
- [Views](#views)

# 

<h3 id="arquitetura">🏗 Arquitetura</h3>

# 

Para a arquitetura foi utilizado o modelo *MVC* (Model, View e Controller) atrelado com o design pattern *repository*, assim para a facilitação da contrução e manuntenção do projeto, para maior compreensão, foi criado duas pastas dentro da pasta Views que se destinam a conter o arquivo *css* utilizado no projeto e as *imagens* utilizadas na visão.

# 

<h3 id="db">📊 Database</h3>

# 

A pasta **db** é destinada a realizar o controler da comunicação com o banco de dados, sendo um handler que apenas irá retornar a conexão realizadas com as credências, dentro da mesma está a estrutura utilizda para a criação do banco de dados assim como todas as *functions* e *procedures* utilizadas para a manipulação e visualização dos dados.

# 

<h3 id="model">⚙ Model</h3>

# 

Esta parte da arquitetura remonta para a criação de classes que irão ser utilizadas como modelos para a representação dos dados que serão inseridos no banco de dados, logo todas as classes como:
- Autor
- Livro
- Estudante
- Relatório

Serão utilizadas para inserção dos dados dentro do banco para facilitar o controle e gestão dos mesmo.

# 

<h3 id="repository">💼 Reposiotry</h3>

# 

Os repositórios irão realizar todos as iterações com o banco, seja as categorizadas como *CRUD* (Create, Read, Update, Delete), seja como además funções, logo diferentemente da parte [Controller](#controller) que será abordado logo a baixo, nenhum tipo de iteração com o SGBD deve ser acionado por algum outro arquivo do projeto.

# 

<h3 id="controller">🎮 Controller</h3>

# 

Nesta parte da arquitetura, todas as ações serão controladas pelas classes presente para cada ação do sistema, assim gerênciando as ações especificas para que não haja uma perca de otimização, ao instânciar todas as ações e realizar a verificação de qual funcionalidade será exercida em parte especifíca da aplicação.

# 

<h3 id="views">➿ Views</h3>

#

Para está útilma sessão, existe a divisão em três partes para uma maior compreensão e organização dos arquivos, entre:

- Arquivos de visualização em *PHP* 
- Imagens utilizadas na visualização
- *css* utilizado na visualização

A primeira parte destina-se em mostrar todas as telas e seus controladores de ações e de requisições, logo tudo o que será mostrado para o usuário de encontra nos arquivos. 

Nas imagens pode-se notar que de prefência, faz-se o uso de icones no formato *svg* que possui uma compatibilidade com os arquivos html, sendo possivel uma estilização mais sucinta e moderna, caso a parte da imagem da tela incial que é do formato *png* que não é o recomendado para utilização, contudo houve o *match* com o design feito antes de inciar a construção do *frontend*.

Para o *css* foi utilizado um arquivo único, tendendo a usar o máximo de repetições de estilo para tornar algo agradável ao usuário, com pequenos ajustes com *CSSs* inline e dentro dos arquivos *PHP*.
