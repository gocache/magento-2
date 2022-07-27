# GoCache CDN para Magento 2

> Módulo para limpar o cache de um produto na CDN após edita-lo no Magento

## Sobre

Esse módulo identifica as tags de um produto cadastrado e
limpa seu cache na CDN da GoCache sempre que alguma informação
dele for alterada no Magento.

Ele utiliza o recurso de Cache-Tags da GoCache para limpar apenas
o cache referente ao produto, mantendo as páginas e arquivos estáticos
previamente cacheadas, aumentando assim a velocidade e eficiência do cache.

## Requisitos obrigatórios

- Conta criada na GoCache com um token gerado
- Produtos cadastrados no Magento precisam pertencer à alguma outra categoria sem ser a categoria padrão
- Desligar o Smart Cache no painel de GoCache
- PHP 7.3 ou acima
- Magento 2.3

## Instalação

**ATENÇÃO**: É necessário remover a versão anterior desse
módulo antes de instalar uma nova versão.

Execute os comandos abaixo na pasta onde o Magento foi instalado:

```sh
MAGENTO_DOCUMENT_ROOT=/var/www/magento2
COMPOSER_MEMORY_LIMIT=-1

composer require gocache/cdn:2.3.7.4

cd $MAGENTO_DOCUMENT_ROOT
php bin/magento module:enable GoCache_CDN
php bin/magento cache:flush
php bin/magento setup:upgrade
php bin/magento setup:di:compile
```

## Configuração

A configuração ocorre em duas partes, uma no painel da GoCache para visualizar o
token da API e configurar Smart Rules para o domínio, e outra no Magento, para
configurar o módulo como sistema de cache principal do Magento.

### Painel da GoCache

1. Efetue login em https://painel.gocache.com.br
2. Clique no botão "MINHA CONTA" e depois na aba "Conta" para visualizar seu token de API
3. Clique no menu "DOMÍNIOS" e depois no botão "Smart Rules" no domínio que utiliza Magento
4. Adicione uma regra com o critério **URL**, valor `/(admin*|*checkout*|*cart*)` e selecione o **Tipo de cache** para `Não fazer cache`
5. Adicione uma regra com o critério **Método HTTP**, selecione `GET`, `HEAD`, `OPTIONS` e o **Tipo de cache** para `Full cache`

### Magento

1. Efetue login no Admin
2. Clique no menu lateral e siga para *Stores* => *Configuration* => *Advanced* => *System*
3. Expanda a seção **Full Page Cache** e selecione o tipo de cache para `GoCache CDN`
4. Ainda na seção **Full Page Cache**, preencha o formulário com o token gerado no painel de GoCache e o domínio do site

## Ajuda e suporte

Entre em contato com o suporte da GoCache através do canal de suporte para obter ajuda,
tirar dúvidas ou fornecer feedbacks sobre o módulo para Magento.

## Licença

MIT
