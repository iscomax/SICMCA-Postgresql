--
-- PostgreSQL database dump
--

-- Dumped from database version 14.0
-- Dumped by pg_dump version 14.0

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: alumnos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alumnos (
    numero_cuenta integer NOT NULL,
    nombre character varying(45) DEFAULT NULL::character varying,
    paterno character varying(45) DEFAULT NULL::character varying,
    materno character varying(45) DEFAULT NULL::character varying,
    correo character varying(45) DEFAULT NULL::character varying
);


ALTER TABLE public.alumnos OWNER TO postgres;

--
-- Name: calificaciones; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.calificaciones (
    idcalificaciones integer NOT NULL,
    numero_cuenta integer,
    nombre character varying(45) DEFAULT NULL::character varying,
    paterno character varying(45) DEFAULT NULL::character varying,
    materno character varying(45) DEFAULT NULL::character varying,
    curso character varying(45) DEFAULT NULL::character varying,
    grupo character varying(45) DEFAULT NULL::character varying,
    calificacion integer
);


ALTER TABLE public.calificaciones OWNER TO postgres;

--
-- Name: calificaciones_idcalificaciones_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.calificaciones_idcalificaciones_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.calificaciones_idcalificaciones_seq OWNER TO postgres;

--
-- Name: calificaciones_idcalificaciones_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.calificaciones_idcalificaciones_seq OWNED BY public.calificaciones.idcalificaciones;


--
-- Name: calificaciones idcalificaciones; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.calificaciones ALTER COLUMN idcalificaciones SET DEFAULT nextval('public.calificaciones_idcalificaciones_seq'::regclass);


--
-- Data for Name: alumnos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.alumnos (numero_cuenta, nombre, paterno, materno, correo) FROM stdin;
123456781	Mireya	Broz	Izar	correo1@dominio.com.mx
123456782	Demetrio 	Navedo	Galarza	correo2@dominio.com.mx
123456783	Prica	Camango	Cendegui	correo3@dominio.com.mx
123456784	Janina	Vallejo	Rios	correo4@dominio.com.mx
123456785	Liz	Aroztegui	Velez	correo5@dominio.com.mx
123456786	Añaterve	Antolin	Burdeos	correo6@dominio.com.mx
123456787	Elda	Bernalda	Monroy	correo7@dominio.com.mx
123456788	Angelina	Vegas	Lebrija	correo8@dominio.com.mx
123456789	Yaiza	Obiaga	Obieso	correo9@dominio.com.mx
123456790	Romano	Pineros	Buraga	correo10@dominio.com.mx
123456791	Eliana	Santana	Asensio	correo11@dominio.com.mx
123456792	Ruben	 Vives	Giralt	correo12@dominio.com.mx
123456793	Eva María Marisela 	Grau	Cuenca	correo13@dominio.com.mx
123456794	María	Carmen	Ramis	correo14@dominio.com.mx
123456795	Gerardo	 Anguita	Tenorio	correo15@dominio.com.mx
123456796	Maricela	Sala	Zabala	correo16@dominio.com.mx
123456797	Azahar	Gonzalo	Mata	correo17@dominio.com.mx
123456798	Isidoro	Aguiló	Aparicio	correo18@dominio.com.mx
123456799	Benjamín	Vilanova	Revilla	correo19@dominio.com.mx
123456800	Celia	Milla	Arenas	correo20@dominio.com.mx
123456801	Inocencio	Álvarez	Palacios	correo21@dominio.com.mx
123456802	Marcial	Folch	Salom	correo22@dominio.com.mx
\.


--
-- Data for Name: calificaciones; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.calificaciones (idcalificaciones, numero_cuenta, nombre, paterno, materno, curso, grupo, calificacion) FROM stdin;
1	123456781	Mireya	Broz	Izar	español	grupoC	10
2	123456795	 Gerardo	  Anguita	 Tenorio	Biologia Molecular	GrupoB	8
3	123456782	 Demetrio 	 Navedo	 Galarza	LENGUA CASTELLANA Y LITERATURA	Grupo B	8
\.


--
-- Name: calificaciones_idcalificaciones_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.calificaciones_idcalificaciones_seq', 1, false);


--
-- Name: alumnos alumnos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumnos
    ADD CONSTRAINT alumnos_pkey PRIMARY KEY (numero_cuenta);


--
-- Name: calificaciones calificaciones_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.calificaciones
    ADD CONSTRAINT calificaciones_pkey PRIMARY KEY (idcalificaciones);


--
-- PostgreSQL database dump complete
--

