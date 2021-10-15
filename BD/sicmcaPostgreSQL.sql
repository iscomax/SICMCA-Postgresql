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
-- Name: alumno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.alumno (
    numero_cuenta integer NOT NULL,
    nombre character varying(45) DEFAULT NULL::character varying,
    apellidos character varying(45) DEFAULT NULL::character varying,
    correo character varying(45) DEFAULT NULL::character varying
);


ALTER TABLE public.alumno OWNER TO postgres;

--
-- Name: bitacora; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.bitacora (
    id_bitacora bigint NOT NULL,
    grupo character varying(45) DEFAULT NULL::character varying,
    profesor character varying(45) DEFAULT NULL::character varying,
    alumno character varying(45) DEFAULT NULL::character varying,
    calificacion double precision,
    id_usuario integer NOT NULL,
    id_materia integer NOT NULL,
    fecha_hora time(2) with time zone
);


ALTER TABLE public.bitacora OWNER TO postgres;

--
-- Name: bitacora_id_bitacora_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.bitacora_id_bitacora_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.bitacora_id_bitacora_seq OWNER TO postgres;

--
-- Name: bitacora_id_bitacora_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.bitacora_id_bitacora_seq OWNED BY public.bitacora.id_bitacora;


--
-- Name: calificacion; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.calificacion (
    id_calificacion integer NOT NULL,
    calificacion double precision,
    id_grupo integer NOT NULL,
    numero_cuenta integer NOT NULL,
    curso_id_curso integer NOT NULL
);


ALTER TABLE public.calificacion OWNER TO postgres;

--
-- Name: curso; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.curso (
    id_curso bigint NOT NULL,
    nombre character varying(45) DEFAULT NULL::character varying,
    id_materia integer NOT NULL
);


ALTER TABLE public.curso OWNER TO postgres;

--
-- Name: curso_alumno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.curso_alumno (
    curso_id_curso integer NOT NULL,
    alumno_numero_cuenta integer NOT NULL
);


ALTER TABLE public.curso_alumno OWNER TO postgres;

--
-- Name: curso_id_curso_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.curso_id_curso_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.curso_id_curso_seq OWNER TO postgres;

--
-- Name: curso_id_curso_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.curso_id_curso_seq OWNED BY public.curso.id_curso;


--
-- Name: grupo; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupo (
    id_grupo integer NOT NULL,
    nombre character varying(45) DEFAULT NULL::character varying,
    id_profesor integer NOT NULL,
    id_curso integer NOT NULL
);


ALTER TABLE public.grupo OWNER TO postgres;

--
-- Name: grupo_alumno; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.grupo_alumno (
    id_grupo integer NOT NULL,
    id_alumno integer NOT NULL
);


ALTER TABLE public.grupo_alumno OWNER TO postgres;

--
-- Name: materia; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.materia (
    id_materia bigint NOT NULL,
    id_moodle integer NOT NULL,
    id_grupo integer,
    nombre_curso character varying(45) NOT NULL,
    nombre_grupo character varying(45) NOT NULL,
    nombre_profesor character varying(45) NOT NULL,
    numero_cuenta integer NOT NULL,
    nombre_alumno character varying(45) NOT NULL,
    calificacion integer NOT NULL,
    estatus smallint NOT NULL
);


ALTER TABLE public.materia OWNER TO postgres;

--
-- Name: materia_id_materia_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.materia_id_materia_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.materia_id_materia_seq OWNER TO postgres;

--
-- Name: materia_id_materia_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.materia_id_materia_seq OWNED BY public.materia.id_materia;


--
-- Name: persona; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.persona (
    id_persona bigint NOT NULL,
    nombre character varying(45) NOT NULL,
    apellidos character varying(45) NOT NULL,
    num_trabajador integer
);


ALTER TABLE public.persona OWNER TO postgres;

--
-- Name: persona_id_persona_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.persona_id_persona_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.persona_id_persona_seq OWNER TO postgres;

--
-- Name: persona_id_persona_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.persona_id_persona_seq OWNED BY public.persona.id_persona;


--
-- Name: profesor; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.profesor (
    id_profesor integer NOT NULL,
    nombre character varying(45) DEFAULT NULL::character varying
);


ALTER TABLE public.profesor OWNER TO postgres;

