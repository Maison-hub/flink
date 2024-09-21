FROM node:lts-alpine

WORKDIR /app

RUN apk update && apk upgrade
RUN apk add git
RUN apk add --no-cache bash

COPY ./package*.json ./

RUN npm install && npm cache clean --force

COPY . .

EXPOSE 3000

ENV PATH ./node_modules/.bin/:$PATH