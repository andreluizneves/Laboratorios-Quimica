-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema laboratorio_quimica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema laboratorio_quimica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `laboratorio_quimica` DEFAULT CHARACTER SET utf8 ;
USE `laboratorio_quimica` ;

-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`labs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`labs` (
  `id_lab` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_lab`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`vidrarias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`vidrarias` (
  `id_vidraria` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `quantidade` INT NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `foto` LONGBLOB NOT NULL,
  `id_lab` INT NOT NULL,
  PRIMARY KEY (`id_vidraria`),
  INDEX `fk_vidrarias_laboratorio1_idx` (`id_lab` ASC),
  CONSTRAINT `fk_vidrarias_laboratorio1`
    FOREIGN KEY (`id_lab`)
    REFERENCES `laboratorio_quimica`.`labs` (`id_lab`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`equipamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`equipamentos` (
  `id_equipamento` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `numero_patrimonio` INT NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `foto` LONGBLOB NOT NULL,
  `id_lab` INT NOT NULL,
  PRIMARY KEY (`id_equipamento`),
  INDEX `fk_equipamentos_laboratorio1_idx` (`id_lab` ASC),
  CONSTRAINT `fk_equipamentos_laboratorio1`
    FOREIGN KEY (`id_lab`)
    REFERENCES `laboratorio_quimica`.`labs` (`id_lab`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`professores`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`professores` (
  `id_professor` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `ra` VARCHAR(5) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_professor`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`relatorios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`relatorios` (
  `id_relatorio` INT NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(45) NOT NULL,
  `descricao` VARCHAR(255) NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `tempo` VARCHAR(45) NOT NULL,
  `id_professor` INT NOT NULL,
  `id_lab` INT NOT NULL,
  PRIMARY KEY (`id_relatorio`),
  INDEX `fk_relatorios_professores_idx` (`id_professor` ASC),
  INDEX `fk_relatorios_local1_idx` (`id_lab` ASC),
  CONSTRAINT `fk_relatorios_professores`
    FOREIGN KEY (`id_professor`)
    REFERENCES `laboratorio_quimica`.`professores` (`id_professor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_local1`
    FOREIGN KEY (`id_lab`)
    REFERENCES `laboratorio_quimica`.`labs` (`id_lab`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`reagentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`reagentes` (
  `id_reagente` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `quantidade` INT NOT NULL,
  `foto` LONGBLOB NOT NULL,
  `medida` VARCHAR(3) NOT NULL,
  `id_lab` INT NOT NULL,
  PRIMARY KEY (`id_reagente`),
  INDEX `fk_reagentes_laboratorio1_idx` (`id_lab` ASC),
  CONSTRAINT `fk_reagentes_laboratorio1`
    FOREIGN KEY (`id_lab`)
    REFERENCES `laboratorio_quimica`.`labs` (`id_lab`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`vidrarias_quebradas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`vidrarias_quebradas` (
  `id_vidraria_quebrada` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `quantidade` INT NOT NULL,
  `foto` LONGBLOB NOT NULL,
  `id_relatorio` INT NOT NULL,
  PRIMARY KEY (`id_vidraria_quebrada`),
  INDEX `fk_vidrarias_quebradas_relatorios1_idx` (`id_relatorio` ASC),
  CONSTRAINT `fk_vidrarias_quebradas_relatorios1`
    FOREIGN KEY (`id_relatorio`)
    REFERENCES `laboratorio_quimica`.`relatorios` (`id_relatorio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`relatorios_reagentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`relatorios_reagentes` (
  `id_relatorio_reagente` INT NOT NULL AUTO_INCREMENT,
  `id_relatorio` INT NOT NULL,
  `id_reagente` INT NOT NULL,
  `quantidade` INT NOT NULL,
  INDEX `fk_relatorios_has_reagentes_reagentes1_idx` (`id_reagente` ASC),
  INDEX `fk_relatorios_has_reagentes_relatorios1_idx` (`id_relatorio` ASC),
  PRIMARY KEY (`id_relatorio_reagente`),
  CONSTRAINT `fk_relatorios_has_reagentes_relatorios1`
    FOREIGN KEY (`id_relatorio`)
    REFERENCES `laboratorio_quimica`.`relatorios` (`id_relatorio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_has_reagentes_reagentes1`
    FOREIGN KEY (`id_reagente`)
    REFERENCES `laboratorio_quimica`.`reagentes` (`id_reagente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`relatorios_equipamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`relatorios_equipamentos` (
  `id_relatorio_equipamento` INT NOT NULL AUTO_INCREMENT,
  `id_relatorio` INT NOT NULL,
  `id_equipamento` INT NOT NULL,
  INDEX `fk_relatorios_has_equipamentos_equipamentos1_idx` (`id_equipamento` ASC),
  INDEX `fk_relatorios_has_equipamentos_relatorios1_idx` (`id_relatorio` ASC),
  PRIMARY KEY (`id_relatorio_equipamento`),
  CONSTRAINT `fk_relatorios_has_equipamentos_relatorios1`
    FOREIGN KEY (`id_relatorio`)
    REFERENCES `laboratorio_quimica`.`relatorios` (`id_relatorio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_has_equipamentos_equipamentos1`
    FOREIGN KEY (`id_equipamento`)
    REFERENCES `laboratorio_quimica`.`equipamentos` (`id_equipamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`relatorios_vidrarias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`relatorios_vidrarias` (
  `id_relatorio_vidraria` INT NOT NULL AUTO_INCREMENT,
  `id_relatorio` INT NOT NULL,
  `id_vidraria` INT NOT NULL,
  INDEX `fk_relatorios_has_vidrarias_vidrarias1_idx` (`id_vidraria` ASC),
  INDEX `fk_relatorios_has_vidrarias_relatorios1_idx` (`id_relatorio` ASC),
  PRIMARY KEY (`id_relatorio_vidraria`),
  CONSTRAINT `fk_relatorios_has_vidrarias_relatorios1`
    FOREIGN KEY (`id_relatorio`)
    REFERENCES `laboratorio_quimica`.`relatorios` (`id_relatorio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_has_vidrarias_vidrarias1`
    FOREIGN KEY (`id_vidraria`)
    REFERENCES `laboratorio_quimica`.`vidrarias` (`id_vidraria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorio_quimica`.`alunos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorio_quimica`.`alunos` (
  `id_aluno` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `rm` VARCHAR(5) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id_aluno`))
ENGINE = InnoDB;

-- ----------------------------------------------------------------------------- INSERT FEITO UM À UM ----------------------------------------------------------
--- Inserção de Dados feito pelo Grupo de TCC
-- -------------------------------------------------------------------------------------------------------------------------------------------------------------

-- Criandos os Laboratórios Existentes

INSERT INTO `labs` (`id_lab`, `nome`) VALUES(1, 'Externo');
INSERT INTO `labs` (`id_lab`, `nome`) VALUES(2, 'Interno');
INSERT INTO `labs` (`id_lab`, `nome`) VALUES(3, 'Ambos');


-- Catalogando os Equipamentos

INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(1, 'Balança de Precisão', 1, 'Balança de Precisão é um equipamento de grande importância para medições da massa de um corpo. A escolha de uma balança de precisão para laboratório ou para qualquer outro tipo de utilização deve se levar em conta a necessidade do usuário: em relação a qu', 0x2e2e2f666f746f2f31363038333737393437356664646536356234373830622e6a7067, 1);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(2, 'Bomba de vácuo', 2, 'Bomba de vácuo é um aparelho destinado a retirar o gás de um determinado volume, de forma que a pressão seja baixada a valores adequados ao propósito desejado.', 0x2e2e2f666f746f2f31363038333738303138356664646536613239326134322e6a7067, 2);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(3, 'Sacarímetro de BRIX', 3, 'O Sacarímetro de Brix é um instrumento destinado a medir o teor de açúcar em solução. A escala do Sacarímetro de Brix varia de 0 a 90º Brix com divisões de 0,1 / 0,2 / 0,5 e 1º Brix. A escala de temperatura no caso de Termo-densímetros varia de 0 a 50ºC c', 0x2e2e2f666f746f2f31363038333738303831356664646536653133666330612e6a7067, 1);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(4, 'Banho de ultrassom', 4, 'Indicado para limpeza e desinfecção de utensílios, dissolução de amostras, desgaseificação de líquidos e em testes de sujidades de peças. Também é conhecido como Banho Ultrassom.', 0x2e2e2f666f746f2f31363038333738313330356664646537313266333431332e6a7067, 2);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(5, 'Balança semianalítica ', 5, 'A balança semi-analítica é um instrumento que serve para realizar a medição de massa de corpos e objetos, podendo ser usada para inúmeras áreas.', 0x2e2e2f666f746f2f31363038333738313639356664646537333934326337372e6a7067, 1);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(6, 'Espectrofotômetro', 6, 'O Espectrofotômetro é um instrumento de análise, amplamente utilizado em laboratórios de pesquisa, capaz de medir e comparar a quantidade de luz absorvida, transmitida ou refletida por uma determinada amostra, seja ela solução, sólido transparente ou sóli', 0x2e2e2f666f746f2f31363038333738323331356664646537373733346666622e6a7067, 2);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(7, 'Condutivímetro', 7, 'O condutivímetro é o instrumento responsável por medir a quantidade de corrente elétrica ou condutância em uma solução, sendo que esta condutividade é útil para determinar o estado geral de um recipiente composto por água natural.', 0x2e2e2f666f746f2f31363038333738323638356664646537396335353866392e706e67, 1);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(8, 'pHmetro', 8, 'O pHmetro ou medidor de pH é um aparelho usado para medição de pH. Constituído basicamente por um eletrodo e um circuito potenciômetro. O aparelho é calibrado de acordo com os valores referenciados em cada uma das soluções de calibração. Para que se concl', 0x2e2e2f666f746f2f31363038333738333137356664646537636463356430392e6a7067, 2);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(9, 'Forno', 9, 'O forno de laboratório é criado para facilitar manipulação de substâncias e manuseio de itens e pode ser utilizado em indústrias de diversos setores, como, por exemplo, dos setores químico, farmacêutico e alimentício.', 0x2e2e2f666f746f2f31363038333738333537356664646537663563343764362e706e67, 1);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(10, 'Manta Aquecedora', 10, 'Caracterizada como um instrumento de vital importância para laboratórios, a manta aquecedora é um pequeno equipamento cuja função é elevar a temperatura de substâncias químicas, mas de forma controlada e bastante precisa.', 0x2e2e2f666f746f2f31363038333738333935356664646538316238383637612e6a7067, 2);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(11, 'Refratômetro', 11, 'Refractómetro ou refratômetro, é um instrumento óptico utilizado para medir o índice de refração de uma substância translúcida. Inventado por William Hyde Wollaston, em 1802, teve em Ernst Abbe seu desenvolvedor para um modelo prático.', 0x2e2e2f666f746f2f31363038333738343333356664646538343164373065352e6a7067, 2);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(12, 'Chuveiro de emergência', 12, 'São equipamentos de proteção coletiva imprescindíveis a todos os laboratórios. São destinados a eliminar ou minimizar os danos causados por acidentes nos olhos e/ou face e em qualquer parte do corpo.', 0x2e2e2f666f746f2f31363038333738343732356664646538363836363531302e6a7067, 1);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(13, 'Chapa', 13, 'A chapa aquecedora de laboratório permite aquecer e controlar o aquecimento de substâncias, pode apresentar plataforma em cerâmica, plataforma em alumínio, ferro e outros materiais. Um chapa aquecedora de laboratório deve ser resistente e estar bem apoiad', 0x2e2e2f666f746f2f31363038333738353034356664646538383832376264312e6a7067, 2);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(14, 'Estufa', 14, 'A estufa de secagem é um equipamento que, por seus diversos modelos e funcionalidades, se mostra de extrema importância para qualquer laboratório de ponta. Sua principal função é realizar a secagem de vidrarias e materiais, podendo também ser utilizada pa', 0x2e2e2f666f746f2f31363038333738353438356664646538623461386133382e6a7067, 1);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(15, 'Destilador', 15, 'O destilador de água consiste em um aparelho desenvolvido para obtenção de água pura. A água destilada é muito utilizada em laboratórios de pesquisa, preparo de soluções e diversos outros fins.', 0x2e2e2f666f746f2f31363038333738353939356664646538653762663636302e6a7067, 2);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(16, 'Agitador magnético', 16, 'Um agitador magnético ou misturador magnético é um dispositivo de laboratório que emprega um campo magnético giratório para fazer uma barra de agitação imersa em um líquido girar muito rapidamente, agitando-o.', 0x2e2e2f666f746f2f31363038333738363435356664646539313538346566642e6a7067, 1);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(17, 'Autoclave', 17, 'Autoclave é um aparelho utilizado para esterilizar materiais e artigos médico-hospitalares por meio do calor úmido sob pressão inventado por Charles Chamberland, inventor e auxiliar de Louis Pasteur. ', 0x2e2e2f666f746f2f31363038333738363737356664646539333538633863372e6a7067, 2);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(18, 'Contador de colônia', 18, 'O contador de colônias é o equipamento de laboratório que auxilia a contagem de colônias cultivadas nas placa de petri.', 0x2e2e2f666f746f2f31363038333738373232356664646539363234393463632e6a7067, 1);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(19, 'Condutivímetro de Bancada', 19, 'O Condutivímetro é utilizado para medir a condutividade se soluções aquosas, é um equipamento extremamente preciso e eficiente. Ambos os tipos você pode adquirir na Gehaka, além de soluções padrões de condutividade e certificados RBC. Precisão e confiabil', 0x2e2e2f666f746f2f31363038333738373937356664646539616462373338662e6a7067, 1);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(20, 'Capela de exaustão de gases', 20, 'Capela de exaustão é um equipamento de proteção coletiva essencial em todos os laboratórios que tenham algum tipo de trabalho com manipulação de produtos químicos tóxicos, vapores agressivos, partículas ou líquidos em quantidades e concentrações perigosas', 0x2e2e2f666f746f2f31363038333738383434356664646539646332633033652e6a7067, 3);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(21, 'Mufla', 21, 'Mufla é um tipo de estufa para altas temperaturas usada em laboratórios, principalmente de química, sendo utilizada na calcinação de substâncias.', 0x2e2e2f666f746f2f31363038333738383835356664646561303530363539362e6a7067, 3);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(22, 'Deionizador para água', 22, 'O Deionizador de água remove o sais minerais da água, produzindo água sem sais e quimicamente pura. O deionizador pode ser utilizado em diversos segmentos: indústrias, farmácias de manipulação, tratamento de água, pesquisa. Na indústria pode ser utilizado', 0x2e2e2f666f746f2f31363038333738393138356664646561323638663837342e6a7067, 3);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(23, 'Estufa bacteriológica', 23, 'A função da estufa bacteriológica é submeter culturas bacteriológicas a uma temperatura constante, promovendo o crescimento e a multiplicação rápida dos microrganismos presentes nas amostras. A estufa bacteriológica costuma funcionar em temperaturas de 5°', 0x2e2e2f666f746f2f31363038333738393537356664646561346430326631332e6a7067, 3);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(24, 'Agitador de peneira', 24, 'O agitador eletromagnético para peneiras é responsável pela análise granulométrica que é uma técnica onde se determina o tamanho de partículas. ... O material é colocado sobre as peneiras granulométricas e a agitação é ativada para que a seleção aconteça.', 0x2e2e2f666f746f2f31363038333738393838356664646561366362333931342e706e67, 3);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(25, 'Microscópio', 25, 'O microscópio é um instrumento óptico com capacidade de ampliar imagens de objetos muito pequenos graças ao seu poder de resolução. Este pode ser composto ou simples: microscópio composto tem duas ou mais lentes associadas; microscópio simples é constituí', 0x2e2e2f666f746f2f31363038333739303138356664646561386163663637322e6a7067, 3);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(26, 'Turbidímetro', 26, 'Usado em indústrias farmacêuticas, de alimento ou em indústrias químicas, o turbidímetro é um equipamento capaz de medir o grau de turvação de vários líquidos.  A turvação de um líquido nada mais é do que a concentração de partículas sólidas em seu meio.', 0x2e2e2f666f746f2f31363038333739303737356664646561633564613863642e6a7067, 3);
INSERT INTO `equipamentos` (`id_equipamento`, `nome`, `numero_patrimonio`, `descricao`, `foto`, `id_lab`) VALUES(27, 'Determinador de açúcares', 27, 'Utilizado para a determinação de açúcares redutores em alimentos e bebidas, como caldo de cana, frutas, extrato de tomate, balas, etc.', 0x2e2e2f666f746f2f31363038333739313038356664646561653439663534662e6a7067, 3);



-- Catalogando os Reagentes

INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(1, 'Acetato de amônio', 1000, 0x2e2e2f666f746f2f31363038333830343439356664646630323139353634632e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(2, 'Acetato de Sódio', 400, 0x2e2e2f666f746f2f31363038333830343833356664646630343333336630302e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(3, 'Acetona', 500, 0x2e2e2f666f746f2f31363038333830353034356664646630353839396263352e706e67, 'ml', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(4, 'Ácido acético', 1, 0x2e2e2f666f746f2f31363038333830353431356664646630376436346232632e6a7067, 'l', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(5, 'Ácido acético Glacial', 800, 0x2e2e2f666f746f2f31363038333830353735356664646630396661653732352e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(6, 'Ácido acetilsalicílico', 200, 0x2e2e2f666f746f2f31363038333830363331356664646630643763646363332e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(7, 'Ácido etilenodianimo ', 400, 0x2e2e2f666f746f2f31363038333830363835356664646631306437316530382e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(8, 'Ácido Clorídrico', 3490, 0x2e2e2f666f746f2f31363038333830373435356664646631343933393063642e6a7067, 'ml', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(9, 'Clorofórmio', 1300, 0x2e2e2f666f746f2f31363038333836373136356664653038396336346639342e6a7067, 'ml', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(10, 'Cloreto de sódio', 100, 0x2e2e2f666f746f2f31363038333832343132356664646637636338343231332e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(11, 'Glicerina', 1000, 0x2e2e2f666f746f2f31363038333832343433356664646637656234383433362e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(12, 'Octapol', 1500, 0x2e2e2f666f746f2f31363038333832343837356664646638313731393131612e6a706567, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(13, 'Hidróxido de bário', 600, 0x2e2e2f666f746f2f31363038333832353332356664646638343437616636632e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(14, 'Sacarose', 1000, 0x2e2e2f666f746f2f31363038333832353838356664646638376363373663372e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(15, 'Uréia', 800, 0x2e2e2f666f746f2f31363038333832363530356664646638626137376561332e706e67, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(16, 'Sulfato de Cobre', 1000, 0x2e2e2f666f746f2f31363038333832373031356664646638656462616233342e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(17, 'Iodeto de Potássio', 50, 0x2e2e2f666f746f2f31363038333832383436356664646639376531353735322e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(18, 'Óxido de Cálcio', 450, 0x2e2e2f666f746f2f31363038333832383939356664646639623332653663612e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(19, 'Sulfato de Magnésio', 200, 0x2e2e2f666f746f2f31363038333832393530356664646639653633613861312e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(20, 'Fenolftaleína', 800, 0x2e2e2f666f746f2f31363038333832393836356664646661306138363061372e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(21, 'Azul de bromofenol', 100, 0x2e2e2f666f746f2f31363038333833303135356664646661323732316630352e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(22, 'Azul de metileno', 50, 0x2e2e2f666f746f2f31363038333833303731356664646661356639316262662e6a7067, 'ml', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(23, 'Permanganato de Potássio', 650, 0x2e2e2f666f746f2f31363038333836373338356664653038623230656536342e6a7067, 'g', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(24, 'Cloreto de sódio', 100, 0x2e2e2f666f746f2f31363038333836373832356664653038646537353738642e6a706567, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(25, 'Permanganato de Bário', 100, 0x2e2e2f666f746f2f31363038333833313736356664646661633836303332312e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(26, 'Cloreto de Bário', 500, 0x2e2e2f666f746f2f31363038333833323138356664646661663234313530302e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(27, 'Cloreto de Cálcio', 300, 0x2e2e2f666f746f2f31363038333833323637356664646662323362323662652e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(28, 'Cloreto de Estrôncio', 300, 0x2e2e2f666f746f2f31363038333833333332356664646662363433333564612e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(29, 'Cromato de Potássio', 500, 0x2e2e2f666f746f2f31363038333836383836356664653039343634366236632e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(30, 'Cloreto de Potássio', 1300, 0x2e2e2f666f746f2f31363038333833333933356664646662613165363463362e6a706567, 'g', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(31, 'Enxofre', 750, 0x2e2e2f666f746f2f31363038333836343334356664653037383231316364322e6a706567, 'g', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(32, 'Formaldeído', 500, 0x2e2e2f666f746f2f31363038333836343735356664653037616266336330362e6a7067, 'ml', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(33, 'Hidróxido de alumínio', 660, 0x2e2e2f666f746f2f31363038333836353039356664653037636465653337612e6a7067, 'g', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(34, 'Hidróxido de amonio', 120, 0x2e2e2f666f746f2f31363038333836353338356664653037656130303763372e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(35, 'Éter Dietílico', 900, 0x2e2e2f666f746f2f31363038333836353934356664653038323232373036332e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(36, 'Celite', 500, 0x2e2e2f666f746f2f31363038333836363432356664653038353232343964632e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(37, 'Siilicagel', 800, 0x2e2e2f666f746f2f31363038333837303530356664653039656165323338372e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(38, 'Solução padrão de astato', 125, 0x2e2e2f666f746f2f31363038333837303735356664653061303339363930662e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(39, 'Solução padrão de cromo', 100, 0x2e2e2f666f746f2f31363038333837313430356664653061343462313838652e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(40, 'Solução padrão de fosfato', 100, 0x2e2e2f666f746f2f31363038333837323534356664653061623663646132612e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(41, 'Solução padrão de manganês', 125, 0x2e2e2f666f746f2f31363038333837323830356664653061643033326331392e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(42, 'Solução padrão de mercúrio', 160, 0x2e2e2f666f746f2f31363038333837333230356664653061663865323139352e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(43, 'Solução padrão de zinco', 1100, 0x2e2e2f666f746f2f31363038333837333736356664653062333037376439652e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(44, 'Solução padrão de condutividade', 1000, 0x2e2e2f666f746f2f31363038333837343033356664653062346236663730362e706e67, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(45, 'Ácido Fórmico', 2000, 0x2e2e2f666f746f2f31363038333837343739356664653062393730636435312e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(46, 'Ácido Nítrico', 2800, 0x2e2e2f666f746f2f31363038333837353139356664653062626665366537622e6a7067, 'ml', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(47, 'Ácido Sulfúrico', 3300, 0x2e2e2f666f746f2f31363038333837353937356664653063306434353130342e6a7067, 'ml', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(48, 'Agar', 250, 0x2e2e2f666f746f2f31363038333837363335356664653063333334323636312e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(49, 'Álcool etílico', 500, 0x2e2e2f666f746f2f31363038333837363637356664653063353331303335362e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(50, 'Álcool isopropílico', 1000, 0x2e2e2f666f746f2f31363038333837373032356664653063373630643637622e6a7067, 'ml', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(51, 'Álcool metílico', 200, 0x2e2e2f666f746f2f31363038333837373430356664653063396362383639652e6a7067, 'ml', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(52, 'Amida de sódio', 100, 0x2e2e2f666f746f2f31363038333837373739356664653063633336383962372e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(53, 'Cloreto de ferro', 1300, 0x2e2e2f666f746f2f31363038333837383138356664653063656163393735622e6a7067, 'g', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(54, 'Biftalato de potássio', 50, 0x2e2e2f666f746f2f31363038333837383730356664653064316535643235352e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(55, 'Bicromato de sódio', 500, 0x2e2e2f666f746f2f31363038333837393138356664653064346530633536322e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(56, 'Bicarbonato de sódio', 580, 0x2e2e2f666f746f2f31363038333837393538356664653064373639623433382e706e67, 'g', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(57, 'Bicarbonato de potássio', 500, 0x2e2e2f666f746f2f31363038333837393934356664653064396130383838612e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(58, 'Carbonato de cálcio', 500, 0x2e2e2f666f746f2f31363038333838303330356664653064626563363135362e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(59, 'Carbonato de sódio', 750, 0x2e2e2f666f746f2f31363038333838303737356664653064656435633563392e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(60, 'Cloreto de Alumínio', 1500, 0x2e2e2f666f746f2f31363038333838313036356664653065306134363664302e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(61, 'Dicromato de Amônio', 80, 0x2e2e2f666f746f2f31363038333838313635356664653065343539306563302e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(62, 'Dicromato de sódio', 1500, 0x2e2e2f666f746f2f31363038333838313937356664653065363533353233352e6a7067, 'g', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(63, 'Fehling A Reativo', 1000, 0x2e2e2f666f746f2f31363038333838323730356664653065616535626631662e706e67, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(64, 'Fehling B Reativo para glicose', 1000, 0x2e2e2f666f746f2f31363038333838333034356664653065643037643365322e6a7067, 'ml', 2);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(65, 'Hidróxido de cálcio', 1650, 0x2e2e2f666f746f2f31363038333838333433356664653065663730373361302e6a7067, 'g', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(66, 'Hidróxido de potássio', 1000, 0x2e2e2f666f746f2f31363038333838343033356664653066333338663066612e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(67, 'Hidróxido de magnésio', 1550, 0x2e2e2f666f746f2f31363038333838343334356664653066353264373663652e6a7067, 'g', 3);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(68, 'Hidróxido de sódio', 2200, 0x2e2e2f666f746f2f31363038333838343737356664653066376433636637662e6a7067, 'g', 1);
INSERT INTO `reagentes` (`id_reagente`, `nome`, `quantidade`, `foto`, `medida`, `id_lab`) VALUES(69, 'Hidróxido de sódio, solução', 1000, 0x2e2e2f666f746f2f31363038333838353037356664653066396239373835372e6a7067, 'ml', 2);



-- Catalogando as Vidrarias

INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(1, 'Almofariz com pistilo', 20, 'Almofariz com pistilo: equipamento usado para maceração de substâncias sólidas. ... Empregado em titulações, aquecimento de líquidos e para dissolver substâncias.', 0x2e2e2f666f746f2f31363038333739323530356664646562373233306235642e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(2, 'Argola', 20, 'Uma argola metálica é uma peça de forma anelar, com um braço para fixação a um suporte universal, utilizada no laboratório como suporte de funis e de ampolas de decantação. As argolas de metal permitem uma certa mobilidade na peça de vidro, evitando algun', 0x2e2e2f666f746f2f31363038333739323737356664646562386433373831352e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(3, 'Bastão de vidro', 15, 'Bastão de vidro é um instrumento feito em vidro alcalino, maciço, utilizado em transportes de líquidos e agitação de soluções. No transporte de líquidos ele é utilizado para não respingar líquidos fora do recipiente.', 0x2e2e2f666f746f2f31363038333739333036356664646562616131333364662e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(4, 'Balão de fundo chato 500 ml', 22, 'Os balões de fundo chato e gargalo longo Pyrex® de 500ml são cuidadosamente projetados e fabricados a partir de vidro borosilicato. ', 0x2e2e2f666f746f2f31363038333739343438356664646563333863306535372e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(5, 'Balão de fundo chato 1000 ml', 22, 'Os balões de fundo chato e gargalo longo Pyrex® de 1000ml são cuidadosamente projetados e fabricados a partir de vidro borosilicato. ', 0x2e2e2f666f746f2f31363038333739343936356664646563363834626465652e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(6, 'Balão de destilação 125 ml', 30, 'O balão de destilação de 125ml é fabricado em vidro borossilicato e possui saída lateral com ângulo de 75° a partir do gargalo.', 0x2e2e2f666f746f2f31363038333739353336356664646563393039643533312e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(7, 'Balão volumétrico 100ml', 20, 'Os balões volumétricos Classe A são fabricados de acordo com as normas. Suas gravações permanentes de lote e menisco na cor branca facilitam a leitura.', 0x2e2e2f666f746f2f31363038333739353930356664646563633639303465362e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(8, 'Béquer 100ml', 10, 'Béquer 100 ml, com bico. É fabricado com espessura de parede uniforme para oferecer o melhor equilíbrio entre resistência ao choque térmico e resistência mecânica.', 0x2e2e2f666f746f2f31363038333739363432356664646563666135373830312e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(9, 'Balão volumétrico 250ml', 20, 'Béquer 250 ml, com bico. É fabricado com espessura de parede uniforme para oferecer o melhor equilíbrio entre resistência ao choque térmico e resistência mecânica.', 0x2e2e2f666f746f2f31363038333739363830356664646564323034323763382e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(10, 'Bico de Bunsen', 10, 'O bico de Bunsen é um dispositivo usado para efetuar aquecimento de soluções em laboratório. Este queimador, muito usado no laboratório, é formado por um tubo com orifícios laterais, na base, por onde entra o ar, o qual se vai misturar com o gás que entra', 0x2e2e2f666f746f2f31363038333739373236356664646564346565626334662e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(11, 'Bureta graduada com torneira 50ml', 10, 'Tubo cilíndrico graduado, com torneira na extremidade, usado em laboratório para dosear ou dispensar líquidos com precisão.', 0x2e2e2f666f746f2f31363038333739373931356664646564386663343965372e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(12, 'Cadinho', 20, 'É um pequeno recipiente, com forma de pote, que é utilizado para aquecer sólidos a temperaturas bastante elevadas. Estes podem ser feitos de metal ou de cerâmica mas nos laboratórios é mais comum encontrarem-se cadinhos de carâmica, especialmente de porce', 0x2e2e2f666f746f2f31363038333739383331356664646564623732626338632e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(13, 'Cápsula de porcelana', 20, 'É utilizada para realizar evaporação de compostos, calcinação, secagem e outras análises. Pode ser utilizada diretamente no fogo ou sobre tela de amianto.', 0x2e2e2f666f746f2f31363038333830313132356664646565643034656531622e706e67, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(14, 'Coluna de fracionamento', 10, 'Uma coluna de fracionamento é um item de laboratório essencial para a destilação de misturas de líquidos para separação de seus componentes em partes, ou frações, baseadas na diferença de volatilidade dos componentes.', 0x2e2e2f666f746f2f31363038333830313936356664646566323461363533362e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(15, 'Condensador', 10, 'Um condensador tem como finalidade condensar vapores gerados pelo aquecimento de líquidos em processos de destilação simples. Ele é dividido em duas partes: Uma onde passa o vapor que se tem interesse em condensar e outra onde passa um líquido resfriado p', 0x2e2e2f666f746f2f31363038333830323237356664646566343332343965662e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(16, 'Dessecador', 15, 'Um dessecador é um recipiente fechado que contém um agente de secagem chamado dessecante. A tampa é engraxada para que feche de forma hermética. É utilizado para guardar substâncias em ambientes com baixo teor de umidade. O agente dessecante mais utilizad', 0x2e2e2f666f746f2f31363038333830323533356664646566356461353334342e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(17, 'Erlenmeyer 500ml', 5, 'O Erlenmeyer de 500ml é fabricado com material reforçado e possui espessura de parede uniforme para garantir o equilíbrio adequado entre eficiência mecânica e resistência ao choque térmico. A graduação do produto é gravada em esmalte branco permanente.', 0x2e2e2f666f746f2f31363038333830323930356664646566383233363338342e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(18, 'Espátula ', 10, 'É um utensílio destinado a transferir pequenas porções de substâncias sólidas.. A grande maioria das espátulas utilizadas em laboratório é resistente a ácidos, bases e outros agentes.', 0x2e2e2f666f746f2f31363038333830333333356664646566616430353430642e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(19, 'Filtro de Bromo 250 Ml', 17, 'O funil de bromo ou balão de decantação é uma das vidrarias utilizadas em laboratório com principal função de separar uma mistura líquida heterogênea por simples ação da gravidade: o componente líquido mais denso tende a ocupar a região inferior e, portan', 0x2e2e2f666f746f2f31363038333836373737356664653038643932363963322e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(20, 'Filtro de Bromo 500 ml', 15, 'O funil de bromo ou balão de decantação é uma das vidrarias utilizadas em laboratório com principal função de separar uma mistura líquida heterogênea por simples ação da gravidade: o componente líquido mais denso tende a ocupar a região inferior e, portan', 0x2e2e2f666f746f2f31363038333836383033356664653038663337636332652e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(21, 'Funil de Buchner', 20, 'O funil de Büchner é um tipo de vidraria de laboratório, consistindo em um funil feito de porcelana e com vários orifícios, como uma peneira. Ele é usado junto com o Kitassato para filtração de mistura a vácuo.', 0x2e2e2f666f746f2f31363038333836393433356664653039376639653362352e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(22, 'Funil de Haste Longa', 15, 'Funil de haste longa é utilizado na transferência de líquidos e no processo de filtração com retenção de partículas sólidas.', 0x2e2e2f666f746f2f31363038333837303033356664653039626236346338662e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(23, 'Garra de Condensador', 15, 'Espécie de braçadeira que prende o condensador ou outras peças, como balões, erlenmeyers e outros à haste do suporte universal.', 0x2e2e2f666f746f2f31363038333837303732356664653061303064623031642e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(24, 'Kitassato 500 ml', 18, 'Utilizado em conjunto com o funil de Büchner em filtrações a vácuo. Compõe a aparelhagem das filtrações a vácuo. Sua saída lateral se conecta a uma trompa de vácuo. É utilizado para uma filtragem mais veloz, e também para secagem de sólidos precipitados.', 0x2e2e2f666f746f2f31363038333837313637356664653061356631653961302e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(25, 'Kitassato 1000 ml', 21, 'Utilizado em conjunto com o funil de Büchner em filtrações a vácuo. Compõe a aparelhagem das filtrações a vácuo. Sua saída lateral se conecta a uma trompa de vácuo. É utilizado para uma filtragem mais veloz, e também para secagem de sólidos precipitados.', 0x2e2e2f666f746f2f31363038333837313834356664653061373062343438622e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(26, 'Papel Filtro', 20, 'Serve para separar sólidos de líquidos. O filtro deve ser utilizado no funil comum.', 0x2e2e2f666f746f2f31363038333837323437356664653061616639376364622e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(27, 'Pera', 15, 'Equipamento de laboratório que consiste um dispositivo que, acoplado a uma pipeta, auxilia a retirada de líquidos por sucção.', 0x2e2e2f666f746f2f31363038333837333338356664653062306134636531332e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(28, 'Picnômetro de vidro', 17, 'O picnômetro de vidro é uma vidraria especial esmerilhada, utilizada na picnometria que possui baixo coeficiente de dilatação.', 0x2e2e2f666f746f2f31363038333837343331356664653062363738643534322e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(29, 'Pipeta Graduada 20 ml', 18, 'A pipeta graduada é um instrumento em vidro que permite a medição e transferência de (alíquotas) volumes variáveis de líquidos. É um tubo longo e estreito, aberto nas duas extremidades, marcado com linhas horizontais que constituem uma escala graduada.', 0x2e2e2f666f746f2f31363038333837353638356664653062663063623732392e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(30, 'Pipeta Graduada 50 ml', 19, 'A pipeta graduada é um instrumento em vidro que permite a medição e transferência de (alíquotas) volumes variáveis de líquidos. É um tubo longo e estreito, aberto nas duas extremidades, marcado com linhas horizontais que constituem uma escala graduada.', 0x2e2e2f666f746f2f31363038333839313934356664653132346136653132382e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(31, 'Pipeta Volumétrica 25 ml', 15, 'A pipeta volumétrica é um instrumento em vidro que permite a medição e transferência rigorosa de volumes de líquidos. É um tubo longo e estreito, com uma zona central mais larga, aberto nas duas extremidades, marcado com uma linha horizontal que indica o ', 0x2e2e2f666f746f2f31363038333839323836356664653132613633363230612e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(32, 'Pinça Metálica', 18, 'Serve para manipular objetos aquecidos.', 0x2e2e2f666f746f2f31363038333839353036356664653133383263343031662e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(33, 'Pinça de Madeira', 18, 'Utilizada para segurar tubos de ensaio em aquecimento, evitando queimaduras nos dedos.', 0x2e2e2f666f746f2f31363038333839353634356664653133626365656337322e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(34, 'Pisseta', 18, 'Pisseta é um recipiente de uso laboratorial no qual se armazenam compostos de diversas naturezas. Normalmente utiliza-se a pisseta para se por água destilada ou água desmineralizada e destina-se a descontaminação, lavagem de materiais ou utensílios de lab', 0x2e2e2f666f746f2f31363038333839363433356664653134306236316266372e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(35, 'Placa de Petri', 15, 'Uma placa de Petri, ou caixa Petri é um recipiente cilíndrico, achatado, de vidro ou plástico que os profissionais de laboratório utilizam para a cultura de microorganismos.', 0x2e2e2f666f746f2f31363038333839373238356664653134363038316238342e6a7067, 1);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(36, 'Proveta Graduada 500 ml', 25, 'Vidrarias de laboratório graduadas e volumétricas graduada: este equipamento oferece graduações ao longo de sua estrutura que pode possibilitar a sucção das mais diversas quantidades de líquidos.', 0x2e2e2f666f746f2f31363038333839393437356664653135336237366639642e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(37, 'Proveta Graduada 1000 ml', 17, 'Vidrarias de laboratório graduadas e volumétricas graduada: este equipamento oferece graduações ao longo de sua estrutura que pode possibilitar a sucção das mais diversas quantidades de líquidos.', 0x2e2e2f666f746f2f31363038333839393636356664653135346533666162642e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(38, 'Suporte Universal', 19, 'Um suporte universal consiste numa vara metálica vertical fixada numa base metálica estável (retangular ou triangular) e serve para a sustentação de peças de laboratório.', 0x2e2e2f666f746f2f31363038333930303132356664653135376335623936632e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(39, 'Termômetro', 15, 'O termômetro de laboratório de química é um equipamento utilizado para medir a temperatura. Sua construção baseia-se no uso de grandezas físicas que dependem da variação de temperatura. A medição da temperatura de um meio qualquer só é possível após a oco', 0x2e2e2f666f746f2f31363038333930303936356664653135643039383831662e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(40, 'Tubo de Ensaio', 29, 'Os tubos de ensaio são recipientes de vidro alongados e cilíndricos, comumente usados em experiências com pouco volume. Os tubos de ensaio podem ser aquecidos no Bico de Bunsen. O diâmetro da abertura geralmente fica entre 1 e 2 centímetros, e 5 a 20 cm d', 0x2e2e2f666f746f2f31363038333930313433356664653135666665383735632e6a7067, 3);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(41, 'Tripé', 16, 'Um tripé é um aro metálico circular suportado por três hastes de ferro (pernas) e utiliza-se para suportar recipientes submetidos a aquecimento por um bico de gás.\r\nÉ sobre o tripé que se assentam as redes metálicas e os triângulos de porcelana, que suste', 0x2e2e2f666f746f2f31363038333930323031356664653136333933616537312e6a7067, 2);
INSERT INTO `vidrarias` (`id_vidraria`, `nome`, `quantidade`, `descricao`, `foto`, `id_lab`) VALUES(42, 'Vidro de Relógio', 17, 'Um vidro de relógio é um pequeno recipiente côncavo de vidro com formato circular. Sua principal função é a pesagem de pequenas quantidades de sólidos, entretanto pode ser usado também em análises e evaporações de pequena escala.', 0x2e2e2f666f746f2f31363038333930323433356664653136363338373162332e6a7067, 2);

-- ------------------------------------------------------------- FIM DOS INSERT'S -------------------------------------------------------------------------

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
