-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema laboratorios_quimica
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema laboratorios_quimica
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `laboratorios_quimica` DEFAULT CHARACTER SET utf8 ;
USE `laboratorios_quimica` ;

-- -----------------------------------------------------
-- Table `laboratorios_quimica`.`laboratorios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorios_quimica`.`laboratorios` (
  `id_laboratorio` INT NOT NULL AUTO_INCREMENT,
  `laboratorio` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_laboratorio`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorios_quimica`.`vidrarias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorios_quimica`.`vidrarias` (
  `id_vidraria` INT NOT NULL AUTO_INCREMENT,
  `id_laboratorio` INT NOT NULL,
  `nome` VARCHAR(50) NOT NULL,
  `quantidade` INT NOT NULL,
  `descricao` VARCHAR(300) NOT NULL,
  `foto` VARCHAR(28) NOT NULL,
  PRIMARY KEY (`id_vidraria`),
  INDEX `fk_vidrarias_laboratorio1_idx` (`id_laboratorio` ASC),
  CONSTRAINT `fk_vidrarias_laboratorio1`
    FOREIGN KEY (`id_laboratorio`)
    REFERENCES `laboratorios_quimica`.`laboratorios` (`id_laboratorio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorios_quimica`.`equipamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorios_quimica`.`equipamentos` (
  `id_equipamento` INT NOT NULL AUTO_INCREMENT,
  `id_laboratorio` INT NOT NULL,
  `nome` VARCHAR(50) NOT NULL,
  `patrimonio` INT NOT NULL,
  `descricao` VARCHAR(300) NOT NULL,
  `foto` VARCHAR(28) NOT NULL,
  PRIMARY KEY (`id_equipamento`),
  INDEX `fk_equipamentos_laboratorio1_idx` (`id_laboratorio` ASC),
  CONSTRAINT `fk_equipamentos_laboratorio1`
    FOREIGN KEY (`id_laboratorio`)
    REFERENCES `laboratorios_quimica`.`laboratorios` (`id_laboratorio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorios_quimica`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorios_quimica`.`usuarios` (
  `id_usuario` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `tipo` VARCHAR(12) NOT NULL,
  `rm` INT NULL,
  `ra` INT NULL,
  `email` VARCHAR(60) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE INDEX `rm_UNIQUE` (`rm` ASC),
  UNIQUE INDEX `ra_UNIQUE` (`ra` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorios_quimica`.`relatorios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorios_quimica`.`relatorios` (
  `id_relatorio` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `id_laboratorio` INT NOT NULL,
  `titulo` VARCHAR(55) NOT NULL,
  `data_hora` DATETIME NOT NULL,
  `aulas` CHAR(8) NOT NULL,
  `descricao` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id_relatorio`),
  INDEX `fk_relatorios_professores_idx` (`id_usuario` ASC),
  INDEX `fk_relatorios_local1_idx` (`id_laboratorio` ASC),
  CONSTRAINT `fk_relatorios_usuarios`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `laboratorios_quimica`.`usuarios` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_laboratorios`
    FOREIGN KEY (`id_laboratorio`)
    REFERENCES `laboratorios_quimica`.`laboratorios` (`id_laboratorio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorios_quimica`.`reagentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorios_quimica`.`reagentes` (
  `id_reagente` INT NOT NULL AUTO_INCREMENT,
  `id_laboratorio` INT NOT NULL,
  `nome` VARCHAR(50) NOT NULL,
  `medida` VARCHAR(2) NOT NULL,
  `quantidade` INT NOT NULL,
  `foto` VARCHAR(28) NOT NULL,
  PRIMARY KEY (`id_reagente`),
  INDEX `fk_reagentes_laboratorio1_idx` (`id_laboratorio` ASC),
  CONSTRAINT `fk_reagentes_laboratorio1`
    FOREIGN KEY (`id_laboratorio`)
    REFERENCES `laboratorios_quimica`.`laboratorios` (`id_laboratorio`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorios_quimica`.`vidrarias_quebradas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorios_quimica`.`vidrarias_quebradas` (
  `id_vidraria_quebrada` INT NOT NULL AUTO_INCREMENT,
  `id_vidraria` INT NOT NULL,
  `id_relatorio` INT NOT NULL,
  `quantidade_quebrada` INT NOT NULL,
  PRIMARY KEY (`id_vidraria_quebrada`),
  INDEX `fk_vidrarias_quebradas_relatorios1_idx` (`id_relatorio` ASC),
  INDEX `fk_vidrarias_quebradas_vidrarias1_idx` (`id_vidraria` ASC),
  CONSTRAINT `fk_vidrarias_quebradas_relatorios1`
    FOREIGN KEY (`id_relatorio`)
    REFERENCES `laboratorios_quimica`.`relatorios` (`id_relatorio`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vidrarias_quebradas_vidrarias1`
    FOREIGN KEY (`id_vidraria`)
    REFERENCES `laboratorios_quimica`.`vidrarias` (`id_vidraria`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorios_quimica`.`relatorios_reagentes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorios_quimica`.`relatorios_reagentes` (
  `id_relatorio_reagente` INT NOT NULL AUTO_INCREMENT,
  `id_relatorio` INT NOT NULL,
  `id_reagente` INT NOT NULL,
  `quantidade_usada` INT NOT NULL,
  INDEX `fk_relatorios_has_reagentes_reagentes1_idx` (`id_reagente` ASC),
  INDEX `fk_relatorios_has_reagentes_relatorios1_idx` (`id_relatorio` ASC),
  PRIMARY KEY (`id_relatorio_reagente`),
  CONSTRAINT `fk_relatorios_has_reagentes_relatorios1`
    FOREIGN KEY (`id_relatorio`)
    REFERENCES `laboratorios_quimica`.`relatorios` (`id_relatorio`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_has_reagentes_reagentes1`
    FOREIGN KEY (`id_reagente`)
    REFERENCES `laboratorios_quimica`.`reagentes` (`id_reagente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorios_quimica`.`relatorios_equipamentos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorios_quimica`.`relatorios_equipamentos` (
  `id_relatorio_equipamento` INT NOT NULL AUTO_INCREMENT,
  `id_relatorio` INT NOT NULL,
  `id_equipamento` INT NOT NULL,
  INDEX `fk_relatorios_has_equipamentos_equipamentos1_idx` (`id_equipamento` ASC),
  INDEX `fk_relatorios_has_equipamentos_relatorios1_idx` (`id_relatorio` ASC),
  PRIMARY KEY (`id_relatorio_equipamento`),
  CONSTRAINT `fk_relatorios_has_equipamentos_relatorios1`
    FOREIGN KEY (`id_relatorio`)
    REFERENCES `laboratorios_quimica`.`relatorios` (`id_relatorio`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_has_equipamentos_equipamentos1`
    FOREIGN KEY (`id_equipamento`)
    REFERENCES `laboratorios_quimica`.`equipamentos` (`id_equipamento`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `laboratorios_quimica`.`relatorios_vidrarias`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `laboratorios_quimica`.`relatorios_vidrarias` (
  `id_relatorio_vidraria` INT NOT NULL AUTO_INCREMENT,
  `id_relatorio` INT NOT NULL,
  `id_vidraria` INT NOT NULL,
  INDEX `fk_relatorios_has_vidrarias_vidrarias1_idx` (`id_vidraria` ASC),
  INDEX `fk_relatorios_has_vidrarias_relatorios1_idx` (`id_relatorio` ASC),
  PRIMARY KEY (`id_relatorio_vidraria`),
  CONSTRAINT `fk_relatorios_has_vidrarias_relatorios1`
    FOREIGN KEY (`id_relatorio`)
    REFERENCES `laboratorios_quimica`.`relatorios` (`id_relatorio`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_relatorios_has_vidrarias_vidrarias1`
    FOREIGN KEY (`id_vidraria`)
    REFERENCES `laboratorios_quimica`.`vidrarias` (`id_vidraria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

-- -----------------------------------------------------

-- INSERTS
INSERT INTO `laboratorios` (`id_laboratorio`, `laboratorio`) VALUES
	(1, 'Externo'),
	(2, 'Interno'),
	(3, 'Ambos');

INSERT INTO `equipamentos` (`id_equipamento`, `id_laboratorio`, `nome`, `patrimonio`, `descricao`, `foto`) VALUES
	(1, 1, 'Balança de Precisão', 1, 'É um equipamento de grande importância para medições da massa de um corpo. A escolha de uma balança de precisão para laboratório ou para qualquer outro tipo de utilização deve se levar em conta a necessidade do usuário: em relação a quanto ele deseja pesar e a resolução dessa pesagem.', '16083779475fdde65b4780b.jpg'),
	(2, 2, 'Bomba de vácuo', 2, 'Aparelho destinado a retirar o gás de um determinado volume, de forma que a pressão seja baixada a valores adequados ao propósito desejado.', '16083780185fdde6a292a42.jpg'),
	(3, 1, 'Sacarímetro de BRIX', 3, 'Instrumento destinado a medir o teor de açúcar em solução. A escala do Sacarímetro de Brix varia de 0 a 90º Brix com divisões de 0,1 / 0,2 / 0,5 e 1º Brix. A escala de temperatura no caso de Termo-densímetros varia de 0 a 50ºC com divisão de 1ºC.', '16083780815fdde6e13fc0a.jpg'),
	(4, 2, 'Banho de ultrassom', 4, 'Indicado para limpeza e desinfecção de utensílios, dissolução de amostras, desgaseificação de líquidos e em testes de sujidades de peças. Também é conhecido como Banho Ultrassom.', '16083781305fdde712f3413.jpg'),
	(5, 1, 'Balança semianalítica', 5, 'Instrumento que serve para realizar a medição de massa de corpos e objetos, podendo ser usada para inúmeras áreas.', '16083781695fdde73942c77.jpg'),
	(6, 2, 'Espectrofotômetro', 6, 'Utilizado em laboratórios de pesquisa, capaz de medir e comparar a quantidade de luz absorvida, transmitida ou refletida por uma determinada amostra, seja ela solução, sólido transparente ou sólido opaco.', '16083782315fdde77734ffb.jpg'),
	(7, 1, 'Condutivímetro', 7, 'Instrumento responsável por medir a quantidade de corrente elétrica ou condutância em uma solução, sendo que esta condutividade é útil para determinar o estado geral de um recipiente composto por água natural.', '16083782685fdde79c558f9.png'),
	(8, 2, 'pHmetro', 8, 'Aparelho usado para medição de pH. Constituído basicamente por um eletrodo e um circuito potenciômetro. O aparelho é calibrado (stado) de acordo com os valores referenciados em cada uma das soluções de calibração. Para que se conclua o ajuste, é então calibrado em dois ou mais pontos.', '16083783175fdde7cdc5d09.jpg'),
	(9, 1, 'Forno', 9, 'Criado para facilitar manipulação de substâncias e manuseio de itens e pode ser utilizado em indústrias de diversos setores, como, por exemplo, dos setores químico, farmacêutico e alimentício.', '16083783575fdde7f5c47d6.png'),
	(10, 2, 'Manta Aquecedora', 10, 'Instrumento de vital importância para laboratórios, a manta aquecedora é um pequeno equipamento cuja função é elevar a temperatura de substâncias químicas, mas de forma controlada e bastante precisa.', '16083783955fdde81b8867a.jpg'),
	(11, 2, 'Refratômetro', 11, 'Instrumento óptico utilizado para medir o índice de refração de uma substância translúcida. Inventado por William Hyde Wollaston, em 1802, teve em Ernst Abbe seu desenvolvedor para um modelo prático.', '16083784335fdde841d70e5.jpg'),
	(12, 1, 'Chuveiro de emergência', 12, 'São equipamentos de proteção coletiva imprescindíveis a todos os laboratórios. São destinados a eliminar ou minimizar os danos causados por acidentes nos olhos e/ou face e em qualquer parte do corpo.', '16083784725fdde86866510.jpg'),
	(13, 2, 'Chapa', 13, 'Permite aquecer e controlar o aquecimento de substâncias, pode apresentar plataforma em cerâmica, plataforma em alumínio, ferro e outros materiais. Um chapa aquecedora de laboratório deve ser resistente e estar bem apoiada em uma bancada de laboratório.', '16083785045fdde88827bd1.jpg'),
	(14, 1, 'Estufa', 14, 'Equipamento que, por seus diversos modelos e funcionalidades, se mostra de extrema importância para qualquer laboratório de ponta. Sua principal função é realizar a secagem de vidrarias e materiais, podendo também ser utilizada para esterilização.', '16083785485fdde8b4a8a38.jpg'),
	(15, 2, 'Destilador', 15, 'Aparelho desenvolvido para obtenção de água pura. A água destilada é muito utilizada em laboratórios de pesquisa, preparo de soluções e diversos outros fins.', '16083785995fdde8e7bf660.jpg'),
	(16, 1, 'Agitador magnético', 16, 'É um dispositivo que emprega um campo magnético giratório para fazer uma barra de agitação imersa em um líquido girar muito rapidamente, agitando-o.', '16083786455fdde91584efd.jpg'),
	(17, 2, 'Autoclave', 17, 'É um aparelho utilizado para esterilizar materiais e artigos médico-hospitalares por meio do calor úmido sob pressão inventado por Charles Chamberland, inventor e auxiliar de Louis Pasteur.', '16083786775fdde9358c8c7.jpg'),
	(18, 1, 'Contador de colônia', 18, 'Equipamento que auxilia a contagem de colônias cultivadas nas placa de petri. Capaz de contar colônias de bactérias ou Fungos.', '16083787225fdde962494cc.jpg'),
	(19, 1, 'Condutivímetro de Bancada', 19, 'Utilizado para medir a condutividade se soluções aquosas, é um equipamento extremamente preciso e eficiente. Ambos os tipos você pode adquirir na Gehaka, além de soluções padrões de condutividade e certificados RBC. Precisão e confiabilidade nas análises de condutividade.', '16083787975fdde9adb738f.jpg'),
	(20, 3, 'Capela de exaustão de gases', 20, 'Equipamento de proteção coletiva essencial em todos os laboratórios que tenham algum tipo de trabalho com manipulação de produtos químicos tóxicos, vapores agressivos, partículas ou líquidos em quantidades e concentrações perigosas, prejudiciais para a saúde.', '16083788445fdde9dc2c03e.jpg'),
	(21, 3, 'Mufla', 21, 'Tipo de estufa para altas temperaturas usada em laboratórios, principalmente de química, sendo utilizada na calcinação de substâncias.', '16083788855fddea0506596.jpg'),
	(22, 3, 'Deionizador para água', 22, 'Remove o sais minerais da água, produzindo água sem sais e quimicamente pura. O deionizador pode ser utilizado em diversos segmentos: indústrias, farmácias de manipulação, tratamento de água, pesquisa.', '16083789185fddea268f874.jpg'),
	(23, 3, 'Estufa bacteriológica', 23, 'Submete as culturas bacteriológicas a uma temperatura constante, promovendo o crescimento e a multiplicação rápida dos microrganismos presentes nas amostras. A estufa bacteriológica costuma funcionar em temperaturas de 5°C acima do ambiente até 60°C.', '16083789575fddea4d02f13.jpg'),
	(24, 3, 'Agitador de peneira', 24, 'Responsável pela análise granulométrica que é uma técnica onde se determina o tamanho de partículas. O material é colocado sobre as peneiras granulométricas e a agitação é ativada para que a seleção aconteça.', '16083789885fddea6cb3914.png'),
	(25, 3, 'Microscópio', 25, 'Instrumento óptico com capacidade de ampliar imagens de objetos muito pequenos graças ao seu poder de resolução. Este pode ser composto ou simples: microscópio composto tem duas ou mais lentes associadas; microscópio simples é constituído por apenas uma lente.', '16083790185fddea8acf672.jpg'),
	(26, 3, 'Turbidímetro', 26, 'Usado em indústrias farmacêuticas, de alimento ou em indústrias químicas, o turbidímetro é um equipamento capaz de medir o grau de turvação de vários líquidos.  A turvação de um líquido nada mais é do que a concentração de partículas sólidas em seu meio.', '16083790775fddeac5da8cd.jpg'),
	(27, 3, 'Determinador de açúcares', 27, 'Utilizado para a determinação de açúcares redutores em alimentos e bebidas, como caldo de cana, frutas, extrato de tomate, balas, etc.', '16083791085fddeae49f54f.jpg');

INSERT INTO `reagentes` (`id_reagente`, `id_laboratorio`, `nome`, `medida`, `quantidade`, `foto`) VALUES
	(1, 1, 'Acetato de amônia', 'g', 1000, '16083804495fddf0219564c.jpg'),
	(2, 2, 'Acetato de Sódio', 'g', 400, '16083804835fddf04333f00.jpg'),
	(3, 1, 'Acetona', 'ml', 500, '16083805045fddf05899bc5.png'),
	(4, 1, 'Ácido acético', 'L', 1, '16083805415fddf07d64b2c.jpg'),
	(5, 2, 'Ácido acético Glacial', 'ml', 800, '16083805755fddf09fae725.jpg'),
	(6, 2, 'Ácido acetilsalicílico', 'g', 200, '16083806315fddf0d7cdcc3.jpg'),
	(7, 2, 'Ácido etilenodianimo ', 'g', 400, '16083806855fddf10d71e08.jpg'),
	(8, 3, 'Ácido Clorídrico', 'ml', 3490, '16083807455fddf149390cd.jpg'),
	(9, 3, 'Clorofórmio', 'ml', 1300, '16083867165fde089c64f94.jpg'),
	(10, 1, 'Cloreto de sódio', 'g', 100, '16083824125fddf7cc84213.jpg'),
	(11, 2, 'Glicerina', 'ml', 1000, '16083824435fddf7eb48436.jpg'),
	(12, 1, 'Octapol', 'g', 1500, '16083824875fddf8171911a.jpeg'),
	(13, 1, 'Hidróxido de bário', 'g', 600, '16083825325fddf8447af6c.jpg'),
	(14, 1, 'Sacarose', 'g', 1000, '16083825885fddf87cc76c7.jpg'),
	(15, 1, 'Uréia', 'g', 800, '16083826505fddf8ba77ea3.png'),
	(16, 2, 'Sulfato de Cobre', 'g', 1000, '16083827015fddf8edbab34.jpg'),
	(17, 1, 'Iodeto de Potássio', 'g', 50, '16083828465fddf97e15752.jpg'),
	(18, 1, 'Óxido de Cálcio', 'g', 450, '16083828995fddf9b32e6ca.jpg'),
	(19, 2, 'Sulfato de Magnésio', 'g', 200, '16083829505fddf9e63a8a1.jpg'),
	(20, 2, 'Fenolftaleína', 'ml', 800, '16083829865fddfa0a860a7.jpg'),
	(21, 1, 'Azul de bromofenol', 'g', 100, '16083830155fddfa2721f05.jpg'),
	(22, 1, 'Azul de metileno', 'ml', 50, '16083830715fddfa5f91bbf.jpg'),
	(23, 3, 'Permanganato de Potássio', 'g', 650, '1618837661607d809db5954.jpg'),
	(24, 2, 'Cloreto de sódio', 'g', 100, '16083867825fde08de7578d.jpeg'),
	(25, 1, 'Permanganato de Bário', 'g', 100, '16083831765fddfac860321.jpg'),
	(26, 1, 'Cloreto de Bário', 'g', 500, '16083832185fddfaf241500.jpg'),
	(27, 2, 'Cloreto de Cálcio', 'g', 300, '16083832675fddfb23b26be.jpg'),
	(28, 1, 'Cloreto de Estrôncio', 'g', 300, '16083833325fddfb64335da.jpg'),
	(29, 2, 'Cromato de Potássio', 'ml', 500, '16083868865fde094646b6c.jpg'),
	(30, 3, 'Cloreto de Potássio', 'g', 1300, '16083833935fddfba1e64c6.jpeg'),
	(31, 3, 'Enxofre', 'g', 750, '16085193435fe00eaff077f.jpeg'),
	(32, 1, 'Formaldeído', 'ml', 500, '16083864755fde07abf3c06.jpg'),
	(33, 3, 'Hidróxido de alumínio', 'g', 660, '16083865095fde07cdee37a.jpg'),
	(34, 2, 'Hidróxido de amônio', 'ml', 120, '16083865385fde07ea007c7.jpg'),
	(35, 2, 'Éter Dietílico', 'ml', 900, '16083865945fde082227063.jpg'),
	(36, 2, 'Celite', 'g', 500, '16083866425fde0852249dc.jpg'),
	(37, 1, 'Siilicagel', 'g', 800, '16083870505fde09eae2387.jpg'),
	(38, 2, 'Solução padrão de astato', 'ml', 125, '16083870755fde0a039690f.jpg'),
	(39, 2, 'Solução padrão de cromo', 'ml', 100, '16083871405fde0a44b188e.jpg'),
	(40, 2, 'Solução padrão de fosfato', 'ml', 100, '16083872545fde0ab6cda2a.jpg'),
	(41, 2, 'Solução padrão de manganês', 'ml', 125, '16083872805fde0ad032c19.jpg'),
	(42, 2, 'Solução padrão de mercúrio', 'ml', 160, '16083873205fde0af8e2195.jpg'),
	(43, 2, 'Solução padrão de zinco', 'ml', 1100, '16083873765fde0b3077d9e.jpg'),
	(44, 2, 'Solução padrão de condutividade', 'ml', 1000, '16083874035fde0b4b6f706.png'),
	(45, 2, 'Ácido Fórmico', 'ml', 2000, '16083874795fde0b970cd51.jpg'),
	(46, 3, 'Ácido Nítrico', 'ml', 2800, '16083875195fde0bbfe6e7b.jpg'),
	(47, 3, 'Ácido Sulfúrico', 'ml', 3300, '16083875975fde0c0d45104.jpg'),
	(48, 2, 'Agar', 'g', 250, '16083876355fde0c3342661.jpg'),
	(49, 2, 'Álcool etílico', 'ml', 500, '16083876675fde0c5310356.jpg'),
	(50, 1, 'Álcool isopropílico', 'ml', 1000, '16083877025fde0c760d67b.jpg'),
	(51, 1, 'Álcool metílico', 'ml', 200, '16083877405fde0c9cb869e.jpg'),
	(52, 2, 'Amida de sódio', 'g', 100, '16083877795fde0cc3689b7.jpg'),
	(53, 3, 'Cloreto de ferro', 'g', 1300, '16083878185fde0ceac975b.jpg'),
	(54, 1, 'Biftalato de potássio', 'g', 50, '16083878705fde0d1e5d255.jpg'),
	(55, 2, 'Bicromato de sódio', 'g', 500, '16083879185fde0d4e0c562.jpg'),
	(56, 3, 'Bicarbonato de sódio', 'g', 580, '16083879585fde0d769b438.png'),
	(57, 2, 'Bicarbonato de potássio', 'g', 500, '16083879945fde0d9a0888a.jpg'),
	(58, 2, 'Carbonato de cálcio', 'g', 500, '16083880305fde0dbec6156.jpg'),
	(59, 2, 'Carbonato de sódio', 'g', 750, '16083880775fde0ded5c5c9.jpg'),
	(60, 2, 'Cloreto de Alumínio', 'g', 1500, '16083881065fde0e0a466d0.jpg'),
	(61, 1, 'Dicromato de Amônio', 'g', 80, '16083881655fde0e4590ec0.jpg'),
	(62, 2, 'Dicromato de sódio', 'g', 1500, '16083881975fde0e6535235.jpg'),
	(63, 2, 'Fehling A Reativo', 'ml', 1000, '16083882705fde0eae5bf1f.png'),
	(64, 2, 'Fehling B Reativo para glicose', 'ml', 1000, '16083883045fde0ed07d3e2.jpg'),
	(65, 3, 'Hidróxido de cálcio', 'g', 1650, '16083883435fde0ef7073a0.jpg'),
	(66, 1, 'Hidróxido de potássio', 'g', 1000, '16083884035fde0f338f0fa.jpg'),
	(67, 3, 'Hidróxido de magnésio', 'g', 1550, '16083884345fde0f52d76ce.jpg'),
	(68, 1, 'Hidróxido de sódio', 'g', 2200, '16083884775fde0f7d3cf7f.jpg'),
	(69, 2, 'Hidróxido de sódio, solução', 'ml', 1000, '16083885075fde0f9b97857.jpg');

INSERT INTO `vidrarias` (`id_vidraria`, `id_laboratorio`, `nome`, `quantidade`, `descricao`, `foto`) VALUES
	(1, 1, 'Almofariz com pistilo', 20, 'Equipamento usado para maceração de substâncias sólidas. Empregado em titulações, aquecimento de líquidos e para dissolver substâncias.', '16083792505fddeb7230b5d.jpg'),
	(2, 2, 'Argola', 20, 'Peça de forma anelar, com um braço para fixação a um suporte universal, utilizada no laboratório como suporte de funis e de ampolas de decantação.', '16083792775fddeb8d37815.jpg'),
	(3, 3, 'Bastão de vidro', 15, 'Instrumento feito em vidro alcalino, maciço, utilizado em transportes de líquidos e agitação de soluções. No transporte de líquidos ele é utilizado para não respingar líquidos fora do recipiente.', '16083793065fddebaa133df.jpg'),
	(4, 1, 'Balão de fundo chato 500 ml', 22, 'Os balões de fundo chato e gargalo longo Pyrex® de 500ml são cuidadosamente projetados e fabricados a partir de vidro borosilicato.', '16083794485fddec38c0e57.jpg'),
	(5, 2, 'Balão de fundo chato 1000 ml', 22, 'Os balões de fundo chato e gargalo longo Pyrex® de 1000ml são cuidadosamente projetados e fabricados a partir de vidro borosilicato.', '16083794965fddec684bdee.jpg'),
	(6, 1, 'Balão de destilação 125 ml', 30, 'O balão de destilação de 125ml é fabricado em vidro borossilicato e possui saída lateral com ângulo de 75° a partir do gargalo.', '16083795365fddec909d531.jpg'),
	(7, 2, 'Balão volumétrico 100ml', 20, 'Os balões volumétricos Classe A são fabricados de acordo com as normas. Suas gravações permanentes de lote e menisco na cor branca facilitam a leitura.', '16083795905fddecc6904e6.jpg'),
	(8, 3, 'Béquer 100ml', 10, 'Béquer 100 ml, com bico. É fabricado com espessura de parede uniforme para oferecer o melhor equilíbrio entre resistência ao choque térmico e resistência mecânica.', '16083796425fddecfa57801.jpg'),
	(9, 3, 'Balão volumétrico 250ml', 20, 'Béquer 250 ml, com bico. É fabricado com espessura de parede uniforme para oferecer o melhor equilíbrio entre resistência ao choque térmico e resistência mecânica.', '16083796805fdded20427c8.jpg'),
	(10, 1, 'Bico de Bunsen', 10, 'Este queimador, muito usado no laboratório, é formado por um tubo com orifícios laterais, na base, por onde entra o ar, o qual se vai misturar com o gás que entra através do tubo de borracha.', '16083797265fdded4eebc4f.jpg'),
	(11, 3, 'Bureta graduada com torneira 50ml', 10, 'Tubo cilíndrico graduado, com torneira na extremidade, usado em laboratório para dosear ou dispensar líquidos com precisão.', '16083797915fdded8fc49e7.jpg'),
	(12, 1, 'Cadinho', 20, 'Recipiente pequeno, com forma de pote, que é utilizado para aquecer sólidos a temperaturas bastante elevadas. Estes podem ser feitos de metal ou de cerâmica mas nos laboratórios é mais comum encontrarem-se cadinhos de cerâmica, especialmente de porcelana.', '16083798315fddedb72bc8c.jpg'),
	(13, 1, 'Cápsula de porcelana', 20, 'É utilizada para realizar evaporação de compostos, calcinação, secagem e outras análises. Pode ser utilizada diretamente no fogo ou sobre tela de amianto.', '16083801125fddeed04ee1b.png'),
	(14, 2, 'Coluna de fracionamento', 10, 'Item de laboratório essencial para a destilação de misturas de líquidos para separação de seus componentes em partes, ou frações, baseadas na diferença de volatilidade dos componentes.', '16083801965fddef24a6536.jpg'),
	(15, 3, 'Condensador', 10, 'Tem como finalidade condensar vapores gerados pelo aquecimento de líquidos em processos de destilação simples. É dividido em duas partes: uma onde passa o vapor que condensa e outra onde passa um líquido (normalmente água) resfriado para abaixar a temperatura interna.', '16083802275fddef43249ef.jpg'),
	(16, 1, 'Dessecador', 15, 'Recipiente fechado que contém um agente de secagem chamado dessecante. A tampa é engraxada (normalmente com graxa de silicone) para que feche de forma hermética. É utilizado para guardar substâncias em ambientes com baixo teor de umidade.', '16083802535fddef5da5344.jpg'),
	(17, 3, 'Erlenmeyer 500ml', 5, 'O Erlenmeyer de 500ml é fabricado com material reforçado e possui espessura de parede uniforme para garantir o equilíbrio adequado entre eficiência mecânica e resistência ao choque térmico. A graduação do produto é gravada em esmalte branco permanente.', '16083802905fddef8236384.jpg'),
	(18, 3, 'Espátula ', 10, 'É um utensílio destinado a transferir pequenas porções de substâncias sólidas.. A grande maioria das espátulas utilizadas em laboratório é resistente a ácidos, bases e outros agentes.', '16083803335fddefad0540d.jpg'),
	(19, 3, 'Filtro de Bromo 250 Ml', 17, 'Com principal função de separar uma mistura líquida heterogênea por simples ação da gravidade: o componente líquido mais denso ocupa a região inferior e, portanto, pode ser removido por método dreno (o funil possui um regulador de vazão no fundo que ao abrir, deixa o líquido mais denso fluir.', '16083867775fde08d9269c2.jpg'),
	(20, 2, 'Filtro de Bromo 500 ml', 15, 'Com principal função de separar uma mistura líquida heterogênea por simples ação da gravidade: o componente líquido mais denso ocupa a região inferior e, portanto, pode ser removido por método dreno (o funil possui um regulador de vazão no fundo que ao abrir, deixa o líquido mais denso fluir.', '16083868035fde08f37cc2e.jpg'),
	(21, 1, 'Funil de Buchner', 20, 'Tipo de vidraria de laboratório, consistindo em um funil feito de porcelana e com vários orifícios, como uma peneira. Ele é usado junto com o Kitassato para filtração de mistura a vácuo.', '16083869435fde097f9e3b5.jpg'),
	(22, 2, 'Funil de Haste Longa', 15, 'Utilizado na transferência de líquidos e no processo de filtração com retenção de partículas sólidas.', '16083870035fde09bb64c8f.jpg'),
	(23, 3, 'Garra de Condensador', 15, 'Espécie de braçadeira que prende o condensador ou outras peças, como balões, erlenmeyers e outros à haste do suporte universal.', '16083870725fde0a00db01d.jpg'),
	(24, 1, 'Kitassato 500 ml', 18, 'Utilizado em conjunto com o funil de Büchner em filtrações a vácuo. Compõe a aparelhagem das filtrações a vácuo. Sua saída lateral se conecta a uma trompa de vácuo. É utilizado para uma filtragem mais veloz, e também para secagem de sólidos precipitados.', '16083871675fde0a5f1e9a0.jpg'),
	(25, 3, 'Kitassato 1000 ml', 21, 'Utilizado em conjunto com o funil de Büchner em filtrações a vácuo. Compõe a aparelhagem das filtrações a vácuo. Sua saída lateral se conecta a uma trompa de vácuo. É utilizado para uma filtragem mais veloz, e também para secagem de sólidos precipitados.', '16083871845fde0a70b448b.jpg'),
	(26, 1, 'Papel Filtro', 20, 'Serve para separar sólidos de líquidos. O filtro deve ser utilizado no funil comum.', '16083872475fde0aaf97cdb.jpg'),
	(27, 1, 'Pera', 15, 'Equipamento de laboratório que consiste um dispositivo que, acoplado a uma pipeta, auxilia a retirada de líquidos por sucção.', '16083873385fde0b0a4ce13.jpg'),
	(28, 3, 'Picnômetro de vidro', 17, 'Utilizada na picnometria que possui baixo coeficiente de dilatação.', '16083874315fde0b678d542.jpg'),
	(29, 2, 'Pipeta Graduada 20 ml', 18, 'Instrumento em vidro que permite a medição e transferência de (alíquotas) volumes variáveis de líquidos. É um tubo longo e estreito, aberto nas duas extremidades, marcado com linhas horizontais que constituem uma escala graduada.', '16083875685fde0bf0cb729.jpg'),
	(30, 2, 'Pipeta Graduada 50 ml', 19, 'Instrumento em vidro que permite a medição e transferência de (alíquotas) volumes variáveis de líquidos. É um tubo longo e estreito, aberto nas duas extremidades, marcado com linhas horizontais que constituem uma escala graduada.', '16083891945fde124a6e128.jpg'),
	(31, 1, 'Pipeta Volumétrica 25 ml', 15, 'Instrumento em vidro que permite a medição e transferência rigorosa de volumes de líquidos. É um tubo longo e estreito, com uma zona central mais larga, aberto nas duas extremidades, marcado com uma linha horizontal que indica o volume exato de líquido que pode transferir.', '16083892865fde12a63620a.jpg'),
	(32, 1, 'Pinça Metálica', 18, 'Serve para manipular objetos aquecidos.', '16083895065fde1382c401f.jpg'),
	(33, 3, 'Pinça de Madeira', 18, 'Utilizada para segurar tubos de ensaio em aquecimento, evitando queimaduras nos dedos.', '16083895645fde13bceec72.jpg'),
	(34, 3, 'Pisseta', 18, 'Recipiente de uso laboratorial que armazenam compostos de diversas naturezas. Utilizada para se por água destilada ou água desmineralizada e destina-se a descontaminação, lavagem de materiais ou utensílios de laboratório em geral e também para aplicações em outros recipientes.', '16083896435fde140b61bf7.jpg'),
	(35, 1, 'Placa de Petri', 15, 'É um recipiente cilíndrico, achatado, de vidro ou plástico que os profissionais de laboratório utilizam para a cultura de microorganismos.', '16083897285fde146081b84.jpg'),
	(36, 2, 'Proveta Graduada 500 ml', 25, 'Vidrarias de laboratório graduadas e volumétricas graduada: este equipamento oferece graduações ao longo de sua estrutura que pode possibilitar a sucção das mais diversas quantidades de líquidos.', '16083899475fde153b76f9d.jpg'),
	(37, 2, 'Proveta Graduada 1000 ml', 17, 'Vidrarias de laboratório graduadas e volumétricas graduada: este equipamento oferece graduações ao longo de sua estrutura que pode possibilitar a sucção das mais diversas quantidades de líquidos.', '16083899665fde154e3fabd.jpg'),
	(38, 2, 'Suporte Universal', 19, 'É uma vara metálica vertical fixada numa base metálica estável (retangular ou triangular) e serve para a sustentação de peças de laboratório.', '16083900125fde157c5b96c.jpg'),
	(39, 2, 'Termômetro', 15, 'Utilizado para realizar a medição de temperatura e sua construção baseia-se no uso de grandezas físicas que dependem da variação de temperatura.', '16083900965fde15d09881f.jpg'),
	(40, 3, 'Tubo de Ensaio', 29, 'Recipientes de vidro alongados e cilíndricos, comumente usados em experiências com pouco volume. Podem ser aquecidos no Bico de Bunsen. Geralmente possuem um borda mais grossa na abertura, o que facilita o despejo do seu conteúdo em outro recipiente.', '16083901435fde15ffe875c.jpg'),
	(41, 2, 'Tripé', 16, 'Aro metálico circular suportado por três hastes de ferro (pernas) e utiliza-se para suportar recipientes submetidos a aquecimento por um bico de gás.', '16083902015fde16393ae71.jpg'),
	(42, 2, 'Vidro de Relógio', 17, 'Pequeno recipiente côncavo de vidro com formato circular. Sua principal função é a pesagem de pequenas quantidades de sólidos, entretanto pode ser usado também em análises e evaporações de pequena escala.', '16083902435fde1663871b3.jpg');

-- -----------------------------------------------------


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;