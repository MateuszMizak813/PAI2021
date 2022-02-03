create sequence type_id_seq
    as integer;

alter sequence type_id_seq owner to czkcrjzjqzpgwx;

create table roles
(
    id        serial
        constraint roles_pk
            primary key,
    role_name varchar(100) not null
);

alter table roles
    owner to czkcrjzjqzpgwx;

create table users
(
    id       serial
        constraint users_pk
            primary key,
    name     varchar(100)          not null,
    email    varchar(255)          not null,
    password varchar(255)          not null,
    enabled  boolean default false not null,
    role_id  integer default 2     not null
        constraint users_roles___fk
            references roles
            on update cascade on delete cascade
);

alter table users
    owner to czkcrjzjqzpgwx;

create unique index users_id_uindex
    on users (id);

create unique index roles_id_uindex
    on roles (id);

create table tags
(
    id       serial
        constraint tags_pk
            primary key,
    tag_name varchar(100) default 'default'::character varying not null
);

alter table tags
    owner to czkcrjzjqzpgwx;

create unique index tags_id_uindex
    on tags (id);

create table types
(
    id        integer default nextval('type_id_seq'::regclass) not null,
    type_name varchar(100)                                     not null
);

alter table types
    owner to czkcrjzjqzpgwx;

alter sequence type_id_seq owned by types.id;

create unique index type_id_uindex
    on types (id);

create table additional_info
(
    id      serial
        constraint additional_info_pk
            primary key,
    type_id integer not null
        constraint additional_info_types___fk
            references types (id)
            on update cascade on delete cascade,
    pages   integer,
    length  integer,
    seasons integer
);

alter table additional_info
    owner to czkcrjzjqzpgwx;

create unique index additional_info_id_uindex
    on additional_info (id);

create table library
(
    id                 serial
        constraint library_pk
            primary key,
    additional_info_id integer      not null
        constraint library_additional_info___fk
            references additional_info
            on update cascade on delete cascade,
    original_title     varchar(255) not null,
    pl_title           varchar(255),
    release_date       date,
    img                varchar(255) default 'placeholder.img'::character varying,
    description        text
);

alter table library
    owner to czkcrjzjqzpgwx;

create unique index library_id_uindex
    on library (id);

create table users_library
(
    user_id    integer not null
        constraint users_users_library___fk
            references users
            on update cascade on delete cascade,
    library_id integer not null
        constraint users_library_library___fk
            references library
            on update cascade on delete cascade,
    rating     integer,
    add_date   date    not null,
    status     integer
);

alter table users_library
    owner to czkcrjzjqzpgwx;

create table library_tags
(
    library_id integer not null
        constraint library_library_tags___fk
            references library
            on update cascade on delete cascade,
    tags_id    integer not null
        constraint library_tags_tags___fk
            references tags
            on update cascade on delete cascade
);

alter table library_tags
    owner to czkcrjzjqzpgwx;


