# Laravel - Autentication & Autorization with Sanctum (ACL)

Para todas as rotas da API é necessário enviar o seguinte parâmetro no HEADER da requisição: 
- parametro: 
<b>Accept</b>
- valor: <b>application/json</b>.

Para as rotas que necessitam de Autenticação é necessário acrescentar o seguinte parâmetro no HEADER da requisição:
- Parâmetro: <b>Authorization</b>
- Valor: <b>Bearer {token}</b>

## Rotas da API

> #### POST - /register
> Rota responsável por realizar o cadastro do usuáiro, é necessário enviar o json abaixo para os efetivo cadastro:
>```json
>{
>	"name":         "", // Nome do Usuário
>	"password":     "", // Senha da conta
>	"email":        "", // E-mail da conta
>	"device_name":  ""  // Dipositivo de acesso
>}
>```
>
> #### POST - /auth
> Essa rota é responsável por realizar a autenticação do usuário. 
> No corpo da requisição é necessário enviar o seguinte JSON com os dados para a autenticação
>```json
>{
>   "password" :        "", // Senha da conta
>   "email" :           "", // E-mail da conta
>   "device_name" :     ""  // Dispositivo de acesso
>}
>```
>
> #### POST - /logout
> Rota responsável por realizar o Logout do usuário autenticado
>
> #### GET - /me
> Rota responsável por retornar um JSON com os dados do usuário autenticado.
>
> #### GET - /users
> Rota responsável por retornar um JSON com os dados de todos os usuário cadastrados no sistema.
> É necessário que o usuário autenticado tenha a permissão "users" salva relacionada no banco de dados.
> 
> #### GET - /user/{identify}
> Rota resoponsável por retornar os dados de um usuário específico.
> É necessário enviar na URL da requisição o UUID do usuário que deseja receber os dados.
>
> #### POST - /users
> Rota responsável por realizar o efetivo cadastro do usuário dentro da aplicação.
> E necessário enviar no corpo da requisição um JSON da seguinte forma:
> ```json
>{
>   "name":     "", // Nome do usuário
>   "email":    "", // E-mail da conta
>   "password": ""  // Senha da conta
>}
> ```
>
> #### PUT - /users/{identify}
> Rota responsável por realizar a atualização dos dados de um usuário.
> É necessário enviar na URL da requisição o UUID do usuário que deseja atualizar os dados.
> É necessário enviar os dados que deseja atualizar em um JSON no corpo da requisição da seguinte forma:
> ```json
> {
> "name": "" // Nome ou outro valor que deseja alterar para o usuário   
> }   
> ```
>
> #### DELETE - /users/{identify}
> Rota responsável por realizar a exclusão de um usuário atráves do UUID informado na URL da requisição. 
> Para excluir um usuário, o usuário logado deve ter a permissão "delete_user"
>
> #### GET - /users/can/{permission}
> Rota responsável por verificar se um usuário possui alguma permissão, a permissão a ser verificada, deve ser enviada na URL da requisição no lugar de "{permission}".
> 
> #### POST - /users/permissions
> Rota responsável por adicionar uma ou mais permissões para o usuário.
> Deve ser enviado no corpo da requisição um JSON da seguinte forma:
> ```json
> {
>   "user":         "", // UUID do usuário p/ dar permissões
>	"permissions": ["1", "2", "3"] // Array com id das permissões
> }
> ```
>
> #### DELETE - /user/permissions
> Rota responsável por remover permissão de um usuário.
> Deve ser enviado no corpo da requisição o UUID do usuário, juntamente com a permissão que deseja remover.
> ```json
> {
>   "user": "", // UUID do usuário
>   "permission": "", // Permissão para remover   
> }
> ```
>
