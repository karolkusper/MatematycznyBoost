-- This script was generated by the ERD tool in pgAdmin 4.
-- Please log an issue at https://github.com/pgadmin-org/pgadmin4/issues/new/choose if you find any bugs, including reproduction steps.
BEGIN;


CREATE TABLE IF NOT EXISTS public.homework
(
    homework_id integer NOT NULL DEFAULT nextval('homework_homework_id_seq'::regclass),
    teacher_id integer,
    assigned_to integer,
    title character varying(100) COLLATE pg_catalog."default" NOT NULL,
    description text COLLATE pg_catalog."default",
    task_path character varying(255) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT homework_pkey PRIMARY KEY (homework_id)
);

CREATE TABLE IF NOT EXISTS public.homework_solutions
(
    solution_id integer NOT NULL DEFAULT nextval('homework_solutions_solution_id_seq'::regclass),
    user_id integer,
    homework_id integer,
    homework_title character varying(100) COLLATE pg_catalog."default" NOT NULL,
    homework_description text COLLATE pg_catalog."default",
    solution_path character varying(255) COLLATE pg_catalog."default" NOT NULL,
    grade smallint DEFAULT 0,
    CONSTRAINT homework_solutions_pkey PRIMARY KEY (solution_id)
);

CREATE TABLE IF NOT EXISTS public.users
(
    user_id integer NOT NULL DEFAULT nextval('users_user_id_seq'::regclass),
    username character varying(50) COLLATE pg_catalog."default" NOT NULL,
    email character varying(100) COLLATE pg_catalog."default" NOT NULL,
    password_hash character varying(100) COLLATE pg_catalog."default" NOT NULL,
    role character varying(20) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT users_pkey PRIMARY KEY (user_id),
    CONSTRAINT users_email_key UNIQUE (email),
    CONSTRAINT users_username_key UNIQUE (username)
);

ALTER TABLE IF EXISTS public.homework
    ADD CONSTRAINT homework_assigned_to_fkey FOREIGN KEY (assigned_to)
    REFERENCES public.users (user_id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION;


ALTER TABLE IF EXISTS public.homework
    ADD CONSTRAINT homework_teacher_id_fkey FOREIGN KEY (teacher_id)
    REFERENCES public.users (user_id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION;


ALTER TABLE IF EXISTS public.homework_solutions
    ADD CONSTRAINT homework_solutions_homework_id_fkey FOREIGN KEY (homework_id)
    REFERENCES public.homework (homework_id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION;


ALTER TABLE IF EXISTS public.homework_solutions
    ADD CONSTRAINT homework_solutions_user_id_fkey FOREIGN KEY (user_id)
    REFERENCES public.users (user_id) MATCH SIMPLE
    ON UPDATE NO ACTION
    ON DELETE NO ACTION;

END;