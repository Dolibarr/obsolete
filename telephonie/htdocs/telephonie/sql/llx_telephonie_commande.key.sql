-- ========================================================================
-- Copyright (C) 2004 Rodolphe Quiedeville <rodolphe@quiedeville.org>
--
-- This program is free software; you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation; either version 2 of the License, or
-- (at your option) any later version.
--
-- This program is distributed in the hope that it will be useful,
-- but WITHOUT ANY WARRANTY; without even the implied warranty of
-- MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
-- GNU General Public License for more details.
--
-- You should have received a copy of the GNU General Public License
-- along with this program; if not, write to the Free Software
-- Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
--
-- $Id: llx_telephonie_commande.key.sql,v 1.1 2009/10/20 16:19:20 eldy Exp $
-- $Source: /cvsroot/dolibarr/dolibarrmod/telephonie/htdocs/telephonie/sql/llx_telephonie_commande.key.sql,v $
--
-- ========================================================================

ALTER TABLE llx_telephonie_commande ADD INDEX (fk_user_creat);
ALTER TABLE llx_telephonie_commande ADD INDEX (fk_fournisseur);

ALTER TABLE llx_telephonie_commande ADD FOREIGN KEY (fk_user_creat) REFERENCES llx_user (rowid);
ALTER TABLE llx_telephonie_commande ADD FOREIGN KEY (fk_fournisseur) REFERENCES llx_telephonie_fournisseur (rowid);