--
-- Name: profesor_cursos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.profesor_cursos (
    profesor_id_profesor integer NOT NULL,
    cursos_id_cursos integer NOT NULL
);


ALTER TABLE public.profesor_cursos OWNER TO postgres;

--
-- Name: rol; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rol (
    id_rol bigint NOT NULL,
    nombre_rol character varying(45) DEFAULT NULL::character varying
);


ALTER TABLE public.rol OWNER TO postgres;

--
-- Name: rol_id_rol_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.rol_id_rol_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.rol_id_rol_seq OWNER TO postgres;

--
-- Name: rol_id_rol_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.rol_id_rol_seq OWNED BY public.rol.id_rol;


--
-- Name: rol_usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.rol_usuario (
    id_rol integer NOT NULL,
    id_usuario integer NOT NULL
);


ALTER TABLE public.rol_usuario OWNER TO postgres;

--
-- Name: usuario; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuario (
    id_usuario integer NOT NULL,
    correo character varying(45) DEFAULT NULL::character varying,
    "contraseña" character varying(45) DEFAULT NULL::character varying,
    id_persona integer NOT NULL
);


ALTER TABLE public.usuario OWNER TO postgres;

--
-- Name: bitacora id_bitacora; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bitacora ALTER COLUMN id_bitacora SET DEFAULT nextval('public.bitacora_id_bitacora_seq'::regclass);


--
-- Name: curso id_curso; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.curso ALTER COLUMN id_curso SET DEFAULT nextval('public.curso_id_curso_seq'::regclass);


--
-- Name: materia id_materia; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.materia ALTER COLUMN id_materia SET DEFAULT nextval('public.materia_id_materia_seq'::regclass);


--
-- Name: persona id_persona; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona ALTER COLUMN id_persona SET DEFAULT nextval('public.persona_id_persona_seq'::regclass);


--
-- Name: rol id_rol; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol ALTER COLUMN id_rol SET DEFAULT nextval('public.rol_id_rol_seq'::regclass);


--
-- Data for Name: alumno; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.alumno (numero_cuenta, nombre, apellidos, correo) FROM stdin;
\.


--
-- Data for Name: bitacora; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.bitacora (id_bitacora, grupo, profesor, alumno, calificacion, id_usuario, id_materia, fecha_hora) FROM stdin;
\.


--
-- Data for Name: calificacion; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.calificacion (id_calificacion, calificacion, id_grupo, numero_cuenta, curso_id_curso) FROM stdin;
\.


--
-- Data for Name: curso; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.curso (id_curso, nombre, id_materia) FROM stdin;
\.


--
-- Data for Name: curso_alumno; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.curso_alumno (curso_id_curso, alumno_numero_cuenta) FROM stdin;
\.


--
-- Data for Name: grupo; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupo (id_grupo, nombre, id_profesor, id_curso) FROM stdin;
\.


--
-- Data for Name: grupo_alumno; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.grupo_alumno (id_grupo, id_alumno) FROM stdin;
\.


--
-- Data for Name: materia; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.materia (id_materia, id_moodle, id_grupo, nombre_curso, nombre_grupo, nombre_profesor, numero_cuenta, nombre_alumno, calificacion, estatus) FROM stdin;
\.


--
-- Data for Name: persona; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.persona (id_persona, nombre, apellidos, num_trabajador) FROM stdin;
\.


--
-- Data for Name: profesor; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.profesor (id_profesor, nombre) FROM stdin;
\.


--
-- Data for Name: profesor_cursos; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.profesor_cursos (profesor_id_profesor, cursos_id_cursos) FROM stdin;
\.


--
-- Data for Name: rol; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rol (id_rol, nombre_rol) FROM stdin;
1	Administrador
2	Coordinador
3	Profesor
\.


--
-- Data for Name: rol_usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.rol_usuario (id_rol, id_usuario) FROM stdin;
\.


--
-- Data for Name: usuario; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.usuario (id_usuario, correo, "contraseña", id_persona) FROM stdin;
\.


--
-- Name: bitacora_id_bitacora_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.bitacora_id_bitacora_seq', 1, false);


--
-- Name: curso_id_curso_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.curso_id_curso_seq', 1, false);


--
-- Name: materia_id_materia_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.materia_id_materia_seq', 1, false);


--
-- Name: persona_id_persona_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.persona_id_persona_seq', 1, false);


