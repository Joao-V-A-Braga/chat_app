# Chat APP

## Descrição
Esse é um projeto criado para praticar o framework Laravel e o desenvolvimento web no geral.

O objetivo e criar uma aplicação web em que os usuário possam utiliza-la para se comunicarem por meio de mensagens, imagens, videos e arquivos. Quem sabe futuramente possa ser implementado também uma comunicação por audio e video-chamadas.

## Diagrama da arquitetura do banco 
https://drive.google.com/file/d/1L0GZpImNCCXT9WQ7_4dMJOY-NQ5yDoRK/view?usp=sharing

## Startando o projeto no ambiente de desenvolvimento

### Enviroment
É necessário fazer a configuração no seu arquivo .env como em qualquer outra aplicação Laravel. Lembrando que o docker-compose desse projeto já cria um banco chamado "chat_db" para você, fique a vontade para trocar se assim desejar. 

### Build
O projeto possui uma configuração para Docker, então é possível startar com:

`docker-compose up -d && npm install`

Ou você pode utilizar o buildDev.sh que inclusive instala o node na versão correta para você, com:

`sh buildDev.sh`

Depois disso, já terá os containers do docker rodando e as dependências instaladas e só precisará rodar o `npm run dev`

### Se já tiver buildado a aplicação anteriormente e quiser startar novamente, terá que rodar:
`docker-compose up -d && npm run dev`
### Em outro terminal temos que iniciar o Laravel websockets na porta `8002` com o comando `docker-compose exec app php artisan websockets:serve --host=0.0.0.0 --port=8002` 

### Ah, não se esqueça de rodar suas migrations
`docker-compose exec app php artisan migrate`

## Atenção!!!
### Se você não quiser rodar seu Laravel websockets na porta `8002`
Terá que configurar a exposição da mesma no Dockerfile do app e na configuração do NGINX

### E se quiser utilizar outra porta na config do seu PUSHER_PORT no .env, a não ser a 6001
Terá que mudar essa configuração no NGINX e no container NGINX no docker-compose.yml.


## Depois disso é para o seu app de chat estar funcionando localmente. <3 
### Até mais!!
