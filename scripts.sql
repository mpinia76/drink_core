############### 29/04/2019 ##############################
CREATE TABLE drink_devolucion_venta (
	oid INT AUTO_INCREMENT NOT NULL, 
	venta_oid INT DEFAULT NULL, 
	producto_oid INT DEFAULT NULL, 
	precioUnitario DOUBLE PRECISION NOT NULL, 
	costo DOUBLE PRECISION NOT NULL, 
	cantidad INT NOT NULL, 
	INDEX IDX_6D15B1FC3CD6C0FA (venta_oid), 
	INDEX IDX_6D15B1FC2388A37D (producto_oid), 
	PRIMARY KEY(oid)
	) 
	DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;

     ALTER TABLE drink_devolucion_venta 
     	ADD CONSTRAINT FK_6D15B1FC3CD6C0FA FOREIGN KEY (venta_oid) REFERENCES drink_venta (oid);
     	
     ALTER TABLE drink_devolucion_venta 
     	ADD CONSTRAINT FK_6D15B1FC2388A37D FOREIGN KEY (producto_oid) REFERENCES drink_producto (oid);
     	
     ALTER TABLE drink_venta ADD montoDevolucion DOUBLE PRECISION DEFAULT NULL;
     
############### 28/08/2019 ##############################  
CREATE TABLE drink_combo (
	oid INT AUTO_INCREMENT NOT NULL, 
	precio DOUBLE PRECISION DEFAULT NULL, 
	fecha DATETIME NOT NULL, 
	nombre VARCHAR(50) NOT NULL, 
	PRIMARY KEY(oid)
	) 
	DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
	
CREATE TABLE drink_producto_combo (
	oid INT AUTO_INCREMENT NOT NULL, 
	combo_oid INT DEFAULT NULL, 
	producto_oid INT DEFAULT NULL, 
	precioUnitario DOUBLE PRECISION NOT NULL, 
	cantidad INT NOT NULL, 
	INDEX IDX_12ABA96F10169E76 (combo_oid), 
	INDEX IDX_12ABA96F2388A37D (producto_oid), 
	PRIMARY KEY(oid)
	) 
	DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
     
ALTER TABLE drink_producto_combo 
	ADD CONSTRAINT FK_12ABA96F10169E76 FOREIGN
	KEY (combo_oid) REFERENCES drink_combo (oid);
	
ALTER TABLE drink_producto_combo 
	ADD CONSTRAINT FK_12ABA96F2388A37D FOREIGN
	KEY (producto_oid) REFERENCES drink_producto (oid);
	
ALTER TABLE drink_detalle_venta 
	ADD combo_oid INT DEFAULT NULL;

	
	

     
     

     ALTER TABLE drink_detalle_venta ADD CONSTRAINT FK_2C70777010169E76 FOREIGN
KEY (combo_oid) REFERENCES drink_combo (oid);
     CREATE INDEX IDX_2C70777010169E76 ON drink_detalle_venta (combo_oid);

############### 11/02/2020 ##############################  
ALTER TABLE drink_venta ADD montoActualizado DOUBLE PRECISION DEFAULT NULL;

INSERT INTO `cose_drink`.`drink_concepto_movimiento` (`nombre`) VALUES ('Actualización');

  CREATE TABLE drink_actualizacion (
  	oid INT AUTO_INCREMENT NOT NULL, 
  	cliente_oid INT DEFAULT NULL, 
  	user_oid INT DEFAULT NULL, 
  	fechaHora DATETIME NOT NULL, 
  	monto DOUBLE PRECISION NOT NULL, 
  	observaciones VARCHAR(255) DEFAULT NULL, 
  	INDEX IDX_5AC48D77354C5A1F (cliente_oid), 
  	INDEX IDX_5AC48D77A93C412B (user_oid), 
  	PRIMARY KEY(oid)
  ) 
  DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
     ALTER TABLE drink_actualizacion ADD CONSTRAINT FK_5AC48D77354C5A1F FOREIGN KEY (cliente_oid) REFERENCES drink_cliente (oid);
     ALTER TABLE drink_actualizacion ADD CONSTRAINT FK_5AC48D77A93C412B FOREIGN KEY (user_oid) REFERENCES security_user (oid);
     ALTER TABLE drink_detalle_venta CHANGE stockActualizado stockActualizado TINYINT(1) NOT NULL;
     ALTER TABLE drink_devolucion_venta CHANGE stockActualizado stockActualizado TINYINT(1) NOT NULL;
     ALTER TABLE drink_movimiento_caja ADD actualizacion_oid INT DEFAULT NULL;
     ALTER TABLE drink_movimiento_caja ADD CONSTRAINT FK_CE7EF47C1F100B0 FOREIGN KEY (actualizacion_oid) REFERENCES drink_actualizacion (oid);
     CREATE INDEX IDX_CE7EF47C1F100B0 ON drink_movimiento_caja (actualizacion_oid);
     
