create table shop (id integer primary key, name nvarchar, address nvarchar);
insert into shop(name, address) values("Пятёрочка 1010", "Москва Тверская 10");
insert into shop(name, address) values("Пятёрочка 1011", "Москва Тверская 11");
insert into shop(name, address) values("Пятёрочка 1012", "Москва Тверская 12");
insert into shop(name, address) values("Пятёрочка 1013", "Москва Тверская 13");
insert into shop(name, address) values("Пятёрочка 1014", "Москва Тверская 14");
select * from shop;

create table product (id integer primary key, shop_id integer, name nvarchar, price float, count integer,
                  foreign key (shop_id) references shop(id)
                 );
insert into product(shop_id, name, price, count) values(1, "Пиво Очаково", 80.50, 5);
insert into product(shop_id, name, price, count) values(2, "Водка Столичная", 150.00, 1);
insert into product(shop_id, name, price, count) values(3, "Шампанское Советское", 350.00, 2);
insert into product(shop_id, name, price, count) values(4, "Виски Шотландские", 900.80, 3);
insert into product(shop_id, name, price, count) values(4, "Портвейн 777", 300.00, 3);

create table user (id integer primary key, name nvarchar, phone varchar);
insert into user(name, phone) values("Покупатель Анна", "+79261528877");
insert into user(name, phone) values("Продавец Вова", "+79168889944");
insert into user(name, phone) values("Продавец Николай", "+79168889955");
insert into user(name, phone) values("Продавец Арик", "+79168889955");
insert into user(name, phone) values("Покупатель Волшебница", "+79167777777");

create table "order" (id integer primary key, created_at datetime, shop_id integer, customer_id integer, seller_id integer,
                      foreign key (shop_id) references shop(id),
                      foreign key (customer_id) references user(id),
                      foreign key (seller_id) references user(id)
                     );
insert into "order"(created_at, shop_id, customer_id, seller_id) values('2024-10-01T15:15:15', 1, 1, 2);
insert into "order"(created_at, shop_id, customer_id, seller_id) values('2024-10-02T08:00:00', 2, 1, 2);
insert into "order"(created_at, shop_id, customer_id, seller_id) values('2024-11-02T08:00:00', 3, 4, 1);
insert into "order"(created_at, shop_id, customer_id, seller_id) values('2024-12-02T08:00:00', 3, 4, 2);
insert into "order"(created_at, shop_id, customer_id, seller_id) values('2024-11-07T08:00:00', 3, 4, 3);

create table order_position (id integer primary key, order_id integer, product_id integer, quantity integer,
                             foreign key (order_id) references "order"(id),
                             foreign key (product_id) references product(id));
insert into order_position(order_id, product_id, quantity) values(1, 1, 2);
insert into order_position(order_id, product_id, quantity) values(1, 2, 3);
insert into order_position(order_id, product_id, quantity) values(1, 3, 1);
insert into order_position(order_id, product_id, quantity) values(2, 1, 5);
insert into order_position(order_id, product_id, quantity) values(2, 4, 9);