USE [master]
GO
/****** Object:  Database [gelarapps]    Script Date: 5/17/2020 8:38:00 PM ******/
CREATE DATABASE [gelarapps]
 CONTAINMENT = NONE
 ON  PRIMARY 
( NAME = N'gelarapps', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\gelarapps.mdf' , SIZE = 8192KB , MAXSIZE = UNLIMITED, FILEGROWTH = 65536KB )
 LOG ON 
( NAME = N'gelarapps_log', FILENAME = N'C:\Program Files\Microsoft SQL Server\MSSQL14.MSSQLSERVER\MSSQL\DATA\gelarapps_log.ldf' , SIZE = 8192KB , MAXSIZE = 2048GB , FILEGROWTH = 65536KB )
GO
ALTER DATABASE [gelarapps] SET COMPATIBILITY_LEVEL = 140
GO
IF (1 = FULLTEXTSERVICEPROPERTY('IsFullTextInstalled'))
begin
EXEC [gelarapps].[dbo].[sp_fulltext_database] @action = 'enable'
end
GO
ALTER DATABASE [gelarapps] SET ANSI_NULL_DEFAULT OFF 
GO
ALTER DATABASE [gelarapps] SET ANSI_NULLS OFF 
GO
ALTER DATABASE [gelarapps] SET ANSI_PADDING OFF 
GO
ALTER DATABASE [gelarapps] SET ANSI_WARNINGS OFF 
GO
ALTER DATABASE [gelarapps] SET ARITHABORT OFF 
GO
ALTER DATABASE [gelarapps] SET AUTO_CLOSE OFF 
GO
ALTER DATABASE [gelarapps] SET AUTO_SHRINK OFF 
GO
ALTER DATABASE [gelarapps] SET AUTO_UPDATE_STATISTICS ON 
GO
ALTER DATABASE [gelarapps] SET CURSOR_CLOSE_ON_COMMIT OFF 
GO
ALTER DATABASE [gelarapps] SET CURSOR_DEFAULT  GLOBAL 
GO
ALTER DATABASE [gelarapps] SET CONCAT_NULL_YIELDS_NULL OFF 
GO
ALTER DATABASE [gelarapps] SET NUMERIC_ROUNDABORT OFF 
GO
ALTER DATABASE [gelarapps] SET QUOTED_IDENTIFIER OFF 
GO
ALTER DATABASE [gelarapps] SET RECURSIVE_TRIGGERS OFF 
GO
ALTER DATABASE [gelarapps] SET  DISABLE_BROKER 
GO
ALTER DATABASE [gelarapps] SET AUTO_UPDATE_STATISTICS_ASYNC OFF 
GO
ALTER DATABASE [gelarapps] SET DATE_CORRELATION_OPTIMIZATION OFF 
GO
ALTER DATABASE [gelarapps] SET TRUSTWORTHY OFF 
GO
ALTER DATABASE [gelarapps] SET ALLOW_SNAPSHOT_ISOLATION OFF 
GO
ALTER DATABASE [gelarapps] SET PARAMETERIZATION SIMPLE 
GO
ALTER DATABASE [gelarapps] SET READ_COMMITTED_SNAPSHOT OFF 
GO
ALTER DATABASE [gelarapps] SET HONOR_BROKER_PRIORITY OFF 
GO
ALTER DATABASE [gelarapps] SET RECOVERY SIMPLE 
GO
ALTER DATABASE [gelarapps] SET  MULTI_USER 
GO
ALTER DATABASE [gelarapps] SET PAGE_VERIFY CHECKSUM  
GO
ALTER DATABASE [gelarapps] SET DB_CHAINING OFF 
GO
ALTER DATABASE [gelarapps] SET FILESTREAM( NON_TRANSACTED_ACCESS = OFF ) 
GO
ALTER DATABASE [gelarapps] SET TARGET_RECOVERY_TIME = 60 SECONDS 
GO
ALTER DATABASE [gelarapps] SET DELAYED_DURABILITY = DISABLED 
GO
ALTER DATABASE [gelarapps] SET QUERY_STORE = OFF
GO
USE [gelarapps]
GO
/****** Object:  User [shin]    Script Date: 5/17/2020 8:38:00 PM ******/
CREATE USER [shin] FOR LOGIN [shin] WITH DEFAULT_SCHEMA=[dbo]
GO
ALTER ROLE [db_owner] ADD MEMBER [shin]
GO
ALTER ROLE [db_accessadmin] ADD MEMBER [shin]
GO
ALTER ROLE [db_securityadmin] ADD MEMBER [shin]
GO
ALTER ROLE [db_ddladmin] ADD MEMBER [shin]
GO
ALTER ROLE [db_backupoperator] ADD MEMBER [shin]
GO
ALTER ROLE [db_datareader] ADD MEMBER [shin]
GO
ALTER ROLE [db_datawriter] ADD MEMBER [shin]
GO
ALTER ROLE [db_denydatareader] ADD MEMBER [shin]
GO
ALTER ROLE [db_denydatawriter] ADD MEMBER [shin]
GO
/****** Object:  Table [dbo].[Kategori]    Script Date: 5/17/2020 8:38:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Kategori](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[kategori] [nvarchar](64) NOT NULL,
 CONSTRAINT [PK_Kategori] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Keanggotaan]    Script Date: 5/17/2020 8:38:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Keanggotaan](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_user] [nvarchar](64) NOT NULL,
	[id_komunitas] [int] NOT NULL,
	[tgl_bergabung] [datetime] NOT NULL,
	[verified] [bit] NOT NULL,
	[role] [bit] NOT NULL,
 CONSTRAINT [PK_Keanggotaan] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Kegiatan]    Script Date: 5/17/2020 8:38:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Kegiatan](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[creator] [nvarchar](128) NOT NULL,
	[judul] [nvarchar](256) NOT NULL,
	[id_komunitas] [int] NOT NULL,
	[waktu_mulai] [datetime] NOT NULL,
	[waktu_selesai] [datetime] NOT NULL,
	[tempat] [nvarchar](512) NOT NULL,
	[deskripsi] [nvarchar](2048) NULL,
 CONSTRAINT [PK_Kegiatan] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Komentar]    Script Date: 5/17/2020 8:38:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Komentar](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_kegiatan] [int] NOT NULL,
	[author] [nvarchar](128) NOT NULL,
	[isi] [nvarchar](1024) NOT NULL,
	[waktu] [datetime] NOT NULL,
 CONSTRAINT [PK_Komentar] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Komunitas]    Script Date: 5/17/2020 8:38:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Komunitas](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[nama_komunitas] [nvarchar](128) NOT NULL,
	[alamat] [nvarchar](256) NULL,
	[kategori] [int] NOT NULL,
	[deskripsi] [nvarchar](1024) NULL,
	[owner] [nvarchar](64) NOT NULL,
	[photo_path] [nvarchar](256) NULL,
 CONSTRAINT [PK_Komunitas] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Komunitas_Kategori]    Script Date: 5/17/2020 8:38:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Komunitas_Kategori](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_kategori] [int] NOT NULL,
	[id_komunitas] [int] NOT NULL,
 CONSTRAINT [PK_Komunitas_Kategori] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Notif_Konten]    Script Date: 5/17/2020 8:38:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Notif_Konten](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[username] [nvarchar](128) NULL,
	[komunitas] [int] NULL,
	[kegiatan] [int] NULL,
	[pagelaran] [int] NULL,
	[jenis] [int] NOT NULL,
	[waktu] [datetime] NOT NULL,
 CONSTRAINT [PK_Notif_Konten] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Notifikasi]    Script Date: 5/17/2020 8:38:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Notifikasi](
	[id_konten] [int] NOT NULL,
	[username] [nvarchar](128) NOT NULL,
	[is_read] [bit] NOT NULL
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Pagelaran]    Script Date: 5/17/2020 8:38:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Pagelaran](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[judul] [nvarchar](256) NOT NULL,
	[tempat] [nvarchar](256) NOT NULL,
	[waktu_mulai] [datetime] NOT NULL,
	[waktu_selesai] [datetime] NOT NULL,
	[deskripsi] [nvarchar](1024) NULL,
	[komunitas] [int] NULL,
	[creator] [nvarchar](64) NOT NULL,
	[photo_path] [nvarchar](256) NULL,
 CONSTRAINT [PK_Pagelaran] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[Users]    Script Date: 5/17/2020 8:38:00 PM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[Users](
	[username] [nvarchar](64) NOT NULL,
	[password] [nvarchar](128) NOT NULL,
	[nama] [nvarchar](256) NOT NULL,
	[email] [nvarchar](256) NOT NULL,
	[status] [nvarchar](256) NULL,
	[photo] [nvarchar](max) NULL,
 CONSTRAINT [PK_Users] PRIMARY KEY CLUSTERED 
(
	[username] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
ALTER TABLE [dbo].[Keanggotaan] ADD  CONSTRAINT [DF_Keanggotaan_tgl_bergabung]  DEFAULT (sysdatetime()) FOR [tgl_bergabung]
GO
ALTER TABLE [dbo].[Komentar] ADD  CONSTRAINT [DF_Komentar_waktu]  DEFAULT (sysdatetime()) FOR [waktu]
GO
ALTER TABLE [dbo].[Notif_Konten] ADD  CONSTRAINT [DF_Notif_Konten_waktu]  DEFAULT (sysdatetime()) FOR [waktu]
GO
ALTER TABLE [dbo].[Notifikasi] ADD  CONSTRAINT [DF_Notifikasi_is_read]  DEFAULT ((0)) FOR [is_read]
GO
USE [master]
GO
ALTER DATABASE [gelarapps] SET  READ_WRITE 
GO