############### 21/07/2020 ##############################  

     CREATE TABLE drink_vendedor (
oid INT AUTO_INCREMENT NOT NULL, 
comision DOUBLE PRECISION DEFAULT NULL, 
nombre VARCHAR(255) NOT NULL, 
PRIMARY KEY(oid)
) 
DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
    
     
     ALTER TABLE drink_venta 
	  ADD vendedor_oid INT DEFAULT NULL, 
	  ADD comision DOUBLE PRECISION DEFAULT NULL;
     ALTER TABLE drink_venta 
	  ADD CONSTRAINT FK_713B3FF0ECC71225 FOREIGN KEY (vendedor_oid) REFERENCES drink_vendedor (oid);
     CREATE INDEX IDX_713B3FF0ECC71225 ON drink_venta (vendedor_oid);
     
     
 UPDATE `drink_venta` SET `vendedor_oid`='1', `comision`='0';

INSERT INTO `drink_concepto_movimiento` (`nombre`) VALUES ('Comisión Venta');
INSERT INTO `drink_concepto_movimiento` (`nombre`) VALUES ('Anulación Comisión Venta');

     ALTER TABLE drink_presupuesto 
     ADD vendedor_oid INT DEFAULT NULL;
     
     ALTER TABLE drink_presupuesto 
     ADD CONSTRAINT FK_35FFE69CECC71225 FOREIGN KEY (vendedor_oid) REFERENCES drink_vendedor (oid);
     CREATE INDEX IDX_35FFE69CECC71225 ON drink_presupuesto (vendedor_oid);
     

UPDATE `drink_presupuesto` SET `vendedor_oid`='1';

     


     ALTER TABLE drink_producto 
     ADD porcentajeGanancia2 DOUBLE PRECISION DEFAULT NULL;
     
   

     ALTER TABLE drink_pack 
     	ADD porcentajeGanancia DOUBLE PRECISION DEFAULT NULL, 
     	ADD porcentajeGanancia2 DOUBLE PRECISION DEFAULT NULL;
     
    

ALTER TABLE drink_vendedor 
	ADD mail VARCHAR(255) NOT NULL, 
	ADD telefono VARCHAR(255) DEFAULT NULL, 
	ADD direccion VARCHAR(255) DEFAULT NULL, 
	ADD mayorista TINYINT(1) NOT NULL;

############################################13/08/2020##########################################

ALTER TABLE drink_cliente ADD tipoCliente INT DEFAULT NULL;


UPDATE drink_cliente SET tipoCliente=1;

############################################27/08/2020##########################################

 CREATE TABLE drink_detalle_pedido (
 	oid INT AUTO_INCREMENT NOT NULL, 
 	pedido_oid INT DEFAULT NULL, 
 	producto_oid INT DEFAULT NULL, 
 	precioUnitario DOUBLE PRECISION NOT NULL, 
 	descuento DOUBLE PRECISION NOT NULL, 
 	cantidad INT NOT NULL, 
 	INDEX IDX_8F4B5510EFBAC5E4 (pedido_oid), 
 	INDEX IDX_8F4B55102388A37D (producto_oid), 
 	PRIMARY KEY(oid)
 	) 
 	DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
     
