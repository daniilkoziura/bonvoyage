# pull official base image
FROM node:13.12.0-alpine

# set working directory
WORKDIR /app/frontend

# add `/app/node_modules/.bin` to $PATH
ENV PATH /app/node_modules/.bin:$PATH

# install app dependencies
COPY ./package.json ./
COPY ./package-lock.json ./

EXPOSE 3000

RUN npm install --silent

# add app
COPY ./ ./

RUN npm run build

#CMD ["npm", "start"]
CMD ["npm", "run", "start:prod"]