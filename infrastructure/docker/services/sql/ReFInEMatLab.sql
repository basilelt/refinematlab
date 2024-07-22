/* 
GENERATED BY DEFAULT AS IDENTITY is a SQL standard way of auto-incrementing primary keys
It's more flexible and less prone to some of the issues that can come up with SERIAL
*/


-- Drop the old schema
DROP SCHEMA public CASCADE;

-- Create a new schema with the same name
CREATE SCHEMA public;

-- Set the search path to the new schema
SET search_path TO public;


CREATE TABLE "appareil" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_responsable" integer,
  "id_entreprise_constructeur" integer,
  "id_entreprise_vendeur" integer,
  "id_marque" integer NOT NULL,
  "id_localisation_labo" integer,
  "id_fonction" integer,
  "id_etat_fonctionnement" integer,
  "nom" varchar(100) NOT NULL,
  "numero_serie" varchar(50) NOT NULL,
  "description" text,
  --
  "date_achat" date CHECK (date_achat BETWEEN '1950-01-01'::date AND CURRENT_DATE),
  "prix_achat" double precision CHECK (prix_achat >= 0) DEFAULT 0,
  --
  "numero_inventaire_interne" varchar(50),
  "protocole_utilisation" varchar(260),
  "manuel_fournisseur" varchar(260),
  "fiche_securite" varchar(260)
);

CREATE TABLE "marque" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "nom" varchar(70) UNIQUE NOT NULL
);

CREATE TABLE "etat_fonctionnement" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "etat" varchar(50) UNIQUE NOT NULL
);

CREATE TABLE "document_information" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_appareil" integer,
  "id_consommable" integer,
  "document" varchar(260)
);

CREATE TABLE "photo" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_appareil" integer NOT NULL,
  "photo" varchar(260) NOT NULL
);

CREATE TABLE "fonction" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "fonction" varchar(255) NOT NULL
);

CREATE TABLE "localisation_labo" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "numero_piece" varchar(50),
  "etage_piece" varchar(50),
  "description_piece" varchar(150)
);

CREATE TABLE "ville" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "nom" varchar(255) NOT NULL
);

CREATE TABLE "code_postal" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "code_postal" varchar(10) NOT NULL
);

CREATE TABLE "entreprise_adresse" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_entreprise" integer,
  "id_adresse" integer NOT NULL,
  "type_entreprise" varchar(50) NOT NULL
);

CREATE TABLE "adresse" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_localisation" integer NOT NULL,
  "complement" text,
  "libelle" text NOT NULL
);

CREATE TABLE "localisation" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_code_postal" integer,
  "id_ville" integer,
  "id_pays" integer
);

CREATE TABLE "pays" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  --
  "code_num" smallint UNIQUE CHECK ("code_num" > 0 AND "code_num" < 1000),
  --
  "code_alpha2" char(2) UNIQUE,
  "code_alpha3" char(3) UNIQUE,
  "nom_francais" varchar(255) UNIQUE,
  "nom_anglais" varchar(255) UNIQUE
);

CREATE TABLE "entreprise" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "nom" varchar(70) NOT NULL
);

CREATE TABLE "externe_interne" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "type" varchar(50) NOT NULL
);
-- pre-populate the table
INSERT INTO "externe_interne" ("type") VALUES 
('interne'), 
('externe');

CREATE TABLE "personne" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_externe_interne" integer NOT NULL,
  "id_entreprise" integer,
  "nom" varchar(70) NOT NULL,
  "prenom" varchar(70),
  "mail" varchar(254),
  "tel" varchar(15)
);

CREATE TABLE "intervention" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_responsable" integer,
  "id_externe_interne" integer NOT NULL,
  "id_type_intervention" integer NOT NULL,
  "id_mode_intervention" integer NOT NULL,
  "id_appareil" integer NOT NULL,
  --
  "date_debut" timestamptz NOT NULL CHECK ("date_debut" BETWEEN '1950-01-01'::timestamptz AND CURRENT_TIMESTAMP),
  "date_fin" timestamptz CHECK ("date_fin" BETWEEN '1950-01-01'::timestamptz AND CURRENT_TIMESTAMP),
  --
  "rapport" varchar(260)
);

CREATE TABLE "type_intervention" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "description" varchar(255) NOT NULL
);
-- pre-populate the table
INSERT INTO "type_intervention" ("description") VALUES 
('installation'), 
('reparation'), 
('maintenance'), 
('evacuation');

