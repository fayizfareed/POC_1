--
-- PostgreSQL database dump
--

-- Dumped from database version 14.5
-- Dumped by pg_dump version 14.5

-- Started on 2022-10-11 18:20:12

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
-- TOC entry 210 (class 1259 OID 20491)
-- Name: user_info; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_info (
    id bigint NOT NULL,
    first_name character varying(200) NOT NULL,
    last_name character varying(200) NOT NULL,
    mail_address character varying(200) NOT NULL,
    creation_date date DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.user_info OWNER TO postgres;

--
-- TOC entry 209 (class 1259 OID 20490)
-- Name: user_info_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_info_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_info_id_seq OWNER TO postgres;

--
-- TOC entry 3314 (class 0 OID 0)
-- Dependencies: 209
-- Name: user_info_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_info_id_seq OWNED BY public.user_info.id;


--
-- TOC entry 3164 (class 2604 OID 20494)
-- Name: user_info id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_info ALTER COLUMN id SET DEFAULT nextval('public.user_info_id_seq'::regclass);


--
-- TOC entry 3167 (class 2606 OID 20501)
-- Name: user_info unique_email; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_info
    ADD CONSTRAINT unique_email UNIQUE (mail_address);


--
-- TOC entry 3169 (class 2606 OID 20499)
-- Name: user_info user_info_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_info
    ADD CONSTRAINT user_info_pkey PRIMARY KEY (id);


-- Completed on 2022-10-11 18:20:12

--
-- PostgreSQL database dump complete
--

