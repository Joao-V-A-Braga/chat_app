#!/bin/sh

# Instala o NVM
curl -o- https://raw.githubusercontent.com/creationix/nvm/v0.35.3/install.sh | bash

# Configura o NVM
export NVM_DIR="$HOME/.nvm"
[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"

# Instala a versão 18 do Node
nvm install 18

# Configura a versão 18 como padrão
nvm use 18

# Executa o Docker Compose
docker-compose up -d

# Roda npm install
npm install
