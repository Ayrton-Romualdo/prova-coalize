# Teste de desenvolvimento em Yii2 Framework

Teste realizado utilizando o [template básico](https://github.com/yiisoft/yii2-app-basic)  do Yii2 framework com Docker.

### Regras de negócio e funcionamento

1. Autenticação por credencial (usuário/senha) e retorno de token (Beare)
2. Para criar um usuário, faça um comando de terminal, que recebe o login, senha e nome
desejados.
3. Todas APIs (exceto a de autenticação) devem ter a validação do token fornecido ao efetuar
a autenticação, preferencialmente passar pelo Header (Authorization)
4. Desenvolver APIs para os seguinte
    a. Autenticação
    b. Cadastro de cliente básico
        i. Nome
        ii. CPF (com validação)
        iii. Dados de endereço (CEP, Logradouro, Número, Cidade, Estado, Complemento)
        iv. Foto
        v. Sexo
    c. Lista dos clientes
        i. Usar paginação para o retorno
    d. Cadastro de produto
        i. Nome
        ii. Preço
        iii. Cliente (detentor do produto)
        iv. Foto
    e. Lista dos produtos
        i. Retornar paginado
        ii. Permitir filtrar pelo cliente

Todos os testes realizados para as consultas das rotas por API foram feitas utilizando o site/aplicativo [POSTMAN](https://www.postman.com). As rotas foram exportadas para o arquivo yii.postman_collection.json que se encontra na raiz do projeto.

