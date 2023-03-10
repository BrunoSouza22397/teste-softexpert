PGDMP     *    1        
        {         
   softexpert    15.2    15.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16400 
   softexpert    DATABASE     ?   CREATE DATABASE softexpert WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'Portuguese_Brazil.932';
    DROP DATABASE softexpert;
                postgres    false            ?            1259    16423    Produtos    TABLE     ?   CREATE TABLE public."Produtos" (
    id integer NOT NULL,
    nome character varying DEFAULT 'unspecified'::character varying NOT NULL,
    valor real DEFAULT '0'::real NOT NULL,
    tipo integer NOT NULL
);
    DROP TABLE public."Produtos";
       public         heap    postgres    false            ?            1259    16448    Produtos_id_seq    SEQUENCE     ?   ALTER TABLE public."Produtos" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Produtos_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    215            ?            1259    16401    Tipos    TABLE     ?   CREATE TABLE public."Tipos" (
    id integer NOT NULL,
    nome character varying DEFAULT 'unspecified'::character varying NOT NULL,
    porcentagem_imposto real DEFAULT '0'::real NOT NULL
);
    DROP TABLE public."Tipos";
       public         heap    postgres    false            ?            1259    16447    Tipos_id_seq    SEQUENCE     ?   ALTER TABLE public."Tipos" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Tipos_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    214            ?            1259    16437    Vendas    TABLE     y   CREATE TABLE public."Vendas" (
    id integer NOT NULL,
    produto integer NOT NULL,
    quantidade integer NOT NULL
);
    DROP TABLE public."Vendas";
       public         heap    postgres    false            ?            1259    16449    Vendas_id_seq    SEQUENCE     ?   ALTER TABLE public."Vendas" ALTER COLUMN id ADD GENERATED ALWAYS AS IDENTITY (
    SEQUENCE NAME public."Vendas_id_seq"
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1
);
            public          postgres    false    216            v           2606    16431    Produtos Produtos_pkey 
   CONSTRAINT     X   ALTER TABLE ONLY public."Produtos"
    ADD CONSTRAINT "Produtos_pkey" PRIMARY KEY (id);
 D   ALTER TABLE ONLY public."Produtos" DROP CONSTRAINT "Produtos_pkey";
       public            postgres    false    215            t           2606    16409    Tipos Tipos_pkey 
   CONSTRAINT     R   ALTER TABLE ONLY public."Tipos"
    ADD CONSTRAINT "Tipos_pkey" PRIMARY KEY (id);
 >   ALTER TABLE ONLY public."Tipos" DROP CONSTRAINT "Tipos_pkey";
       public            postgres    false    214            x           2606    16441    Vendas Vendas_pkey 
   CONSTRAINT     T   ALTER TABLE ONLY public."Vendas"
    ADD CONSTRAINT "Vendas_pkey" PRIMARY KEY (id);
 @   ALTER TABLE ONLY public."Vendas" DROP CONSTRAINT "Vendas_pkey";
       public            postgres    false    216            z           2606    16442    Vendas produto    FK CONSTRAINT     t   ALTER TABLE ONLY public."Vendas"
    ADD CONSTRAINT produto FOREIGN KEY (produto) REFERENCES public."Produtos"(id);
 :   ALTER TABLE ONLY public."Vendas" DROP CONSTRAINT produto;
       public          postgres    false    216    215    3190            y           2606    16432    Produtos tipo    FK CONSTRAINT     m   ALTER TABLE ONLY public."Produtos"
    ADD CONSTRAINT tipo FOREIGN KEY (tipo) REFERENCES public."Tipos"(id);
 9   ALTER TABLE ONLY public."Produtos" DROP CONSTRAINT tipo;
       public          postgres    false    3188    214    215           