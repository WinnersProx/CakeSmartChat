INSERT INTO Client(ClId,ClName,ClTelephone) VALUES('0021','Winner','0798755355');
INSERT INTO Client(ClId,ClName,ClTelephone) VALUES('0022','vainqueur','0798756255');
INSERT INTO Client(ClId,ClName,ClTelephone) VALUES('0023','skbb','0798752955');
INSERT INTO Client(ClId,ClName,ClTelephone) VALUES('0024','WinnersPro','0798752455');
INSERT INTO Client(ClId,ClName,ClTelephone) VALUES('0025','Mwiza','0798752355');
INSERT INTO Client(ClId,ClName,ClTelephone) VALUES('0026','Kabasha','0798769555');
INSERT INTO Client(ClId,ClName,ClTelephone) VALUES('0027','Christian','0798395555');
INSERT INTO Client(ClId,ClName,ClTelephone) VALUES('0028','Vainqueur','0798738555');
INSERT INTO Client(ClId,ClName,ClTelephone) VALUES('0029','Bbkabs','0798755255');
INSERT INTO Client(ClId,ClName,ClTelephone) VALUES('0120','SkBoss','0798755235');

/*insert s into the account */

INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('001','001','001','1/11/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('002','001','0021','3/11/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('003','005','0022','2/08/2017');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('004','004','0023','1/1/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('005','004','0025','2/2/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('006','001','0023','1/06/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('007','005','0025','1/06/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('008','003','0022','2/06/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('009','005','0024','1/06/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('010','004','0027','2/1/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('011','006','0026','2/11/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('012','003','0028','2/07/2017');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('013','002','0029','1/1/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('014','007','0120','2/1/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('015','009','0021','2/1/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('016','008','0022','1/12/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('017','004','0026','1/11/2018');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('018','006','0025','3/07/2017');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('019','002','0023','1/02/2017');
INSERT INTO Account(ACCNum,BId,ClId,DateOpen) VALUES('020','001','0027','1/1/2018');


/*for the first user */
INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcoment) 
VALUES('001', '001','001', '02/01/2018', 20500, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcoment) 
VALUES('002', '001','001', '03/01/2018', 22500, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcoment) 
VALUES('003', '001','001', '04/01/2018', 23500, 'Withdraw', 'moneyWd');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcoment) 
VALUES('004', '001','001', '06/01/2018', 23500, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcoment) 
VALUES('005', '001','001', '06/01/2018', 20000, 'Withdraw', 'moneyWd');

/*---Now for the second user ---*/
INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('006', '005','003', '09/10/2017', 20500, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('007', '005','003', '02/01/2018', 22500, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('008', '005','003', '04/01/2018', 23500, 'Withdraw', 'moneyWd');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('009', '005','003', '06/01/2018', 23500, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('010', '005','003', '07/01/2018', 20000, 'Withdraw', 'moneyWd');

/*---Now for the third account now ---*/
INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('011', '003','008', '02/09/2017', 20200, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('012', '003','008', '02/10/2018', 22510, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('013', '003','008', '02/11/2018', 23530, 'Withdraw', 'moneyWd');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('014', '003','008', '03/12/2018', 23510, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('015', '003','008', '03/12/2018', 18000, 'Withdraw', 'moneyWd');
/*Now for the fourth one */
INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('016', '004','004', '02/01/2018', 35200, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('017', '004','004', '03/03/2018', 38510, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('018', '004','004', '04/05/2018', 32530, 'Withdraw', 'moneyWd');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('019', '004','004', '05/06/2018', 23514, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('020', '004','004', '07/08/2018', 18250, 'Deposit', 'moneyDp');
/*Now the fifth one concerning  (ACCNum,BId,ClId,DateOpen) VALUES('009','005','0024','1/06/2018')*/
INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('021', '005','009', '02/07/2018', 30200, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('022', '005','009', '03/08/2018', 32510, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('023', '005','009', '03/08/2018', 22530, 'Withdraw', 'moneyWd');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('024', '005','009', '04/09/2018', 22514, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('025', '005','009', '04/09/2018', 19250, 'Deposit', 'moneyDp');

/*Now the fifth one concerning  (ACCNum,BId,ClId,DateOpen) VALUES('014','007','0120','2/1/2018')*/
INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('026', '007','014', '03/03/2018', 35000, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('027', '007','014', '04/05/2018', 32010, 'Withdraw', 'moneyWd');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('028', '007','014', '03/06/2018', 20530, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('029', '007','014', '03/06/2018', 21514, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('030', '007','014', '05/07/2018', 22250, 'Deposit', 'moneyDp');
/*Now the sixthth one concerning  (ACCNum,BId,ClId,DateOpen) VALUES('012','003','0028','2/07/2017');*/
INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('031', '003','012', '09/10/2017', 20500, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('032', '003','012', '02/01/2018', 22500, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('033', '003','012', '04/01/2018', 23500, 'Withdraw', 'moneyWd');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('034', '003','012', '06/01/2018', 23500, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('035', '003','012', '07/01/2018', 20000, 'Withdraw', 'moneyWd');
/*Now the seventh one concerning  (ACCNum,BId,ClId,DateOpen) VALUES('019','002','0023','1/02/2017')*/
INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('036', '002','019', '02/07/2018', 30200, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('037', '002','019', '03/08/2018', 32510, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('038', '002','019', '03/08/2018', 22530, 'Withdraw', 'moneyWd');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('039', '002','019', '04/09/2018', 22514, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('040', '002','019', '04/09/2018', 19250, 'Deposit', 'moneyDp');
/*Now the eigth one concerning  (ACCNum,BId,ClId,DateOpen) VALUES('006','001','0023','1/06/2018')*/
INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('041', '001','006', '02/07/2018', 30200, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('042', '001','006', '03/08/2018', 32510, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('043', '001','006', '03/08/2018', 22530, 'Withdraw', 'moneyWd');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('044', '001','006', '04/09/2018', 22514, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('045', '001','006', '04/09/2018', 19250, 'Deposit', 'moneyDp');
/*Now the eigth one concerning  (ACCNum,BId,ClId,DateOpen) VALUES('013','002','0029','1/1/2018')*/
INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('046', '002','013', '02/01/2018', 35200, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('047', '002','013', '03/03/2018', 38510, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('048', '002','013', '04/05/2018', 32530, 'Withdraw', 'moneyWd');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('049', '002','013', '05/06/2018', 23514, 'Deposit', 'moneyDp');

INSERT INTO Transaction(TId,BId,ACCNum,Tdate,TAmount,Ttype,Tcomment) 
VALUES('050', '002','013', '07/08/2018', 18250, 'Deposit', 'moneyDp');