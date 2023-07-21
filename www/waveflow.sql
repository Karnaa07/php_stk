CREATE TABLE esgi_article (
    "id" SERIAL PRIMARY KEY,
    "title" VARCHAR(255) NOT NULL,
    "slug" VARCHAR(255) NOT NULL,
    "content" TEXT NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "image_url" TEXT
);

CREATE TABLE esgi_articlememento (
    "id" SERIAL PRIMARY KEY,
    "date_memento" TIMESTAMP DEFAULT now() NOT NULL,
    "id_article" INTEGER NOT NULL,
    "title" VARCHAR(255) NOT NULL,
    "slug" VARCHAR(255) NOT NULL,
    "content" TEXT NOT NULL,
    "created_at" TIMESTAMP,
    "updated_at" TIMESTAMP,
    "image_url" TEXT NOT NULL
);

CREATE TABLE esgi_commentaires (
    "id" SERIAL PRIMARY KEY,
    "nom" VARCHAR(255) NOT NULL,
    "email" VARCHAR(255) NOT NULL,
    "commentaire" TEXT NOT NULL,
    "date_creation" TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
    "is_reported" BOOLEAN,
    "is_approved" BOOLEAN,
    "reason" TEXT,
    "article_id" INTEGER,
    CONSTRAINT "fk_esgi_commentaires_esgi_article" FOREIGN KEY ("article_id") REFERENCES "esgi_article"("id") ON DELETE CASCADE
);

CREATE TABLE esgi_pages (
    "id" SERIAL PRIMARY KEY,
    "author" VARCHAR(255) NOT NULL,
    "date" DATE NOT NULL,
    "title" VARCHAR(255) NOT NULL,
    "theme" VARCHAR(255) NOT NULL,
    "color" VARCHAR(7) NOT NULL,
    "content_page" TEXT NOT NULL,
    "slug" VARCHAR(255),
    CONSTRAINT unique_slug UNIQUE (slug)
);

CREATE TABLE esgi_role (
    "id" SERIAL PRIMARY KEY,
    "name" VARCHAR(50) NOT NULL
);

CREATE TABLE esgi_user (
    "id" SERIAL PRIMARY KEY,
    "firstname" VARCHAR(60) NOT NULL,
    "lastname" VARCHAR(120) NOT NULL,
    "email" VARCHAR(320) NOT NULL,
    "pwd" VARCHAR(255) NOT NULL,
    "country" CHAR(2) NOT NULL,
    "status" SMALLINT DEFAULT 0 NOT NULL,
    "date_inserted" TIMESTAMP,
    "date_updated" TIMESTAMP,
    "role_id" INTEGER,
    "token" VARCHAR(255),
    "verif_code" VARCHAR(255),
    CONSTRAINT "fk_esgi_user_esgi_role" FOREIGN KEY ("role_id") REFERENCES "esgi_role"("id")
);