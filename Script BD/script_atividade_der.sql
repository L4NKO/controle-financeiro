insert into tb_acesso
(login, senha, status)
values
('empresa_a', 'senhaA', 1)

select * from tb_acesso

insert into tb_acesso
(login, senha, status)
values
('func_empresa_a', 'senhaFuncA', 1)

select * from tb_acesso

insert into tb_empresa
(nome, acesso_id)
values
('Modelar', 1)

select * from tb_empresa

insert into tb_cargo
(nome_cargo)
values
('Programador')

select * from tb_cargo

insert into tb_funcionario
(nome, data_admissao, empresa_id, acesso_id)
values
('Roberto', '2023-10-24', 2, 1)

select * from tb_funcionario

insert into tb_cargo_funcionario
(id_cargo, id_funcionario, data_inicio)
values
(1, 11, '2023-10-23')

select * from tb_cargo_funcionario

insert into tb_pais
(nome_pais)
values
('Brasil')

select * from tb_pais

insert into tb_estado
(nome_estado, sigla_estado, id_pais)
values
('Parana', 'PR', 1)

select * from tb_estado

insert into tb_cidade
(nome_cidade, id_estado)
values
('Londrina', 1)

select * from tb_cidade

insert into tb_endereco
(rua, bairro, cep, id_funcionario, id_cidade)
values
('Rua das Flores', 'Jardins', '86011-565', 11, 1)

select * from tb_endereco

insert into tb_cliente
(nome, data_nascimento, id_funcionario)
values
('Claudio', '1998-10-22', 11)

select * from tb_cliente

insert into tb_endereco
(rua, bairro, cep, id_cliente, id_cidade)
values
('Rua Mondias', 'Alto Porto', '86145-555', 1, 1)