CREATE TABLE "mode_intervention" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "description" varchar(255) NOT NULL
);
-- pre-populate the table
INSERT INTO "mode_intervention" ("description") VALUES 
('site'), 
('distance');

CREATE TABLE "realise" (
  "id_personne" integer,
  "id_intervention" integer,
  PRIMARY KEY ("id_personne", "id_intervention")
);

CREATE TABLE "catalogue_consommable" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_entreprise" integer NOT NULL,
  "id_consommable" integer NOT NULL,
  --
  "prix" double precision NOT NULL CHECK (prix >= 0) DEFAULT 0
  --
);

CREATE TABLE "consommable" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_localisation_labo" integer NOT NULL,
  "id_type_unite" integer NOT NULL,
  "nature" varchar(255) NOT NULL,
  "description" text,
  "dimension" varchar(255),
  --
  "quantite_par_lot" smallint CHECK (quantite_par_lot >= 0) DEFAULT 0,
  --
  "seuil" integer DEFAULT 0,
  "stock" integer DEFAULT 0,
  "mail" varchar(254)
);

CREATE TABLE "type_unite" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "type" varchar(50) NOT NULL
);

CREATE TABLE "code_barre" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_consommable" integer NOT NULL,
  "code" varchar(50) UNIQUE NOT NULL
);

CREATE TABLE "commande" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_consommable" integer NOT NULL,
  "id_entreprise" integer NOT NULL,
  --
  "prix_unitaire" double precision NOT NULL CHECK (prix_unitaire >= 0) DEFAULT 0,
  "nombre_lot" smallint NOT NULL CHECK (nombre_lot >= 0) DEFAULT 0,
  "date_commande" timestamptz NOT NULL CHECK ("date_reception" BETWEEN '1950-01-01'::timestamptz AND CURRENT_TIMESTAMP),
  --
  "reception" boolean NOT NULL DEFAULT false,
  --
  "date_reception" timestamptz CHECK ("date_reception" BETWEEN '1950-01-01'::timestamptz AND CURRENT_TIMESTAMP)
  --
);
-- Create a trigger function to update the stock of a consommable when a command is received
CREATE OR REPLACE FUNCTION update_stock() RETURNS TRIGGER AS $$
BEGIN
  IF NEW.date_reception <= CURRENT_DATE AND NEW.reception = true THEN
    UPDATE consommable
    SET stock = stock + (NEW.nombre_lot * (SELECT quantite_par_lot FROM consommable WHERE id = NEW.id_consommable))
    WHERE id = NEW.id_consommable;
  END IF;
  RETURN NEW;
END;
$$ LANGUAGE plpgsql;
-- Create the trigger
CREATE TRIGGER update_stock_trigger
AFTER UPDATE OF date_reception ON commande
FOR EACH ROW
EXECUTE FUNCTION update_stock();

CREATE TABLE "document_financier" (
  "id" INTEGER GENERATED BY DEFAULT AS IDENTITY PRIMARY KEY,
  "id_consommable" integer,
  "id_intervention" integer,
  "mode_financement" varchar(200),
  "document" varchar(260)
);

CREATE INDEX "idx_appareil_id_marque" ON "appareil" ("id_marque");

CREATE INDEX "idx_appareil_id_localisation_labo" ON "appareil" ("id_localisation_labo");

CREATE INDEX "idx_appareil_id_fonction" ON "appareil" ("id_fonction");

CREATE INDEX "idx_appareil_nom" ON "appareil" ("nom");

CREATE UNIQUE INDEX "idx_marque_nom" ON "marque" ("nom");

CREATE INDEX "idx_ville_nom" ON "ville" ("nom");

CREATE UNIQUE INDEX "idx_pays_code_alpha2" ON "pays" ("code_alpha2");

CREATE UNIQUE INDEX "idx_pays_nom_francais" ON "pays" ("nom_francais");

CREATE UNIQUE INDEX "idx_pays_nom_anglais" ON "pays" ("nom_anglais");

CREATE INDEX "idx_entreprise_nom" ON "entreprise" ("nom");

CREATE INDEX "idx_personne_nom" ON "personne" ("nom");

CREATE INDEX "idx_intervention_id_type_intervention" ON "intervention" ("id_type_intervention");

CREATE INDEX "idx_intervention_id_mode_intervention" ON "intervention" ("id_mode_intervention");

CREATE INDEX "idx_intervention_date_debut" ON "intervention" ("date_debut");

CREATE INDEX "idx_intervention_date_fin" ON "intervention" ("date_fin");

CREATE INDEX "idx_consommable_nature" ON "consommable" ("nature");

