INSERT INTO users (username, email, phone_number, address, role) VALUES
('JohnDoe', 'john@example.com', '1234567890', '123 Main St, Cityville', 'admin'),
('JaneSmith', 'jane@example.com', '9876543210', '456 Elm St, Townsville', 'user'),
('AliceBrown', 'alice@example.com', '5678901234', '789 Oak St, Villagetown', 'user'),
('BobWhite', 'bob@example.com', '3456789012', '101 Pine St, Hamletburg', 'user'),
('CharlieGreen', 'charlie@example.com', '2345678901', '202 Birch St, Smallville', 'user'),
('DaisyBlue', 'daisy@example.com', '6789012345', '303 Cedar St, Bigcity', 'admin'),
('EveYellow', 'eve@example.com', '8901234567', '404 Maple St, Riverside', 'user'),
('FrankBlack', 'frank@example.com', '1238904567', '505 Spruce St, Hilltown', 'user'),
('GracePurple', 'grace@example.com', '4567890123', '606 Willow St, Lakeside', 'admin'),
('HankOrange', 'hank@example.com', '7890123456', '707 Cherry St, Mountainview', 'user');

INSERT INTO orders (user_id, total_price) VALUES
(1, 150.50),
(2, 85.75),
(3, 42.00),
(4, 120.25),
(5, 97.80),
(6, 60.00),
(7, 190.90),
(8, 34.20),
(9, 240.15),
(10, 15.00);

INSERT INTO categories (name, description) VALUES
('Bread', 'Freshly baked bread of various types.'),
('Cakes', 'Delicious cakes for all occasions.'),
('Pastries', 'Tasty pastries with different fillings.'),
('Cookies', 'Crunchy and soft cookies in multiple flavors.'),
('Pies', 'Sweet and savory pies made with fresh ingredients.'),
('Sandwiches', 'Quick bites made to order.'),
('Drinks', 'Hot and cold beverages.'),
('Snacks', 'Light snacks for any time of the day.'),
('Vegan', 'Plant-based and vegan-friendly options.'),
('Gluten-Free', 'Specialized gluten-free products.');

INSERT INTO products (name, description, price, image, quantity, ingredients, offers, rate, category_id, category_name) VALUES
('Whole Wheat Bread', 'Healthy whole wheat bread.', 3.50, JSON_ARRAY('wheat_bread_1.jpg', 'wheat_bread_2.jpg', 'wheat_bread_3.jpg', 'wheat_bread_4.jpg', 'wheat_bread_5.jpg'), 50, 'Wheat, water, yeast, salt', TRUE, 5, 1, 'Bread'),
('Chocolate Cake', 'Rich chocolate layered cake.', 25.00, JSON_ARRAY('chocolate_cake_1.jpg', 'chocolate_cake_2.jpg', 'chocolate_cake_3.jpg', 'chocolate_cake_4.jpg', 'chocolate_cake_5.jpg'), 30, 'Flour, sugar, cocoa, eggs', FALSE, 4, 2, 'Cakes'),
('Croissant', 'Buttery and flaky croissant.', 2.00, JSON_ARRAY('croissant_1.jpg', 'croissant_2.jpg', 'croissant_3.jpg', 'croissant_4.jpg', 'croissant_5.jpg'), 100, 'Flour, butter, yeast', TRUE, 5, 3, 'Pastries'),
('Oatmeal Cookies', 'Crunchy oatmeal cookies.', 1.50, JSON_ARRAY('oatmeal_cookies_1.jpg', 'oatmeal_cookies_2.jpg', 'oatmeal_cookies_3.jpg', 'oatmeal_cookies_4.jpg', 'oatmeal_cookies_5.jpg'), 70, 'Oats, sugar, butter', FALSE, 4, 4, 'Cookies'),
('Apple Pie', 'Sweet apple pie.', 15.00, JSON_ARRAY('apple_pie_1.jpg', 'apple_pie_2.jpg', 'apple_pie_3.jpg', 'apple_pie_4.jpg', 'apple_pie_5.jpg'), 40, 'Apples, flour, sugar', TRUE, 5, 5, 'Pies'),
('Ham Sandwich', 'Classic ham sandwich.', 5.00, JSON_ARRAY('ham_sandwich_1.jpg', 'ham_sandwich_2.jpg', 'ham_sandwich_3.jpg', 'ham_sandwich_4.jpg', 'ham_sandwich_5.jpg'), 60, 'Bread, ham, cheese', FALSE, 3, 6, 'Sandwiches'),
('Latte', 'Creamy latte.', 4.50, JSON_ARRAY('latte_1.jpg', 'latte_2.jpg', 'latte_3.jpg', 'latte_4.jpg', 'latte_5.jpg'), 100, 'Milk, coffee', FALSE, 4, 7, 'Drinks'),
('Chips', 'Salted potato chips.', 1.20, JSON_ARRAY('chips_1.jpg', 'chips_2.jpg', 'chips_3.jpg', 'chips_4.jpg', 'chips_5.jpg'), 150, 'Potatoes, oil, salt', FALSE, 4, 8, 'Snacks'),
('Vegan Brownie', 'Delicious vegan brownie.', 3.00, JSON_ARRAY('vegan_brownie_1.jpg', 'vegan_brownie_2.jpg', 'vegan_brownie_3.jpg', 'vegan_brownie_4.jpg', 'vegan_brownie_5.jpg'), 50, 'Flour, cocoa, plant-based milk', TRUE, 5, 9, 'Vegan'),
('Gluten-Free Bread', 'Soft gluten-free bread.', 4.00, JSON_ARRAY('gf_bread_1.jpg', 'gf_bread_2.jpg', 'gf_bread_3.jpg', 'gf_bread_4.jpg', 'gf_bread_5.jpg'), 30, 'Rice flour, water, yeast', TRUE, 5, 10, 'Gluten-Free');

INSERT INTO order_products (order_id, product_id) VALUES
(1, 1),
(1, 2),
(2, 3),
(3, 4),
(4, 5),
(5, 6),
(6, 7),
(7, 8),
(8, 9),
(9, 10);

INSERT INTO payments (card_number, cvv, name_on_card, user_id) VALUES
('1111222233334444', '123', 'John Doe', 1),
('5555666677778888', '456', 'Jane Smith', 2),
('9999000011112222', '789', 'Alice Brown', 3),
('3333444455556666', '321', 'Bob White', 4),
('7777888899990000', '654', 'Charlie Green', 5),
('1111333344445555', '987', 'Daisy Blue', 6),
('2222444466668888', '234', 'Eve Yellow', 7),
('4444555566667777', '567', 'Frank Black', 8),
('5555666677778888', '890', 'Grace Purple', 9),
('6666777788889999', '012', 'Hank Orange', 10);