--
-- Name: rol_id_rol_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.rol_id_rol_seq', 1, false);


--
-- Name: alumno alumno_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.alumno
    ADD CONSTRAINT alumno_pkey PRIMARY KEY (numero_cuenta);


--
-- Name: bitacora bitacora_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bitacora
    ADD CONSTRAINT bitacora_pkey PRIMARY KEY (id_bitacora);


--
-- Name: calificacion calificacion_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.calificacion
    ADD CONSTRAINT calificacion_pkey PRIMARY KEY (id_calificacion);


--
-- Name: curso_alumno curso_alumno_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.curso_alumno
    ADD CONSTRAINT curso_alumno_pkey PRIMARY KEY (curso_id_curso, alumno_numero_cuenta);


--
-- Name: curso curso_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.curso
    ADD CONSTRAINT curso_pkey PRIMARY KEY (id_curso);


--
-- Name: grupo_alumno grupo_alumno_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_alumno
    ADD CONSTRAINT grupo_alumno_pkey PRIMARY KEY (id_grupo, id_alumno);


--
-- Name: grupo grupo_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo
    ADD CONSTRAINT grupo_pkey PRIMARY KEY (id_grupo);


--
-- Name: materia materia_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.materia
    ADD CONSTRAINT materia_pkey PRIMARY KEY (id_materia);


--
-- Name: persona persona_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.persona
    ADD CONSTRAINT persona_pkey PRIMARY KEY (id_persona);


--
-- Name: profesor_cursos profesor_cursos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profesor_cursos
    ADD CONSTRAINT profesor_cursos_pkey PRIMARY KEY (profesor_id_profesor, cursos_id_cursos);


--
-- Name: profesor profesor_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profesor
    ADD CONSTRAINT profesor_pkey PRIMARY KEY (id_profesor);


--
-- Name: rol rol_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol
    ADD CONSTRAINT rol_pkey PRIMARY KEY (id_rol);


--
-- Name: rol_usuario rol_usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_usuario
    ADD CONSTRAINT rol_usuario_pkey PRIMARY KEY (id_rol, id_usuario);


--
-- Name: usuario usuario_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_pkey PRIMARY KEY (id_usuario);


--
-- Name: bitacora_id_materia_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX bitacora_id_materia_idx ON public.bitacora USING btree (id_materia);


--
-- Name: bitacora_id_usuario_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX bitacora_id_usuario_idx ON public.bitacora USING btree (id_usuario);


--
-- Name: calificacion_curso_id_curso_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX calificacion_curso_id_curso_idx ON public.calificacion USING btree (curso_id_curso);


--
-- Name: calificacion_id_grupo_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX calificacion_id_grupo_idx ON public.calificacion USING btree (id_grupo);


--
-- Name: calificacion_numero_cuenta_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX calificacion_numero_cuenta_idx ON public.calificacion USING btree (numero_cuenta);


--
-- Name: curso_alumno_alumno_numero_cuenta_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX curso_alumno_alumno_numero_cuenta_idx ON public.curso_alumno USING btree (alumno_numero_cuenta);


--
-- Name: curso_alumno_curso_id_curso_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX curso_alumno_curso_id_curso_idx ON public.curso_alumno USING btree (curso_id_curso);


--
-- Name: curso_id_materia_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX curso_id_materia_idx ON public.curso USING btree (id_materia);


--
-- Name: grupo_alumno_id_alumno_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX grupo_alumno_id_alumno_idx ON public.grupo_alumno USING btree (id_alumno);


--
-- Name: grupo_alumno_id_grupo_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX grupo_alumno_id_grupo_idx ON public.grupo_alumno USING btree (id_grupo);


--
-- Name: grupo_id_curso_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX grupo_id_curso_idx ON public.grupo USING btree (id_curso);


--
-- Name: grupo_id_profesor_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX grupo_id_profesor_idx ON public.grupo USING btree (id_profesor);


--
-- Name: profesor_cursos_cursos_id_cursos_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX profesor_cursos_cursos_id_cursos_idx ON public.profesor_cursos USING btree (cursos_id_cursos);


--
-- Name: profesor_cursos_profesor_id_profesor_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX profesor_cursos_profesor_id_profesor_idx ON public.profesor_cursos USING btree (profesor_id_profesor);


--
-- Name: rol_usuario_id_rol_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX rol_usuario_id_rol_idx ON public.rol_usuario USING btree (id_rol);