CREATE INDEX "idx_commande_date_commande" ON "commande" ("date_commande");

CREATE INDEX "idx_commande_date_reception" ON "commande" ("date_reception");

ALTER TABLE "appareil" ADD FOREIGN KEY ("id_marque") REFERENCES "marque" ("id");

ALTER TABLE "appareil" ADD FOREIGN KEY ("id_entreprise_constructeur") REFERENCES "entreprise" ("id");

ALTER TABLE "appareil" ADD FOREIGN KEY ("id_fonction") REFERENCES "fonction" ("id");

ALTER TABLE "appareil" ADD FOREIGN KEY ("id_entreprise_vendeur") REFERENCES "entreprise" ("id");

ALTER TABLE "appareil" ADD FOREIGN KEY ("id_responsable") REFERENCES "personne" ("id");

ALTER TABLE "appareil" ADD FOREIGN KEY ("id_localisation_labo") REFERENCES "localisation_labo" ("id");

ALTER TABLE "appareil" ADD FOREIGN KEY ("id_etat_fonctionnement") REFERENCES "etat_fonctionnement" ("id");

ALTER TABLE "document_information" ADD FOREIGN KEY ("id_appareil") REFERENCES "appareil" ("id");

ALTER TABLE "document_information" ADD FOREIGN KEY ("id_consommable") REFERENCES "consommable" ("id");

ALTER TABLE "photo" ADD FOREIGN KEY ("id_appareil") REFERENCES "appareil" ("id");

ALTER TABLE "entreprise_adresse" ADD FOREIGN KEY ("id_adresse") REFERENCES "adresse" ("id");

ALTER TABLE "entreprise_adresse" ADD FOREIGN KEY ("id_entreprise") REFERENCES "entreprise" ("id");

ALTER TABLE "adresse" ADD FOREIGN KEY ("id_localisation") REFERENCES "localisation" ("id");

ALTER TABLE "localisation" ADD FOREIGN KEY ("id_code_postal") REFERENCES "code_postal" ("id");

ALTER TABLE "localisation" ADD FOREIGN KEY ("id_ville") REFERENCES "ville" ("id");

ALTER TABLE "localisation" ADD FOREIGN KEY ("id_pays") REFERENCES "pays" ("id");

ALTER TABLE "personne" ADD FOREIGN KEY ("id_externe_interne") REFERENCES "externe_interne" ("id");

ALTER TABLE "personne" ADD FOREIGN KEY ("id_entreprise") REFERENCES "entreprise" ("id");

ALTER TABLE "intervention" ADD FOREIGN KEY ("id_externe_interne") REFERENCES "externe_interne" ("id");

ALTER TABLE "intervention" ADD FOREIGN KEY ("id_responsable") REFERENCES "personne" ("id");

ALTER TABLE "intervention" ADD FOREIGN KEY ("id_appareil") REFERENCES "appareil" ("id");

ALTER TABLE "intervention" ADD FOREIGN KEY ("id_type_intervention") REFERENCES "type_intervention" ("id");

ALTER TABLE "intervention" ADD FOREIGN KEY ("id_mode_intervention") REFERENCES "mode_intervention" ("id");

ALTER TABLE "realise" ADD FOREIGN KEY ("id_intervention") REFERENCES "intervention" ("id");

ALTER TABLE "realise" ADD FOREIGN KEY ("id_personne") REFERENCES "personne" ("id");

ALTER TABLE "catalogue_consommable" ADD FOREIGN KEY ("id_entreprise") REFERENCES "entreprise" ("id");

ALTER TABLE "catalogue_consommable" ADD FOREIGN KEY ("id_consommable") REFERENCES "consommable" ("id");

ALTER TABLE "consommable" ADD FOREIGN KEY ("id_localisation_labo") REFERENCES "localisation_labo" ("id");

ALTER TABLE "consommable" ADD FOREIGN KEY ("id_type_unite") REFERENCES "type_unite" ("id");

ALTER TABLE "code_barre" ADD FOREIGN KEY ("id_consommable") REFERENCES "consommable" ("id");

ALTER TABLE "commande" ADD FOREIGN KEY ("id_consommable") REFERENCES "consommable" ("id");

ALTER TABLE "commande" ADD FOREIGN KEY ("id_entreprise") REFERENCES "entreprise" ("id");

ALTER TABLE "document_financier" ADD FOREIGN KEY ("id_intervention") REFERENCES "intervention" ("id");

ALTER TABLE "document_financier" ADD FOREIGN KEY ("id_consommable") REFERENCES "consommable" ("id");