CREATE TABLE drink_pedido (
     oid INT AUTO_INCREMENT NOT NULL, 
     proveedor_oid INT DEFAULT NULL, 
     user_oid INT DEFAULT NULL, 
     fechaHora DATETIME NOT NULL, 
     monto DOUBLE PRECISION NOT NULL, 
     montoDebe DOUBLE PRECISION NOT NULL, 
     estado INT NOT NULL, 
     observaciones VARCHAR(255) DEFAULT NULL, 
     fechaHoraRecibido DATETIME DEFAULT NULL, 
     INDEX IDX_62AE9D78E03958E8 (proveedor_oid), 
     INDEX IDX_62AE9D78A93C412B (user_oid), 
     PRIMARY KEY(oid)
    ) 
    DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
     
 CREATE TABLE drink_proveedor (
     oid INT AUTO_INCREMENT NOT NULL, 
     localidad_oid INT DEFAULT NULL, 
     nombre VARCHAR(255) NOT NULL, 
     tipoDocumento INT DEFAULT NULL, 
     documento VARCHAR(10) NOT NULL, 
     razonSocial VARCHAR(255) DEFAULT NULL, 
     cuit VARCHAR(255) DEFAULT NULL, 
     condicionIva INT DEFAULT NULL, 
     sexo INT DEFAULT NULL, 
     mail VARCHAR(255) NOT NULL, 
     telefono VARCHAR(255) DEFAULT NULL, 
     celular VARCHAR(255) DEFAULT NULL, 
     laboral VARCHAR(255) DEFAULT NULL, 
     direccion VARCHAR(255) DEFAULT NULL, 
     nacimiento DATE DEFAULT NULL, 
     fecha DATETIME NOT NULL, 
     ultModificacion DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, 
     observaciones LONGTEXT DEFAULT NULL, 
     cuentaCorriente_oid INT DEFAULT NULL, 
     INDEX IDX_97B68BF6BDFD03CB (localidad_oid), 
     INDEX IDX_97B68BF66E6F7ED4 (cuentaCorriente_oid), 
     PRIMARY KEY(oid)
     ) 
     DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
     
     ALTER TABLE drink_detalle_pedido ADD CONSTRAINT FK_8F4B5510EFBAC5E4 FOREIGN KEY (pedido_oid) REFERENCES drink_pedido (oid);
     ALTER TABLE drink_detalle_pedido ADD CONSTRAINT FK_8F4B55102388A37D FOREIGN KEY (producto_oid) REFERENCES drink_producto (oid);
     ALTER TABLE drink_pedido ADD CONSTRAINT FK_62AE9D78E03958E8 FOREIGN KEY (proveedor_oid) REFERENCES drink_proveedor (oid);
     ALTER TABLE drink_pedido ADD CONSTRAINT FK_62AE9D78A93C412B FOREIGN KEY (user_oid) REFERENCES security_user (oid);
     ALTER TABLE drink_proveedor ADD CONSTRAINT FK_97B68BF6BDFD03CB FOREIGN KEY (localidad_oid) REFERENCES drink_localidad (oid);
     ALTER TABLE drink_proveedor ADD CONSTRAINT FK_97B68BF66E6F7ED4 FOREIGN KEY (cuentaCorriente_oid) REFERENCES drink_cuenta_corriente (oid);
     
     INSERT INTO `drink_concepto_movimiento` (`nombre`) VALUES ('Pedido');
     INSERT INTO `drink_concepto_movimiento` (`nombre`) VALUES ('Anulación Pedido');

     ALTER TABLE drink_movimiento_caja ADD pedido_oid INT DEFAULT NULL;
     ALTER TABLE drink_movimiento_caja ADD CONSTRAINT FK_CE7EF47CEFBAC5E4 FOREIGN KEY (pedido_oid) REFERENCES drink_pedido (oid);
     CREATE INDEX IDX_CE7EF47CEFBAC5E4 ON drink_movimiento_caja (pedido_oid);
     