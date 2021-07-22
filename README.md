# **Laboratórios de Química**

> É um sistema controle de estoque de dois laboratórios de química, sendo o professor o administrador e quem faz o controle dos equipamentos, reagentes, vidrarias, vidrarias quebradas e a criação de relatórios, e o aluno como usuário normal que faz a leitura dos dados.

Sistema Web que controla o estoque de dois laboratórios de química em uma instiutuição, sendo que, cada laboratório armazena os equipamentos, reagentes e as vidrarias. O professor, sendo o administrador do sistema, pode criar, editar, visualizar e excluir os dados dos seguintes itens: equipamentos, reagentes, vidrarias, vidrarias quebradas e os relatórios. E para registrar ocorrências de aulas, o professor pode criar os relatórios, podendo informar: os equipamentos, as vidrarias, os reagentes e sua quantia utilizadas que por fim, realiza a baixa na quantia de reagente, e se caso houver vidraria quebrada, o mesmo pode registrar qual a vidraria, a quantidade e em qual aula foi quebrada, que por sua vez também realiza a baixa no estoque das vidrarias e isso tudo fica registrado para consulta do professor e do aluno para todas essas entidades citadas (equipamento, reagente, vidraria, vidraria quebrada e relatorio).

#### PROFESSOR
- Login feito com seu RA de professor de 5 digitos, juntamente à sua senha.
- Usuário **administrador**, acesso total de todos os dados do sistema;
- Pode fazer a Criação, Visualização, Edição, e Exclusão de registros no sistema (equipamentos, reagentes, vidrarias, vidrarias quebradas, relatórios).

#### ALUNO
- Login feito com seu RM de aluno de 5 digitos, juntamente à sua senha.
- Pode fazer **apenas** a leitura de dados.

## Exemplo de uso

O Sistema pode se adequar para:
- Instituição com vários laboratórios de química;
- Locais com grande quantiade desses itens que difculta o controle;
- Laboratórios com um ambiente de difícil organização;
- Laboratórios com um estoque pequeno para quantidades acima que o suportado.

O seu uso é focado no controle de estoque em ambientes que enfretam problemas gerais de organização e controle, o sistema tem a inteção de amenizar perdas, desorganização juntamente ao 5'S e controle de aulas

## Configuração para usar no seu ambiente

Após a instalação, configure e tenha os seguintes itens:
1. Servidor apache com PHP 7.4.1 para melhor aproveitamento;
2. Execute em seu SGBD, o arquivo `laboratorios_quimica.sql` para a criação do banco de dados e seus respectivos `INSERTS` dos dados.
3. Configure as variáveis da conexão com o banco de dados com o do seu servidor (XAMPP, MAMP, WAMP, etc).

## Histórico de versões

* **JULHO DE 2021**
    * Melhorias, otimização, refatoração, correção de bug, correção de falhas de segurança e transição do Sistemas para a Programação Orientada a Objeto. (Feito por Mário Guilherme de Andrade Rodrigues)
        * PHP Orientado a Objetos (7.4.1)
        * Classe PDO

* **DEZEMBRO DE 2020**
    * Finalização do projeto para apresentação do TCC, feita por toda a equipe de Desenvolvimento de Sistemas. Utilizando as seguintes tecnologias
        * MVC
        * PHP Procedural (7.4.1)
        * MySQL
        * HTML
        * CSS
        * Bootstrap
        * JavaScript
        * jQuery
        * Sweet Alert 2
        * Font Awesome

## Créditos e Desenvolvedores

Mário Guilherme de Andrade Rodrigues – **Desenvolveu:** Back-End & Front-End – [Site](https://marioguilherme.epizy.com) – mariogui167@gmail.com

André Luiz Neves – **Desenvolveu:** Front-End – [Facebook](https://www.facebook.com/profile.php?id=100005763971999)

Thiago Kalil Martineli Samara – **Desenvolveu:** Front-End – [Facebook](https://www.facebook.com/thiagokalil.martinelisamara)

## Hospedagem

Link do repositório - [https://github.com/MarioGuilherme/Laboratorios-Quimica](https://github.com/MarioGuilherme/Laboratorios-Quimica)

Link do Sistema Hospedado - [https://laboratoriosquimica.rf.gd](https://laboratoriosquimica.rf.gd)

## Agradecimentos
Sistema desenvolvido em um Projeto/TCC Multidisciplinar com o Técnico em Açúcar e Álcool

Agradecemos á todos pela colaboração e sugestões.