# Laravel - Autentication & Autorization with Sanctum

Para todas as rotas da API é necessário enviar o seguinte parâmetro no HEADER da requisição: 
- parametro: 
<b>Accept</b>
- valor: <b>application/json</b>.

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
