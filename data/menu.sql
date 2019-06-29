create database if not exists bdpa_class;
use bdpa_class;

drop table if exists menu_items;
drop table if exists menu_categories;

create table if not exists menu_categories (
  category_id int(11) not null,
  category_name varchar(255) not null,
  primary key (category_id)
) Engine=InnoDB Default Charset=utf8mb4;

create table if not exists menu_items (
  item_id int(11) not null auto_increment,
  category_id int(11) not null,
  item varchar(255) not null,
  price decimal(8,2) not null default '0.00',
  calories int(11) default 0,
  description text,
  primary key (item_id),
  foreign key (category_id) references menu_categories(category_id) on update cascade on delete restrict
) Engine=InnoDB Default Charset=utf8mb4;

insert into menu_categories (
  category_id,
  category_name
) values
(1,'Appetizers'),
(2,'Entrees'),
(3,'Desserts'),
(4,'Soups and Salads'),
(5,'Beverages'),
(6,'Sides'),
(7,'Specials');

insert into menu_items (
  item_id,
  category_id,
  item,
  price,
  calories,
  description
) values
(null,1,'Artichoke w/Salsa',4.00,60,'Grilled. Served with delictible salsa'),
(null,1,'Chips and Dip',0.00,340,'Our standard fare. Well apointed'),
(null,1,'Crab Cakes',10.00,120,'Nice and easy'),
(null,1,'Lobster dip with Chips',7.00,110,'Our most popular. Shareable!'),
(null,1,'Motzarella Sticks',5.00,40,'Can you guess the cheeses?'),
(null,1,'Muscles',12.00,40,'From our fresh seafood collection'),
(null,1,'Nachos',2.00,100,'Seasoned with special sauce'),
(null,1,'Onion Rings',2.00,90,'Fried in peanut oil and sarvory butter'),
(null,1,'Spinach w/Cheese',3.50,100,'Healthy fair'),
(null,2,'Bone Soup',1.00,30,'Exotic -beautifully made'),
(null,2,'Burritos',4.00,240,'Yeah- we serve these too'),
(null,2,'Crab (Whole or Leg)',10.00,100,'This is what we are known for'),
(null,2,'Crawfish',9.00,90,'The best and freshest catch'),
(null,2,'Empanadas',3.00,120,'Authentic Delictable from South of the Border'),
(null,2,'Enchiladas',4.00,200,'South of the Border fare'),
(null,2,'Fajita',4.00,80,'Whole wheat baked!'),
(null,2,'Lobster',25.00,400,'Awesome entree -made for two'),
(null,2,'Oysters',15.00,200,'Worth writing home about!'),
(null,2,'Quesadillas',4.50,100,'Remember these forever!'),
(null,2,'Salmon',15.00,150,'Healthy choice. Served with fresh vegetables'),
(null,2,'Shrimp',7.00,90,'Just good old gambo shrimp'),
(null,2,'Tacos ~ Taquito',4.00,75,'Best ever'),
(null,2,'Tamale',2.00,100,'Traditional Mesoamerican dish made of masa and banana leaf'),
(null,2,'Tortilla',3.00,40,'Thin unleavened flatbread made from hominy'),
(null,2,'Wraps',1.00,60,'Wheat and spinach wraps'),
(null,3,'Brownies Ice Cream',6.00,200,'Forget the weight loss program!'),
(null,3,'Cake',2.00,300,'You re gonna love it'),
(null,3,'Cheese Cake',8.00,300,'Mama made these'),
(null,3,'Chocolate Cake',2.00,330,'Chocolate cake drizzled in chocolate syrup'),
(null,3,'Churros',5.00,150,'On the lighter side -very nice!'),
(null,5,'Cerveza (Miller; Heineken)',3.00,100,'Smooth draft'),
(null,5,'Coffee',1.50,1,'Brown drink in a cup'),
(null,5,'Fountain Drinks',2.00,150,'Fresh thirst-quenching fountain'),
(null,5,'Lemonade',2.00,100,'Quench your thirst'),
(null,5,'Margarita',3.00,100,'Kick back and relax'),
(null,5,'Orange Juice',1.50,25,'Orange drink in a cup'),
(null,5,'Soda',1.00,400,'Just sugar and water'),
(null,5,'Sweet Tea',2.00,500,'Made in Georgia'),
(null,5,'Tequilla',4.00,120,'Remember prohibition?'),
(null,5,'Vino',3.00,100,'Good times with friends'),
(null,5,'Water',0.00,0,'You know you need this'),
(null,6,'Broccoli',1.50,10,'Smart choices start here'),
(null,6,'French Fries',1.00,200,'Who said dinner had to be boring?'),
(null,6,'Mashed Potato',1.00,300,'A little bit of butter -some salt and..'),
(null,6,'Rice',1.00,300,'Choice of brown or white'),
(null,6,'Yams',20.00,500,'Candied with sweet potatoes; brown sugar; cinnamon'),
(null,7,'Chicken Tacos',4.00,225,'Tacos with chicken'),
(null,7,'Wings',8.29,550,'Wings doused in buffalo sauce');

