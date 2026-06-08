FROM mariadb:10.11

COPY --chmod=644 databases/sql/create_users.sql /docker-entrypoint-initdb.d/01_create_users.sql
COPY --chmod=644 databases/sql/create_diaries.sql /docker-entrypoint-initdb.d/02_create_diaries.sql
