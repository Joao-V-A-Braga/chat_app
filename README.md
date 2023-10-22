# Chat APP

## Descrição
Esse é um projeto criado para praticar o franmework Laravel e o desenvolvimento web no geral.

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
