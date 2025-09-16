USE my_guitar_shop;
INSERT INTO categories (categoryName) VALUES ('Guitars'),('Basses'),('Drums');
INSERT INTO products (categoryID, productCode, productName, listPrice) VALUES
((SELECT categoryID FROM categories WHERE categoryName='Guitars'),'strat','Fender Stratocaster',1199.00),
((SELECT categoryID FROM categories WHERE categoryName='Guitars'),'lpstd','Gibson Les Paul Standard',2499.00),
((SELECT categoryID FROM categories WHERE categoryName='Basses'),'jazz','Fender Jazz Bass',1299.00),
((SELECT categoryID FROM categories WHERE categoryName='Drums'),'dwkit','DW Collector Series Kit',3999.00);
