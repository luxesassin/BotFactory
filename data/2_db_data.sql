-- COMP4711 Team Durian
-- BotFactory data

-- Bots data
INSERT INTO Bots(model, composition, image) VALUES('A','A10001,A20001,A30001','a.jpg');
INSERT INTO Bots(model, composition, image) VALUES('B','B10001,B20001,B30001','b.jpg');
INSERT INTO Bots(model, composition, image) VALUES('C','C10001,C20001,C30001','c.jpg');
INSERT INTO Bots(model, composition, image) VALUES('M','M10001,M20001,M30001','m.jpg');
INSERT INTO Bots(model, composition, image) VALUES('R','R10001,R20001,R30001','r.jpg');
INSERT INTO Bots(model, composition, image) VALUES('W','W10001,W20001,W30001','w.jpg');

-- Parts data
INSERT INTO Parts(code, ca, builtAt, builtDate, image) VALUES('A1','A10001','BotFactory',NOW(),'a1.jpg');
INSERT INTO Parts(code, ca, builtAt, builtDate, image) VALUES('A2','A20001','BotFactory',NOW(),'a2.jpg');
INSERT INTO Parts(code, ca, builtAt, builtDate, image) VALUES('A3','A30001','BotFactory',NOW(),'a3.jpg');
INSERT INTO Parts(code, ca, builtAt, builtDate, image) VALUES('B1','B10001','BotFactory',NOW(),'b1.jpg');
INSERT INTO Parts(code, ca, builtAt, builtDate, image) VALUES('B2','B20001','BotFactory',NOW(),'b2.jpg');
INSERT INTO Parts(code, ca, builtAt, builtDate, image) VALUES('B3','B30001','BotFactory',NOW(),'b3.jpg');
INSERT INTO Parts(code, ca, builtAt, builtDate, image) VALUES('C1','C10001','BotFactory',NOW(),'c1.jpg');
INSERT INTO Parts(code, ca, builtAt, builtDate, image) VALUES('C2','C20001','BotFactory',NOW(),'c2.jpg');
INSERT INTO Parts(code, ca, builtAt, builtDate, image) VALUES('C3','C30001','BotFactory',NOW(),'c3.jpg');

-- History data
INSERT INTO History (transId, transDate, type, amount, detail) 
    VALUES('T1700001',NOW(),'0','100.00','Purchased 10 boxes of parts');
INSERT INTO History(transId, transDate, type, amount, detail) 
    VALUES('T1700002',NOW(),'0','200.00','Purchased 20 boxes of parts');
INSERT INTO History(transId, transDate, type, amount, detail) 
    VALUES('T1700003',NOW(),'1','150.00','Shipments of 8 bots');
INSERT INTO History(transId, transDate, type, amount, detail) 
    VALUES('T1700004',NOW(),'1','80.00','Shipments of 5 bots');
INSERT INTO History(transId, transDate, type, amount, detail) 
    VALUES('T1700005',NOW(),'1','130.00','Shipments of 7 bots');
INSERT INTO History(transId, transDate, type, amount, detail) 
    VALUES('T1700006',NOW(),'2','40.00','Returned 8 parts');

              


