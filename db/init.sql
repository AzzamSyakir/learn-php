create table IF NOT EXISTS users
(
    id uuid not null primary key,
    name text not null unique ,
    password TEXT not null  ,
    created_at timestamptz not null ,
    updated_at timestamptz not null
);
create table IF NOT EXISTS tasks
(
    id uuid not null primary key,
    title text not null unique ,
    completed boolean not null  ,
    created_at timestamptz not null ,
    updated_at timestamptz not null
);