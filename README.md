DevOps
 - Versão do =>  PHP 7.3
 - Framework => Laravel Framework 6.8.0
 - Banco => Mysql

Comandos
 1) Terminal - clonar o projeto comando (git clone https://github.com/Zaira30/sistema_veiculos.git);
 2) Importar o Dump do db. Encontra-se dentro do diretorio Dump, o arquivo (Dump20200114.sql);
 3) Terminal - comando (composer install);
 4) Terminal - comando (php artisan config:cache);
 5) Terminal - comando (php artisan serve);
 6) login: admin@admin.com, senha 12345678
 




Api para pegar todos os Montadores
GET {url}/api/v1/montadores

Retorno : 
        {
              "status": true,
              "message": "Montadores retornado com sucesso.",
              "montadores": [
                  {
                      "id": 1,
                      "nome": "João da Silva",
                      "status": "inativo"
                  },
                  {
                      "id": 2,
                      "nome": "Maria da Silva",
                      "status": "Ativo"
                  },
                  {
                      "id": 3,
                      "nome": "Adriana Ramos",
                      "status": "Ativo"
                  }
              ]
          }
          
Api para pegar todos  os Veículos
GET {url}/api/v1/veiculos
Retorno:
        {
            "status": true,
            "message": "Veiculos retornado com sucesso.",
            "veiculos": [
                {
                    "id": 1,
                    "nome": "Gol",
                    "montador(a)": "Maria da Silva",
                    "ano_fabricacao": 2000,
                    "ano_modelo": 2000,
                    "chassi": "101010",
                    "status": "Ativo"
                },
                {
                    "id": 2,
                    "nome": "Palio",
                    "montador(a)": "Adriana Ramos",
                    "ano_fabricacao": 2010,
                    "ano_modelo": 2010,
                    "chassi": "9019003",
                    "status": "Ativo"
                }
            ]
        }