--
-- Name: rol_usuario_id_usuario_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX rol_usuario_id_usuario_idx ON public.rol_usuario USING btree (id_usuario);


--
-- Name: usuario_id_persona_idx; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX usuario_id_persona_idx ON public.usuario USING btree (id_persona);


--
-- Name: bitacora bitacora_id_materia_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bitacora
    ADD CONSTRAINT bitacora_id_materia_fkey FOREIGN KEY (id_materia) REFERENCES public.materia(id_materia);


--
-- Name: bitacora bitacora_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.bitacora
    ADD CONSTRAINT bitacora_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario);


--
-- Name: calificacion calificacion_curso_id_curso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.calificacion
    ADD CONSTRAINT calificacion_curso_id_curso_fkey FOREIGN KEY (curso_id_curso) REFERENCES public.curso(id_curso);


--
-- Name: calificacion calificacion_id_grupo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.calificacion
    ADD CONSTRAINT calificacion_id_grupo_fkey FOREIGN KEY (id_grupo) REFERENCES public.grupo(id_grupo);


--
-- Name: calificacion calificacion_numero_cuenta_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.calificacion
    ADD CONSTRAINT calificacion_numero_cuenta_fkey FOREIGN KEY (numero_cuenta) REFERENCES public.alumno(numero_cuenta);


--
-- Name: curso_alumno curso_alumno_alumno_numero_cuenta_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.curso_alumno
    ADD CONSTRAINT curso_alumno_alumno_numero_cuenta_fkey FOREIGN KEY (alumno_numero_cuenta) REFERENCES public.alumno(numero_cuenta);


--
-- Name: curso_alumno curso_alumno_curso_id_curso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.curso_alumno
    ADD CONSTRAINT curso_alumno_curso_id_curso_fkey FOREIGN KEY (curso_id_curso) REFERENCES public.curso(id_curso);


--
-- Name: curso curso_id_materia_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.curso
    ADD CONSTRAINT curso_id_materia_fkey FOREIGN KEY (id_materia) REFERENCES public.materia(id_materia);


--
-- Name: grupo_alumno grupo_alumno_id_alumno_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_alumno
    ADD CONSTRAINT grupo_alumno_id_alumno_fkey FOREIGN KEY (id_alumno) REFERENCES public.alumno(numero_cuenta);


--
-- Name: grupo_alumno grupo_alumno_id_grupo_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo_alumno
    ADD CONSTRAINT grupo_alumno_id_grupo_fkey FOREIGN KEY (id_grupo) REFERENCES public.grupo(id_grupo);


--
-- Name: grupo grupo_id_curso_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo
    ADD CONSTRAINT grupo_id_curso_fkey FOREIGN KEY (id_curso) REFERENCES public.curso(id_curso);


--
-- Name: grupo grupo_id_profesor_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.grupo
    ADD CONSTRAINT grupo_id_profesor_fkey FOREIGN KEY (id_profesor) REFERENCES public.profesor(id_profesor);


--
-- Name: profesor_cursos profesor_cursos_cursos_id_cursos_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profesor_cursos
    ADD CONSTRAINT profesor_cursos_cursos_id_cursos_fkey FOREIGN KEY (cursos_id_cursos) REFERENCES public.curso(id_curso);


--
-- Name: profesor_cursos profesor_cursos_profesor_id_profesor_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.profesor_cursos
    ADD CONSTRAINT profesor_cursos_profesor_id_profesor_fkey FOREIGN KEY (profesor_id_profesor) REFERENCES public.profesor(id_profesor);


--
-- Name: rol_usuario rol_usuario_id_rol_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_usuario
    ADD CONSTRAINT rol_usuario_id_rol_fkey FOREIGN KEY (id_rol) REFERENCES public.rol(id_rol);


--
-- Name: rol_usuario rol_usuario_id_usuario_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.rol_usuario
    ADD CONSTRAINT rol_usuario_id_usuario_fkey FOREIGN KEY (id_usuario) REFERENCES public.usuario(id_usuario);


--
-- Name: usuario usuario_id_persona_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuario
    ADD CONSTRAINT usuario_id_persona_fkey FOREIGN KEY (id_persona) REFERENCES public.persona(id_persona);


--
-- PostgreSQL database dump complete
--

