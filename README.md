# Laravel - Autentication & Autorization with Sanctum

Para todas as rotas da API é necessário enviar o seguinte parâmetro no HEADER da requisição: 
- parametro: 
<b>Accept</b>
- valor: <b>application/json</b>.

## Rotas da API

> #### POST - /auth
> Essa rota é responsável por realizar a autenticação do usuário. 
> No corpo da requisição é necessário enviar o seguinte JSON com os dados para a autenticação
>```json
>    {
>        "password"     : "",   // Senha da conta
>        "email"        : "",   // E-mail da conta
>        "device_name"  : ""    // Dispos
>    }
>```
  
