# Use a imagem oficial do Node.js como base
FROM node:16.18

# Defina o diretório de trabalho no contêiner
WORKDIR /usr/src/app

# Copie o package.json e o package-lock.json (se existirem)
COPY package*.json ./

# Instale as dependências do Angular
RUN npm install

# Copie o restante do código-fonte
COPY . .

# Exponha a porta 4200, que é a porta padrão para aplicativos Angular
EXPOSE 3000

# Comando para iniciar o servidor de desenvolvimento do Angular
CMD ["npm", "start"]
