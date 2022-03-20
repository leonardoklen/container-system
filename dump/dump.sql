use container_system;

CREATE TABLE conteiner (
  numero_conteiner varchar(11) PRIMARY KEY NOT NULL,
  cliente varchar(150) NOT NULL,
  tipo integer not null,
  status varchar(50) not null,
  categoria varchar(50) not null,
  data_hora_inclusao datetime not null default now()
);

CREATE TABLE movimentacoes (
  numero_movimentacao integer PRIMARY KEY NOT NULL AUTO_INCREMENT,
  numero_conteiner varchar(11) not null,
  tipo varchar(150) NOT NULL,
  data_inicio date not null,
  hora_inicio time not null,
  data_fim date not null,
  hora_fim time not null,
  data_hora_inclusao datetime not null default now(),
  CONSTRAINT fk_Movimentacoes_Container
    FOREIGN KEY (numero_conteiner)
    REFERENCES conteiner (numero_conteiner)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION
);



