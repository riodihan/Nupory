/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     12/28/2019 2:14:34 PM                        */
/*==============================================================*/


drop table if exists BUNGA;

drop table if exists BUNGA_MATI;

drop table if exists DETAIL_PEMESANAN;

drop table if exists DETAIL_TRANSAKSI;

drop table if exists KRITIK;

drop table if exists PEMBAYARAN;

drop table if exists PEMESANAN;

drop table if exists STATUS;

drop table if exists TRANFER;

drop table if exists TRANSAKSI;

drop table if exists USER;

/*==============================================================*/
/* Table: BUNGA                                                 */
/*==============================================================*/
create table BUNGA
(
   ID_BUNGA             varchar(5) not null,
   NAMA_BUNGA           varchar(30),
   HARGA                int,
   STOK                 int,
   FOTO_BUNGA           varchar(20),
   VIDEO_BUNGA          varchar(50),
   CARA_PERAWATAN       varchar(500),
   primary key (ID_BUNGA)
);

/*==============================================================*/
/* Table: BUNGA_MATI                                            */
/*==============================================================*/
create table BUNGA_MATI
(
   ID_BUNGA             varchar(5) not null,
   NAMA_BUNGA           varchar(30),
   PENYEBAB             varchar(30),
   BUNGA_MATI           int
);

/*==============================================================*/
/* Table: DETAIL_PEMESANAN                                      */
/*==============================================================*/
create table DETAIL_PEMESANAN
(
   ID_PEMESANAN         varchar(4) not null,
   ID_BUNGA             varchar(5) not null,
   JUMLAH               int,
   primary key (ID_PEMESANAN, ID_BUNGA)
);

/*==============================================================*/
/* Table: DETAIL_TRANSAKSI                                      */
/*==============================================================*/
create table DETAIL_TRANSAKSI
(
   ID_BUNGA             varchar(5) not null,
   ID_TRANSAKSI         varchar(5) not null,
   JUMLAH               int,
   primary key (ID_BUNGA, ID_TRANSAKSI)
);

/*==============================================================*/
/* Table: KRITIK                                                */
/*==============================================================*/
create table KRITIK
(
   ID_KRITIK            varchar(5) not null,
   ID_USER              varchar(5) not null,
   ISI_KRITIK           varchar(250),
   primary key (ID_KRITIK)
);

/*==============================================================*/
/* Table: PEMBAYARAN                                            */
/*==============================================================*/
create table PEMBAYARAN
(
   ID_PEMBAYARAN        varchar(5) not null,
   JENIS_PEMBAYARAN     varchar(10),
   primary key (ID_PEMBAYARAN)
);

/*==============================================================*/
/* Table: PEMESANAN                                             */
/*==============================================================*/
create table PEMESANAN
(
   ID_PEMESANAN         varchar(4) not null,
   ID_PEMBAYARAN        varchar(5) not null,
   ID_USER              varchar(5) not null,
   TGL_PEMESANAN        date,
   DETAIL_ALAMAT        varchar(100),
   TOTAL_AKHIR          int,
   BUKTI_PEMBAYARAN     varchar(50),
   primary key (ID_PEMESANAN)
);

/*==============================================================*/
/* Table: STATUS                                                */
/*==============================================================*/
create table STATUS
(
   ID_STATUS            varchar(5) not null,
   NAMA_STATUS          varchar(15),
   primary key (ID_STATUS)
);

/*==============================================================*/
/* Table: TRANFER                                               */
/*==============================================================*/
create table TRANFER
(
   ID_TRANSAKSI         varchar(5) not null,
   NAMA_BANK            varchar(15),
   STATUS_TRANSFER      varchar(20),
   BUKTI_PEMBAYARAN     varchar(50)
);

/*==============================================================*/
/* Table: TRANSAKSI                                             */
/*==============================================================*/
create table TRANSAKSI
(
   ID_TRANSAKSI         varchar(5) not null,
   ID_PEMBAYARAN        varchar(5) not null,
   ID_USER              varchar(5) not null,
   TGL_TRANSAKSI        date,
   DETAIL_ALAMAT        varchar(100),
   TOTAL_AKHIR          int,
   STATUS_PEMBELIAN     varchar(15),
   primary key (ID_TRANSAKSI)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   ID_USER              varchar(5) not null,
   ID_STATUS            varchar(5) not null,
   NAMA_USER            varchar(25),
   ALAMAT               varchar(30),
   NO_TELEPON           varchar(13),
   EMAIL                varchar(50),
   USERNAME             varchar(15),
   PASSWORD             varchar(15),
   FOTO_USER            varchar(50),
   primary key (ID_USER)
);

alter table BUNGA_MATI add constraint FK_MENYEBABKAN foreign key (ID_BUNGA)
      references BUNGA (ID_BUNGA) on delete restrict on update restrict;

alter table DETAIL_PEMESANAN add constraint FK_MEMILIH foreign key (ID_PEMESANAN)
      references PEMESANAN (ID_PEMESANAN) on delete restrict on update restrict;

alter table DETAIL_PEMESANAN add constraint FK_MEMILIH2 foreign key (ID_BUNGA)
      references BUNGA (ID_BUNGA) on delete restrict on update restrict;

alter table DETAIL_TRANSAKSI add constraint FK_MELAKUKAN foreign key (ID_BUNGA)
      references BUNGA (ID_BUNGA) on delete restrict on update restrict;

alter table DETAIL_TRANSAKSI add constraint FK_MELAKUKAN2 foreign key (ID_TRANSAKSI)
      references TRANSAKSI (ID_TRANSAKSI) on delete restrict on update restrict;

alter table KRITIK add constraint FK_MENGKRITIK foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table PEMESANAN add constraint FK_MEMBAYAR2 foreign key (ID_PEMBAYARAN)
      references PEMBAYARAN (ID_PEMBAYARAN) on delete restrict on update restrict;

alter table PEMESANAN add constraint FK_MEMPUNYAI2 foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table TRANFER add constraint FK_MENTRANFER foreign key (ID_TRANSAKSI)
      references TRANSAKSI (ID_TRANSAKSI) on delete restrict on update restrict;

alter table TRANSAKSI add constraint FK_MEMBAYAR foreign key (ID_PEMBAYARAN)
      references PEMBAYARAN (ID_PEMBAYARAN) on delete restrict on update restrict;

alter table TRANSAKSI add constraint FK_MEMPUNYAI foreign key (ID_USER)
      references USER (ID_USER) on delete restrict on update restrict;

alter table USER add constraint FK_MEMILIKI foreign key (ID_STATUS)
      references STATUS (ID_STATUS) on delete restrict on update restrict;

